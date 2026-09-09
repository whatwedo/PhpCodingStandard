<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareParenthesesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use whatwedo\PhpCodingStandard\Set\WhatwedoSets;

return ECSConfig::configure()
    ->withSets([
        SetList::COMMON,
        SetList::PER_CS,
        WhatwedoSets::RULES,
    ])
    ->withRules([
        // the only PSR-12 rule that PER-CS 3.0 does not cover
        DeclareParenthesesFixer::class,
    ])
    ->withConfiguredRule(OrderedImportsFixer::class, [
        'imports_order' => ['class', 'function', 'const'],
        // PER-CS leaves the order of imports open and the set turns sorting off,
        // while the whatwedo standard has always sorted them alphabetically
        'sort_algorithm' => 'alpha',
    ])
    ->withParallel();
