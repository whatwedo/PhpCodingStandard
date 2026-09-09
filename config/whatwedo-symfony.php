<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use whatwedo\PhpCodingStandard\Set\WhatwedoSets;

return ECSConfig::configure()
    ->withSets([
        WhatwedoSets::COMMON,
    ])
    ->withRules([
        NoDoctrineMigrationsGeneratedCommentFixer::class,
    ])
    // the Symfony coding standard concatenates without spaces, where the ECS sets use one;
    // this override is deliberate, do not drop it in favour of the sets
    ->withConfiguredRule(ConcatSpaceFixer::class, [
        'spacing' => 'none',
    ]);
