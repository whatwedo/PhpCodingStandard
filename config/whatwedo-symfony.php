<?php

declare(strict_types=1);

use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(NoDoctrineMigrationsGeneratedCommentFixer::class);

    $parameters = $containerConfigurator->parameters();

    // Import needs to be at the end - SKIP isn't merging (https://github.com/symplify/symplify/issues/2906)
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');
};
