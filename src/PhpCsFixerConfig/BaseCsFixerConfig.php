<?php

namespace whatwedo\PhpCodingStandard\PhpCsFixerConfig;

use PhpCsFixer\ConfigInterface;

class BaseCsFixerConfig implements WwdPhpCsFixerConfigInterface
{
    public static function getRules(): array
    {
        return [
            100 => ['@Symfony' => true],
            10000 => ['strict_param' => true],
            11001 => [
                'function_declaration' => [
                    'closure_fn_spacing' => 'none'
                ],
                'phpdoc_to_return_type' => true,
                'phpdoc_to_param_type' => true,
                \PhpCsFixerCustomFixers\Fixer\NoNullableBooleanTypeFixer::name() => true,
                \PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer::name() => true,
                'single_line_empty_body' => true, //reset @Syfmony setting
                'trailing_comma_in_multiline' => [ //reset @Syfmony setting
                    'after_heredoc' => true,
                    'elements' => [
                        'arguments',
                        'array_destructuring',
                        'arrays',
                        'match',
                        'parameters'
                    ]
                ],
                'phpdoc_to_comment' => false,
                'single_line_throw' => false,
            ],

        ];
    }

    public static function getExcludes(): array
    {
        return [];
    }

    public static function configure(ConfigInterface $config): void
    {
        $config->registerCustomFixers(new \PhpCsFixerCustomFixers\Fixers());
    }


}
