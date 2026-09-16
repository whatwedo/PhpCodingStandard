<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ValidClassNameSniff;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use whatwedo\PhpCodingStandard\Fixer\DumpFixer;

/*
 * The whatwedo rules on top of a base set. The whatwedo-common set references this file
 * as its last set, so these entries win over the base set.
 */
return ECSConfig::configure()
    ->withRules([
        ValidClassNameSniff::class,
        NoImportFromGlobalNamespaceFixer::class,
        NoPhpStormGeneratedCommentFixer::class,
        PhpdocSelfAccessorFixer::class,
        DeadCatchSniff::class,
        UseFromSameNamespaceSniff::class,
        DumpFixer::class,
    ])
    ->withSkip([
        IsNullFixer::class => null,
        NotOperatorWithSuccessorSpaceFixer::class => null,
        PhpdocNoAliasTagFixer::class => null,

        // how a fluent chain is wrapped is the author's call, not the standard's
        MethodChainingNewlineFixer::class => null,
        MethodChainingIndentationFixer::class => null,

        // whatwedo bundle classes carry the lowercase vendor prefix (whatwedoCrudBundle),
        // which the sniff reads as a PascalCase violation
        ValidClassNameSniff::class => ['**/whatwedo*.php'],
    ]);
