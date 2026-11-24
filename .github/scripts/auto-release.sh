#!/usr/bin/env bash
#
# Releases the dependency updates that landed on main since the last release.
#
# The release level follows the largest version step among the packages in the
# `require` section of composer.json: a patch step makes a patch release, a minor
# step a minor release and a major step a major release. Every level only runs when
# it is switched on; otherwise the run reports what it would have released.
#
# Anything a human has to judge stops the run without a release: changes on main
# outside the dependency files, an added or removed package, a changed PHP floor
# or a prepared [Unreleased] section in the changelog.
#
# Environment:
#   RELEASE_PATCH, RELEASE_MINOR, RELEASE_MAJOR  "true" switches the level on
#   DRY_RUN                                      "true" prepares the release but pushes nothing
#   MAIN_REF                                     ref to release from (default: origin/main)
#   REMOTE                                       remote to push to (default: origin)

set -euo pipefail

main_ref=${MAIN_REF:-origin/main}
remote=${REMOTE:-origin}
dry_run=${DRY_RUN:-false}

summary() {
    echo "$*"
    if [[ -n "${GITHUB_STEP_SUMMARY:-}" ]]; then
        echo "$*" >> "$GITHUB_STEP_SUMMARY"
    fi
}

stop() {
    summary "**No release:** $*"
    exit 0
}

# Files on main that a release may contain without a human writing the changelog
allowed_files='^(composer\.json|composer\.lock|renovate\.json|\.github/.+)$'

last_tag=$(git tag --list 'v*' --sort=-v:refname | grep -m1 -E '^v[0-9]+\.[0-9]+\.[0-9]+$' || true)
[[ -n "$last_tag" ]] || stop "no release tag found"
last_version=${last_tag#v}
IFS=. read -r last_major last_minor last_patch <<< "$last_version"

summary "Last release: \`$last_tag\`, comparing with \`$main_ref\`"

changed_files=$(git log --format= --name-only "$last_tag..$main_ref" | sed '/^$/d' | sort -u)
[[ -n "$changed_files" ]] || stop "main has no commits since $last_tag"

unexpected_files=$(grep -vE "$allowed_files" <<< "$changed_files" || true)
if [[ -n "$unexpected_files" ]]; then
    stop "main changed more than the dependencies since $last_tag, release it by hand: $(paste -sd ' ' <<< "$unexpected_files")"
fi

old_json=$(git show "$last_tag:composer.json")
new_json=$(git show "$main_ref:composer.json")

if [[ "$(jq -S 'del(.require, ."require-dev")' <<< "$old_json")" != "$(jq -S 'del(.require, ."require-dev")' <<< "$new_json")" ]]; then
    stop "composer.json changed outside of require since $last_tag, release it by hand"
fi

# The first version number in a constraint, padded to major.minor.patch: ~13.3.23 -> 13.3.23, ^13 -> 13.0.0
version_of() {
    local version
    version=$(grep -oE '[0-9]+(\.[0-9]+){0,2}' <<< "$1" | head -n1 || true)
    [[ -n "$version" ]] || return 1
    awk -F. '{ printf "%d.%d.%d", $1, $2, $3 }' <<< "$version"
}

level_rank() {
    case "$1" in
        major) echo 3 ;;
        minor) echo 2 ;;
        patch) echo 1 ;;
        *) echo 0 ;;
    esac
}

level=none
updates=()

# Unit separator instead of a tab: read collapses consecutive tabs and would lose an empty field
while IFS=$'\x1f' read -r package old_constraint new_constraint; do
    [[ "$old_constraint" != "$new_constraint" ]] || continue

    if [[ -z "$old_constraint" ]]; then
        stop "\`$package\` was added since $last_tag, release it by hand"
    fi
    if [[ -z "$new_constraint" ]]; then
        stop "\`$package\` was removed since $last_tag, release it by hand"
    fi
    if [[ "$package" != */* ]]; then
        stop "the platform requirement \`$package\` changed since $last_tag, release it by hand"
    fi

    old_version=$(version_of "$old_constraint") || stop "cannot read a version from \`$package: $old_constraint\`"
    new_version=$(version_of "$new_constraint") || stop "cannot read a version from \`$package: $new_constraint\`"
    IFS=. read -r old_major old_minor _ <<< "$old_version"
    IFS=. read -r new_major new_minor _ <<< "$new_version"

    if [[ "$old_major" != "$new_major" ]]; then
        package_level=major
    elif [[ "$old_minor" != "$new_minor" ]]; then
        package_level=minor
    else
        package_level=patch
    fi

    summary "- \`$package\`: \`$old_constraint\` → \`$new_constraint\` ($package_level)"
    updates+=("\`$package\` to \`$new_constraint\`")

    if (( $(level_rank "$package_level") > $(level_rank "$level") )); then
        level=$package_level
    fi
done < <(jq -rn --argjson old "$old_json" --argjson new "$new_json" '
    ($old.require // {}) as $o | ($new.require // {}) as $n
    | ([$o, $n] | map(keys) | add | unique)[]
    | [., ($o[.] // ""), ($n[.] // "")] | join("\u001f")')

[[ "$level" != none ]] || stop "no dependency in require changed since $last_tag"

case "$level" in
    major) switch=${RELEASE_MAJOR:-false}; version="$((last_major + 1)).0.0" ;;
    minor) switch=${RELEASE_MINOR:-false}; version="$last_major.$((last_minor + 1)).0" ;;
    patch) switch=${RELEASE_PATCH:-false}; version="$last_major.$last_minor.$((last_patch + 1))" ;;
esac

if [[ "$switch" != true ]]; then
    stop "the dependencies call for the $level release v$version, but $level releases are switched off"
fi

tag="v$version"
branch="release/v${version%.*}"

if git rev-parse -q --verify "refs/tags/$tag" > /dev/null; then
    stop "the tag $tag already exists"
fi

if [[ "$level" == patch ]]; then
    # A patch continues the series of the last release on its maintenance branch
    git rev-parse -q --verify "refs/remotes/$remote/$branch" > /dev/null \
        || stop "the maintenance branch $branch of $last_tag does not exist"
    git checkout -q -B "$branch" "$remote/$branch"
    if ! git merge -q --no-ff --signoff -m "Merge branch 'main' into $branch" "$main_ref"; then
        git merge --abort
        stop "merging main into $branch conflicts, release it by hand"
    fi
else
    # A new major or minor opens its own maintenance branch. The changelog of main
    # never receives the release headings, so the history comes from the last release.
    if git rev-parse -q --verify "refs/remotes/$remote/$branch" > /dev/null; then
        stop "the maintenance branch $branch already exists"
    fi
    git checkout -q -B "$branch" "$main_ref"
    git show "$last_tag:CHANGELOG.md" > CHANGELOG.md
fi

if grep -qE '^## \[Unreleased\]' CHANGELOG.md; then
    stop "CHANGELOG.md on $branch has an [Unreleased] section, release it by hand"
fi

# "a, b and c"
joined=""
for i in "${!updates[@]}"; do
    if (( i == 0 )); then
        joined=${updates[$i]}
    elif (( i == ${#updates[@]} - 1 )); then
        joined="$joined and ${updates[$i]}"
    else
        joined="$joined, ${updates[$i]}"
    fi
done

entry="update $joined — running the whatwedo standard can report additional findings on code that passed under $last_version"
entry_lines=$(fold -s -w 86 <<< "$entry" | sed -e 's/ *$//' -e '1s/^/- /' -e '2,$s/^/  /')

section=$(printf '## [%s] - %s\n\n### Changed\n\n%s' "$version" "$(date +%F)" "$entry_lines")

# The new section goes above the newest release
awk -v section="$section" '
    !done && /^## \[/ { print section "\n\n"; done = 1 }
    { print }
    END { if (!done) print "\n" section }
' CHANGELOG.md > CHANGELOG.md.new
mv CHANGELOG.md.new CHANGELOG.md

git add CHANGELOG.md
git commit -q --signoff -m "docs(changelog): release $version"
git tag -a "$tag" -m "$tag"

summary ""
summary "Release \`$tag\` ($level) on \`$branch\`:"
summary ""
summary '```markdown'
summary "$section"
summary '```'

if [[ "$dry_run" == true ]]; then
    summary "**Dry run:** nothing was pushed."
    exit 0
fi

git push --atomic "$remote" "$branch" "$tag"
summary "**Released** \`$tag\`."
