<?php

namespace whatwedo\PhpCodingStandard;

use PhpCsFixer\Fixer\FixerInterface;

/**
 * @implements \IteratorAggregate<FixerInterface>
 */
final class Fixers implements \IteratorAggregate
{
    /**
     * @return \Generator<FixerInterface>
     */
    public function getIterator(): \Generator
    {
        $classNames = [];
        foreach (new \DirectoryIterator(__DIR__ . '/Fixer') as $fileInfo) {
            $fileName = $fileInfo->getBasename('.php');
            if (\in_array($fileName, ['.', '..', 'FixerTrait'], true)) {
                continue;
            }
            $classNames[] = __NAMESPACE__ . '\\Fixer\\' . $fileName;
        }

        \sort($classNames);

        foreach ($classNames as $className) {
            $fixer = new $className();
            \assert($fixer instanceof FixerInterface);

            yield $fixer;
        }
    }
}
