<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SKIP, [
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\ClassCommentSniff::class . '.Missing' => null,
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff::class . '.Missing' => null,
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff::class . '.MissingPackageTag' => null,
        PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\FileCommentSniff::class . '.WrongStyle' => null,
    ]);
};