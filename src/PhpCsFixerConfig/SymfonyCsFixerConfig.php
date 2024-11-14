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
        BaseCsFixerConfig::configure($config);
        Php38CsFixerConfig::configure($config);
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
        $existingRulues = $config->getRules();
        $config
            ->setRiskyAllowed(true)
            ->setRules(
                array_merge(
                    $existingRulues,
                    [
                        '@Symfony' => true,
                    ]
                )
            );
    }
}
