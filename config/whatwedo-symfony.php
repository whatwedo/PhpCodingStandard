<?php

declare(strict_types=1);

use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(NoDoctrineMigrationsGeneratedCommentFixer::class);

    $parameters = $containerConfigurator->parameters();
    
    // Import needs to be at the end - SKIP isn't merging (https://github.com/symplify/symplify/issues/2906)
    $containerConfigurator->import(SetList::SYMFONY);
    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');
};
