<?php

namespace whatwedo\PhpCodingStandard;

use PhpCsFixer;
use PhpCsFixer\ParallelAwareConfigInterface;
use whatwedo\PhpCodingStandard\PhpCsFixerConfig\WwdPhpCsFixerConfigInterface;

class PhpCsFixerConfigBuilder
{
    /**
     * @param class-string<WwdPhpCsFixerConfigInterface>[] $configs
     */
    public static function build(
        string $projectDir,
        array  $configs
    ): ParallelAwareConfigInterface
    {
        $excludes = self::buildExcludes($configs);

        $finder = new PhpCsFixer\Finder();
        $finder->in($projectDir)
            ->exclude($excludes);

        $config = new PhpCsFixer\Config();
        self::configure($config, $configs);
        $config->setFinder($finder)
            ->setRiskyAllowed(true)
            ->setRules(self::buildRules($configs));

        return $config;
    }

    private static function getNextOrder(array $rules, int $order)
    {
        while (array_key_exists($order, $rules)) {
            $order++;
        }
        return $order;
    }

    /**
     * @param class-string<WwdPhpCsFixerConfigInterface>[] $configs
     */
    private static function buildRules(array $configs): array
    {
        /**
         * @var array <int, <array<string, mixed>>
         */
        $rulesGroups = [];

        foreach ($configs as $config) {
            foreach ($config::getRules() as $order => $configRule) {
                $rulesGroups[self::getNextOrder($rulesGroups, $order)] = $configRule;
            }
        }

        // order rules from Configs
        ksort($rulesGroups);

        $rules = [];
        foreach ($rulesGroups as $rulesGroup) {
            foreach ($rulesGroup as $rule => $ruleSetting) {
                $rules[$rule] = $ruleSetting;
            }
        }

        return $rules;
    }

    /**
     * @param class-string<WwdPhpCsFixerConfigInterface>[] $configs
     */
    public static function dumpRules(array $configs)
    {
        var_dump(self::buildRules($configs));
    }

    /**
     * @param class-string<WwdPhpCsFixerConfigInterface>[] $configs
     */
    public static function dumpExcludes(array $configs)
    {
        var_dump(self::buildExcludes($configs));
    }

    /**
     * @param class-string<WwdPhpCsFixerConfigInterface>[] $configs
     */
    private static function buildExcludes(array $configs): array
    {
        $excludes = [];
        foreach ($configs as $config) {
            foreach ($config::getExcludes() as $configExclude) {
                $excludes[] = $configExclude;
            }
        }
        return $excludes;
    }

    private static function configure(PhpCsFixer\Config $config, array $configs)
    {
        /** @var WwdPhpCsFixerConfigInterface $configurationSet */
        foreach ($configs as $configurationSet) {
            $configurationSet::configure($config);
        }
    }
}
