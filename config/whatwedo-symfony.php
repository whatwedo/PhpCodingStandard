<?php

declare(strict_types=1);

use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([__DIR__.'/whatwedo-common.php']);
    $ecsConfig->rule(NoDoctrineMigrationsGeneratedCommentFixer::class);
};
