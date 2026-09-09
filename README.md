[![Latest Stable Version](https://poser.pugx.org/whatwedo/php-coding-standard/v/stable)](https://packagist.org/packages/whatwedo/php-coding-standard)

# PhpCodingStandard

This project is a set of coding standard rules, which we are using at [whatwedo](https://whatwedo.ch). It's heavily based on 
[Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard).

## Installation

We suggest to use Composer to install this project:

```
composer require --dev whatwedo/php-coding-standard
```


## Usage

You have to create an `ecs.php` file in your own project root directory and reference the set matching your
project type:

* Symfony projects: `WhatwedoSets::SYMFONY`
* WordPress projects: `WhatwedoSets::WORDPRESS`
* Any other PHP project: `WhatwedoSets::COMMON`

The Symfony and the WordPress set both include the common set, so there is no need to reference more than one.

Every set builds on [PER Coding Style 3.0](https://www.php-fig.org/per/coding-style/), the successor of
PSR-12. Coming from an older release, expect the first run to reformat existing code, most visibly by
adding a trailing comma to multiline argument and parameter lists. Imports keep being sorted
alphabetically, which PER-CS leaves open.

```php
<?php
declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use whatwedo\PhpCodingStandard\Set\WhatwedoSets;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSets([
        // Symfony project, see the list above for WordPress and plain PHP projects
        WhatwedoSets::SYMFONY,
    ]);
```

Then run the following command:

```
vendor/bin/ecs check
```

To fix certain issues automatically add `--fix` add the end

For other configuration options, check out [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard).


## Dependencies

* PHP >=7.4
* [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard)
* [kubawerlos/php-cs-fixer-custom-fixers](https://github.com/kubawerlos/php-cs-fixer-custom-fixers)
* [slevomat/coding-standard](https://github.com/slevomat/coding-standard)


## License

This bundle is under the MIT license. See the complete license in the bundle: [LICENSE](LICENSE)
