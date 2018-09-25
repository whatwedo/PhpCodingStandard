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
vendor/bin/ecs check src --config vendor/whatwedo/php-coding-standard/config/whatwedo-symfony.yml # Symfony projects
vendor/bin/ecs check src --config vendor/whatwedo/php-coding-standard/config/whatwedo-wordpress.yml # Wordpress projects
vendor/bin/ecs check src --config vendor/whatwedo/php-coding-standard/config/whatwedo-common.yml # Common PHP projects
```


### With custom configuration

If you want to add additional checkers or exclude files, you have to create an `easy-coding-standard.yml` in your own project root directory. Start with adding one checker of this project. 

```yaml
imports:
    - { resource: '%vendor_dir%/whatwedo/php-coding-standard/config/whatwedo-symfony.yml' } # Symfony projects only
    - { resource: '%vendor_dir%/whatwedo/php-coding-standard/config/whatwedo-wordpress.ym' } # Wordpress projects only
    - { resource: '%vendor_dir%/whatwedo/php-coding-standard/config/whatwedo-common.ym' } # Common projects only
```

For other configuration options, check out [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard).


## Dependencies

* PHP >=7.0
* [Simplify/EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard)
* [kubawerlos/php-cs-fixer-custom-fixers](https://github.com/kubawerlos/php-cs-fixer-custom-fixers)
* [slevomat/coding-standard](https://github.com/slevomat/coding-standard)


## License

This bundle is under the MIT license. See the complete license in the bundle: [LICENSE](LICENSE)
