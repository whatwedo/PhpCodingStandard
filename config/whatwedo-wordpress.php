<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SKIP, [
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\ClassCommentSniff::class . '.Missing' => null,
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff::class . '.Missing' => null,
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff::class . '.MissingPackageTag' => null,
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff::class . '.WrongStyle' => null,
    ]);
    // Import needs to be at the end - SKIP isn't merging (https://github.com/symplify/symplify/issues/2906)
    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');
};