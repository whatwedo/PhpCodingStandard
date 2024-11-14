<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;

interface WwdPhpCsFixerConfigInterface
{
    public static function createConfig(string $basePath);
    public static function configure(ConfigInterface $config);
    public static function configureFinder(Finder $finder, string $projectDir);

}
