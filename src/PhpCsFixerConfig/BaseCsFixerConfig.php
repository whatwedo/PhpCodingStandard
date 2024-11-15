<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

class BaseCsFixerConfig implements WwdPhpCsFixerConfigInterface
{
    public static function getRules(): array
    {
        return [
            100 => ['@PER-CS' => true],
            200 => ['@PSR12' => true],

            10000 => ['strict_param' => true],
            // make ecs compatible
            15000 => ['phpdoc_to_comment' => false],
            16000 => ['single_line_throw' => false],
        ];
    }

    public static function getExcludes(): array
    {
        return [];
    }
}
