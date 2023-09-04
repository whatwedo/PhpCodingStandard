<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([__DIR__ . '/whatwedo-common.php']);
    $ecsConfig->rule(NoDoctrineMigrationsGeneratedCommentFixer::class);
    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class, [
        'spacing' => 'none',
    ]);
};
