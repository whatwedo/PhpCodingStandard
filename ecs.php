<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $config): void {
    $config->paths([
        'src',
        'tests',
    ]);
    $config->skip([]);
    $config->import('vendor/whatwedo/php-coding-standard/config/whatwedo-common.php');
};
