<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

$fixers = [
];

$fixers = array_merge(
    iterator_to_array(new whatwedo\PhpCodingStandard\Fixers()),
    iterator_to_array(new PhpCsFixerCustomFixers\Fixers()),
);

return (new PhpCsFixer\Config())
    ->registerCustomFixers($fixers)
    ->setRules([
        '@Symfony' => true,
        whatwedo\PhpCodingStandard\Fixer\DumpFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoNullableBooleanTypeFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer::name() => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)

;
