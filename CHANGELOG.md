# Changelog

## v2.0.0 - December 2024

This version is a major release and includes breaking changes.
Adjust your configuration, apply the fixes and review code for the new version.

### PER Coding Style 2.0
PER Coding Style 2.0 (https://www.php-fig.org/per/coding-style/) was introduced.
This leads to some adjustments in the code which most probably can be autofixed with `ecs check --fix`.
Review your code after running the fixer.

Rules applied to the set can be found here: https://cs.symfony.com/doc/ruleSets/PER-CS2.0.html. This is the base from which we make our own small adjustments.
"Concat Space" for example, is a rule which has already been applied to the Symfony rule set in the past, which we enforce in the standard everywhere.

### Unify rule sets
Removed `whatwedo-wordpress.php` and `whatwedo-symfony.php` in favor of `whatwedo-common.php`. If you have used `whatwedo-symfony.php` or `whatwedo-wordpress.php`, you have to switch to `whatwedo-common.php` in the config.

### Update ECS Configuration
Update your configuration (`ecs.php`) to the new version and adjust to your preferences. See our example file in the root of this repository.

### Enforce types via PHP instead of DocBlocks
`PhpdocToReturnTypeFixer` and `PhpdocToParamTypeFixer` will enforce the types in the PHP code instead of the DocBlocks.
If you don't use PHPStan or similar for static type checking, that could be a problem for you since those types can be wrong. You can disable these fixers in your local configuration if you can't migrate them properly for now.

## Technical

### Changed
- Unify rule sets (https://github.com/whatwedo/PhpCodingStandard/issues/17)
- Minor update to `symplify/easy-coding-standard 12.4`

### Added
- DynamicSet `@PER-CS2.0` was added to the configuration (https://github.com/whatwedo/PhpCodingStandard/issues/19)
- Add `MultilinePromotedPropertiesFixer` (https://github.com/whatwedo/PhpCodingStandard/issues/27)
- Add `MultilinePromotedPropertiesFixer` (https://github.com/whatwedo/PhpCodingStandard/issues/27)
- Add `PhpdocToReturnTypeFixer` and `PhpdocToParamTypeFixer`
- `NoDoctrineMigrationsGeneratedCommentFixer` is now part of the default configuration (https://github.com/whatwedo/PhpCodingStandard/issues/16)
- `ConcatSpaceFixer` => `'spacing' => 'none'` is now part of the default configuration (https://github.com/whatwedo/PhpCodingStandard/issues/15)

### Removed
- Remove deprecated `NoTrailingCommaInListCallFixer`
- `AssignmentInConditionSniff` is skipped

---

## v1.2.5 - March 2024

### Changed

- Update to `symplify/easy-coding-standard ^12`
- Dump Fixer added
