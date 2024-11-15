<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

class SymfonyCsFixerConfig implements WwdPhpCsFixerConfigInterface
{

    public static function getRules(): array
    {
        return [
            300 => ['@PHP83Migration' => true],
            400 => ['@Symfony' => true],
        ];
    }

    public static function getExcludes(): array
    {
        return [
            'assets',
            'bin',
            'config',
            'node_modules',
            'public',
            'vendor',
            'var',
        ];
    }
}
