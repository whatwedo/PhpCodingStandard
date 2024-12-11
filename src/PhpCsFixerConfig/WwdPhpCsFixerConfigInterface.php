<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

use PhpCsFixer\ConfigInterface;

interface WwdPhpCsFixerConfigInterface
{
    /**
     * @var array <int, <array<string, mixed>>
     */
    public static function getRules(): array;

    public static function getExcludes(): array;

    public static function configure(ConfigInterface $config): void;
}
