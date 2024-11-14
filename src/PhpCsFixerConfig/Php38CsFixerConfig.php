<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

use PhpCsFixer;

class Php38CsFixerConfig
{
    public static function createFixer(string $projectDir): PhpCsFixer\ConfigInterface
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
;
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
                        '@PHP83Migration' => true,
                    ]
                )
            );
    }
}
