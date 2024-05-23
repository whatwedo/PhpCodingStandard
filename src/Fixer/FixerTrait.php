<?php

namespace whatwedo\PhpCodingStandard\Fixer;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Preg;

trait FixerTrait
{
    final public static function name(): string
    {
        $name = Preg::replace('/(?<!^)(?=[A-Z])/', '_', \substr(static::class, 33, -5));

        return 'WhatwedoPhpCodingStandards/' . \strtolower($name);
    }

    final public function getName(): string
    {
        return self::name();
    }

    final public function supports(\SplFileInfo $file): bool
    {
        return true;
    }
}
