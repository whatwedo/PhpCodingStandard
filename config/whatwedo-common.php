<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ValidClassNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\ClassCommentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FunctionCommentThrowTagSniff;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\OperatorLinebreakFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocInlineTagNormalizerFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarAnnotationCorrectOrderFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoNullableBooleanTypeFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer;
use SlevomatCodingStandard\Sniffs\Commenting\ForbiddenAnnotationsSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use whatwedo\PhpCodingStandard\Fixer\DumpFixer;

return ECSConfig::configure()
    ->withSets([
        SetList::COMMON,
        SetList::PSR_12,
    ])
    ->withRules([
        ValidClassNameSniff::class,
        ClassCommentSniff::class,
        FileCommentSniff::class,
        FunctionCommentThrowTagSniff::class,
        NoImportFromGlobalNamespaceFixer::class,
        NoNullableBooleanTypeFixer::class,
        NoPhpStormGeneratedCommentFixer::class,
        PhpdocSelfAccessorFixer::class,
        PhpdocVarAnnotationCorrectOrderFixer::class,
        ForbiddenAnnotationsSniff::class,
        AssignmentInConditionSniff::class,
        DeadCatchSniff::class,
        UseFromSameNamespaceSniff::class,
        DumpFixer::class,
    ])
    ->withConfiguredRule(OrderedClassElementsFixer::class, [
        'order' => [
            'use_trait',
            'constant_public',
            'constant_protected',
            'constant_private',
            'property_public',
            'property_protected',
            'property_private',
            'construct',
            'destruct',
            'method_public',
            'method_protected',
            'method_private',
            'phpunit',
            'magic',
        ],
    ])
    ->withConfiguredRule(OperatorLinebreakFixer::class, [
        'only_booleans' => true,
        'position' => 'beginning',
    ])
    ->withSkip([
        AssignmentInConditionSniff::class => null,
        CastSpacesFixer::class => null,
        YodaStyleFixer::class => null,
        IsNullFixer::class => null,
        BlankLineAfterNamespaceFixer::class => null,
        NotOperatorWithSuccessorSpaceFixer::class => null,
        UnaryOperatorSpacesFixer::class => null,
        PhpdocInlineTagNormalizerFixer::class => null,
        PhpdocNoAliasTagFixer::class => null,
        PhpdocNoEmptyReturnFixer::class => null,
        PhpdocNoPackageFixer::class => null,
        MethodChainingIndentationFixer::class => null,
        NoExtraBlankLinesFixer::class => null,

        ClassCommentSniff::class . '.Missing' => null,
        FileCommentSniff::class . '.Missing' => null,
        FileCommentSniff::class . '.WrongStyle' => null,
        ValidClassNameSniff::class => ['**/whatwedo*.php'],
    ])
    ->withParallel();
