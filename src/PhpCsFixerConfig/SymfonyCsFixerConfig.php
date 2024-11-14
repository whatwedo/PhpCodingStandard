<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

use PhpCsFixer;

class SymfonyCsFixerConfig implements WwdPhpCsFixerConfigInterface
{
    public static function createConfig(string $projectDir): PhpCsFixer\ConfigInterface
    {
        $finder = new PhpCsFixer\Finder();
        self::configureFinder($finder, $projectDir);

        $config = new PhpCsFixer\Config();
        $config->setFinder($finder);
        self::configure($config);
        return $config;
    }


    public static function configureFinder(PhpCsFixer\Finder $finder, string $projectDir)
    {
        $finder->in($projectDir)
            ->exclude([
                    'assets',
                    'bin',
                    'config',
                    'node_modules',
                    'public',
                    'vendor',
                    'var',
                ]
            );
    }

    public static function configure(PhpCsFixer\ConfigInterface $config)
    {

        $config
            ->setRiskyAllowed(true)
            ->setRules(
                [
                    '@PER-CS' => true,
                    '@PSR12' => true,
                    '@PHP83Migration' => true,
                    '@Symfony' => true,
                    'strict_param' => true,
                    // make ecs compatible
                    'phpdoc_to_comment' => false,
                    'single_line_throw' => false,
                ]

            );
    }
}
