<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use whatwedo\PhpCodingStandard\Set\WhatwedoSets;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
    ])
    ->withSets([
        WhatwedoSets::COMMON,
    ]);
