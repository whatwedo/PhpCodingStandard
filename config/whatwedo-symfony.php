<?php

declare(strict_types=1);

use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../symplify/easy-coding-standard/config/set/symfony.php');

    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');

    $services = $containerConfigurator->services();

    $services->set(NoDoctrineMigrationsGeneratedCommentFixer::class);

    $parameters = $containerConfigurator->parameters();

    $parameters->set(\Symplify\EasyCodingStandard\ValueObject\Option::SKIP, [
        \Symplify\CodingStandard\Sniffs\Naming\AbstractClassNameSniff::class => ['**/Entity/*.php'],
    ]);
};
