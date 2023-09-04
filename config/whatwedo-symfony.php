<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([__DIR__.'/whatwedo-common.php']);
    $ecsConfig->rule(NoDoctrineMigrationsGeneratedCommentFixer::class);
    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class, [
        'spacing' => 'none',
    ]);
};
