# Contributing

Thanks for taking the time to contribute to `whatwedo/php-coding-standard`.

This package defines the default PHP coding standard at [whatwedo](https://whatwedo.ch). Every change here
lands in a lot of downstream projects, so the rules below are mainly about keeping upgrades predictable.

## Getting started

```bash
git clone git@github.com:whatwedo/PhpCodingStandard.git
cd PhpCodingStandard
make install
```

Before opening a pull request, run the coding standard on this repository itself:

```bash
make ecs
```

## Branches

| Branch                         | Purpose                                                            |
|--------------------------------|--------------------------------------------------------------------|
| `main`                         | Active development, becomes the next release.                      |
| `release/vX.Y`                 | Maintenance branch of a released series (e.g. `release/v1.3`).     |
| `feature/*`, `fix/*`, `docs/*` | Working branches, branched off `main` or off a maintenance branch. |
| `old/*`                        | Historical branches, not maintained.                               |

Older versions are maintained in their `release/vX.Y` branch — that is where patch releases for a series
come from. `main` never gets a version bump backported to it; it always moves forward.

### Fixing an older version

1. Branch off the maintenance branch: `git checkout -b fix/<topic> release/vX.Y`.
2. Open the pull request **against `release/vX.Y`**, not against `main`.
3. Add the changelog entry in that branch.
4. Release from there (see [Releasing](#releasing)).
5. If the same problem exists in the current series, apply it to `main` as well — cherry-pick the commit
   (`git cherry-pick -x <sha>`) instead of merging the maintenance branch into `main`.

## Workflow

1. Create a branch off `main`: `feature/<topic>`, `fix/<topic>` or `docs/<topic>`.
   For a fix to an already released series, branch off `release/vX.Y` instead (see above).
2. Keep commits small and atomic; use [Conventional Commits](https://www.conventionalcommits.org/)
   (`feat:`, `fix:`, `chore(deps):`, `docs:`, …).
3. Open a pull request against `main` and describe *what changes for consuming projects*
   (new/removed rules, expected diff after running `ecs --fix`).
4. Add an entry to [CHANGELOG.md](CHANGELOG.md) under `[Unreleased]`.

## Versioning

We follow [Semantic Versioning](https://semver.org/). What counts as "breaking" is defined by the effect on
consuming projects, not by our public PHP API — the API of this package is effectively the rule set.

| Change                                                       | Release   |
|--------------------------------------------------------------|-----------|
| **Major version bump of a dependency** (see below)           | **major** |
| Adding, removing or reconfiguring a rule/fixer               | minor     |
| Raising the minimum PHP version                              | major     |
| Minor/patch bump of a dependency, docs, internal refactoring | patch     |

### Dependency majors trigger a major release

**Every major update of one of our dependencies triggers a major release of this package.**

This applies to all packages in the `require` section of [composer.json](composer.json):

* [`symplify/easy-coding-standard`](https://github.com/easy-coding-standard/easy-coding-standard)
* [`kubawerlos/php-cs-fixer-custom-fixers`](https://github.com/kubawerlos/php-cs-fixer-custom-fixers)
* [`slevomat/coding-standard`](https://github.com/slevomat/coding-standard)

Why: a major version of ECS (and with it PHP-CS-Fixer / PHP_CodeSniffer) changes rule behaviour, renames or
removes fixers and can raise the required PHP version. Consuming projects then get a different `ecs --fix`
output — or a Composer conflict — from what was previously a "harmless" update. Expressing that as a major
version lets every project decide when to take the change instead of being surprised by it.

Practically this means:

* Bump the dependency constraint in `composer.json` (e.g. `"symplify/easy-coding-standard": "^13.0"`).
* Do **not** widen a constraint across a major boundary (no `^12 || ^13`) — one major of this package
  targets one major of ECS.
* Adjust the rule sets in `config/` and `src/` to the new dependency major, so that consuming projects only
  have to bump one version.
* Document the upgrade in the changelog: which dependency, which major, and what a project has to expect
  after running `ecs --fix`.

If a dependency major turns out to be purely internal and changes nothing for consuming projects, say so in
the pull request — but still release it as a major. Predictability beats a lower version number.

## Releasing

Every tag is created on a `release/vX.Y` branch, never on `main`.

**New major or minor (`vX.Y.0`)**

1. Merge everything that belongs into the release into `main`.
2. Create the maintenance branch for the series: `git checkout -b release/vX.Y main`.
3. Move the `[Unreleased]` section of `CHANGELOG.md` to the new version with the release date.
4. Tag it: `git tag -a vX.Y.0 -m "vX.Y.0" && git push origin release/vX.Y vX.Y.0`.

**Patch of an existing series (`vX.Y.Z`)**

1. Merge the fix into `release/vX.Y`.
2. Add the changelog entry for the new version there.
3. Tag it: `git tag -a vX.Y.Z -m "vX.Y.Z" && git push origin release/vX.Y vX.Y.Z`.

Packagist picks up the tags automatically. A maintenance branch stays open as long as we still ship
patches for that series; once it is dropped, no further tags are created on it.

## License

By contributing you agree that your contribution is licensed under the [MIT license](LICENSE).
