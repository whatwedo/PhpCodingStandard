[![Latest Stable Version](https://poser.pugx.org/whatwedo/php-coding-standard/v/stable)](https://packagist.org/packages/whatwedo/php-coding-standard)

# PhpCodingStandard

This project is a set of coding standard rules, which we are using at [whatwedo](https://whatwedo.ch). It's heavily based on [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard).
It's based on PER Coding Style 2.0 (https://www.php-fig.org/per/coding-style/).

## Installation

We suggest to use Composer to install this project:

```
composer require whatwedo/php-coding-standard
```


## Usage

### Without custom configuration

You can run the checks without project specific configuration using one of following commands:

```
vendor/bin/ecs check SRC_DIRECTORY --config vendor/whatwedo/php-coding-standard/config/whatwedo-common.php
```

### With custom configuration

But we suggest to create an `ecs.php` file in your own project root directory.
There's a sample configuration file in the root of this repository.

```php
<?php
declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $config): void {
    /*
    // Remove rules with $config->skip()
    $config->skip([
        SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff::class => null,

        // Explicitly remove some rules in a specific files
        PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer::class => [
            __DIR__ . '/PATH/FILE.php'
        ],
    ]);
    */

    // This need to come last
    $config->sets([__DIR__ . '/vendor/whatwedo/php-coding-standard/config/whatwedo-common.php']);
};
```

Then run the following command:

```
vendor/bin/ecs check SRC_DIRECTORY
```

To fix certain issues automatically add `--fix` add the end

For other configuration options, check out [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard).

## Usage with PHP CS Fixer *Experimental*

add `.php-cs-fixer.dist.php` in your project

```php
<?php

use whatwedo\PhpCodingStandard\PhpCsFixerConfig\BaseCsFixerConfig;
use whatwedo\PhpCodingStandard\PhpCsFixerConfigBuilder;

$configs = [
    BaseCsFixerConfig::class,
];
//PhpCsFixerConfigBuilder::dumpRules($configs);
//PhpCsFixerConfigBuilder::dumpExcludes($configs);


$config = PhpCsFixerConfigBuilder::build(__DIR__, $configs);

return $config;
```

## Dependencies

* PHP >=7.4
* [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard)
* [kubawerlos/php-cs-fixer-custom-fixers](https://github.com/kubawerlos/php-cs-fixer-custom-fixers)
* [slevomat/coding-standard](https://github.com/slevomat/coding-standard)


## License

This bundle is under the MIT license. See the complete license in the bundle: [LICENSE](LICENSE)
