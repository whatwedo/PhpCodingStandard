<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use whatwedo\PhpCodingStandard\Set\WhatwedoSets;

return ECSConfig::configure()
    ->withSets([
        WhatwedoSets::COMMON,
    ]);
