[![Latest Stable Version](https://poser.pugx.org/whatwedo/php-coding-standard/v/stable)](https://packagist.org/packages/whatwedo/php-coding-standard)

# PhpCodingStandard

This project is a set of coding standard rules, which we are using at [whatwedo](https://whatwedo.ch). It's heavily based on [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard).

## Installation

We suggest to use Composer to install this project:

```
composer require whatwedo/php-coding-standard
```


## Usage

### Without custom configuration

You can run the checks without project specific configuration using one of following commands:

```
vendor/bin/ecs check SRC_DIRECTORY --config vendor/whatwedo/php-coding-standard/config/whatwedo-symfony.php # Symfony projects
vendor/bin/ecs check SRC_DIRECTORY --config vendor/whatwedo/php-coding-standard/config/whatwedo-wordpress.php # WordPress projects
vendor/bin/ecs check SRC_DIRECTORY --config vendor/whatwedo/php-coding-standard/config/whatwedo-common.php # Common PHP projects
```


### With custom configuration

If you want to add additional checkers or exclude files, you have to create an `ecs.php` file in your own project root directory.

```php
<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    // Modify rules with $parameters->set()

    // Import needs to be at the end - SKIP isn't merging (https://github.com/symplify/symplify/issues/2906)
    $containerConfigurator->import(__DIR__. '/vendor/whatwedo/php-coding-standard/config/whatwedo-common.php');
};
```

Then run the following command:

```
vendor/bin/ecs check SRC_DIRECTORY
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
