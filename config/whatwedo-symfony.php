<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([__DIR__ . '/whatwedo-common.php']);
    $ecsConfig->rule(NoDoctrineMigrationsGeneratedCommentFixer::class);
};
