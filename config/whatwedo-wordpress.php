<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // Import needs to be at the end - SKIP isn't merging (https://github.com/symplify/symplify/issues/2906)
    $containerConfigurator->import(__DIR__ . '/whatwedo-common.php');
};
