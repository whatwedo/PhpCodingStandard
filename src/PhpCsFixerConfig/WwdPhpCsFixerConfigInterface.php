<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

interface WwdPhpCsFixerConfigInterface
{
    /**
     * @var array <int, <array<string, mixed>>
     */
    public static function getRules(): array;

    public static function getExcludes(): array;
}
