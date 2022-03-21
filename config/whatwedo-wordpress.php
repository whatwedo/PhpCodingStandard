<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // Import needs to be at the end - SKIP isn't merging (https://github.com/symplify/symplify/issues/2906)
    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');
};
