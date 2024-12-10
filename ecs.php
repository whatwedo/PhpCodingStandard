<?php

/*
 * This file is used to check the coding standards itself in this project.
 */

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/',
    ]);
    $ecsConfig->import('config/whatwedo-common.php');
};
