#!/usr/bin/env bash
#
# Runs every shipped set the way a project uses it: an ecs.php that references
# the set, checking a copy of this package's own code. A set that fails to load,
# a fixer that crashes or a fix that does not settle in one pass fails the run.

set -euo pipefail

for set in COMMON SYMFONY WORDPRESS; do
    echo "::group::WhatwedoSets::${set}"

    project=$(mktemp -d)
    cp -r src config "${project}/"
    cat > "${project}/ecs.php" <<PHP
<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use whatwedo\PhpCodingStandard\Set\WhatwedoSets;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
    ])
    ->withSets([
        WhatwedoSets::${set},
    ]);
PHP

    # The first pass may change the copy, the set only has to apply without errors
    vendor/bin/ecs check --config "${project}/ecs.php" --fix --clear-cache --no-progress-bar || true
    # The second pass proves the fixes settled and no checker reported a system error
    vendor/bin/ecs check --config "${project}/ecs.php" --clear-cache --no-progress-bar

    rm -rf "${project}"
    echo "::endgroup::"
done
