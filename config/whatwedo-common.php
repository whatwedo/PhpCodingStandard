<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\ControlStructures\InlineControlStructureSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\ScopeIndentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ValidClassNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\ClassCommentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FunctionCommentThrowTagSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ScopeClosingBraceSniff;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ControlStructure\NoTrailingCommaInListCallFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\OperatorLinebreakFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocInlineTagNormalizerFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarAnnotationCorrectOrderFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoNullableBooleanTypeFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer;
use SlevomatCodingStandard\Sniffs\Classes\TraitUseSpacingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\EmptyCommentSniff;
use SlevomatCodingStandard\Sniffs\Commenting\ForbiddenAnnotationsSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\ReferenceUsedNamesOnlySniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use whatwedo\PhpCodingStandard\DumpFixer\Fixer;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([SetList::CLEAN_CODE]);
    $ecsConfig->sets([SetList::COMMON]);
    $ecsConfig->sets([SetList::PSR_12]);

    $ecsConfig->rule(ValidClassNameSniff::class);
    $ecsConfig->rule(ClassCommentSniff::class);
    $ecsConfig->rule(FileCommentSniff::class);
    $ecsConfig->rule(FunctionCommentThrowTagSniff::class);
    $ecsConfig->ruleWithConfiguration(OrderedClassElementsFixer::class, [
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
    ]);
    $ecsConfig->rule(NoImportFromGlobalNamespaceFixer::class);
    $ecsConfig->rule(NoNullableBooleanTypeFixer::class);
    $ecsConfig->rule(NoPhpStormGeneratedCommentFixer::class);
    $ecsConfig->rule(PhpdocSelfAccessorFixer::class);
    $ecsConfig->rule(PhpdocVarAnnotationCorrectOrderFixer::class);
    $ecsConfig->rule(ForbiddenAnnotationsSniff::class);
    $ecsConfig->rule(AssignmentInConditionSniff::class);
    $ecsConfig->rule(DeadCatchSniff::class);
    $ecsConfig->rule(UseFromSameNamespaceSniff::class);
    $ecsConfig->rule(DumpFixer::class);

    $ecsConfig->ruleWithConfiguration(OperatorLinebreakFixer::class, [
        'only_booleans' => true,
        'position' => 'beginning',
    ]);

    $ecsConfig->skip([
        AssignmentInConditionSniff::class => null,
        InlineControlStructureSniff::class => null,
        ScopeIndentSniff::class => null,
        ScopeClosingBraceSniff::class => null,
        CastSpacesFixer::class => null,
        NoTrailingCommaInListCallFixer::class => null,
        YodaStyleFixer::class => null,
        IsNullFixer::class => null,
        BlankLineAfterNamespaceFixer::class => null,
        IncrementStyleFixer::class => null,
        NotOperatorWithSuccessorSpaceFixer::class => null,
        UnaryOperatorSpacesFixer::class => null,
        PhpdocAlignFixer::class => null,
        PhpdocInlineTagNormalizerFixer::class => null,
        PhpdocNoAliasTagFixer::class => null,
        PhpdocNoEmptyReturnFixer::class => null,
        PhpdocNoPackageFixer::class => null,
        PhpdocSeparationFixer::class => null,
        PhpdocSummaryFixer::class => null,
        PhpdocToCommentFixer::class => null,
        ReturnAssignmentFixer::class => null,
        StrictComparisonFixer::class => null,
        StrictParamFixer::class => null,
        BlankLineBeforeStatementFixer::class => null,
        MethodChainingIndentationFixer::class => null,
        NoExtraBlankLinesFixer::class => null,
        FinalInternalClassFixer::class => null,
        TraitUseSpacingSniff::class => null,
        EmptyCommentSniff::class => null,
        ReferenceUsedNamesOnlySniff::class => null,
        UselessVariableSniff::class => null,

        ClassCommentSniff::class . '.Missing' => null,
        FileCommentSniff::class . '.Missing' => null,
        FileCommentSniff::class . '.WrongStyle' => null,
        ValidClassNameSniff::class => ['**/whatwedo*.php'],
    ]);

    $ecsConfig->parallel();
};
