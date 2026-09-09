# Changelog


## [Unreleased]

### Added

- `WhatwedoSets::COMMON`, `::SYMFONY` and `::WORDPRESS` carry the paths to the shipped
  sets, so an `ecs.php` references a class constant instead of spelling out
  `vendor/whatwedo/php-coding-standard/config/whatwedo-*.php` by hand — passing the file
  path keeps working

### Changed

- nine skips and one narrowing configuration are gone, so the rules they held back
  now apply as the sets intend: casts are spaced (`(int) $x`), comparisons drop the Yoda
  order (`$x === null`, and an existing `null === $x` is rewritten), `$i ++` becomes
  `$i++`, broken PHPDoc inline tags are normalised (`@{TAG}` to `{@TAG}`), `@return null`
  and `@subpackage` are dropped, a blank line follows the `namespace` statement, every
  call in a method chain is indented to one level, and every operator in a multiline
  expression moves to the beginning of the continuation line instead of only `&&` and
  `||`.
  Two of the overrides said nothing to begin with: the skip on `NoExtraBlankLinesFixer`
  had no effect, because `PER_CS` narrows that fixer to blank lines between imports and
  `NoBlankLineBetweenImportsFixer` already removes those, and the `position` set next to
  `only_booleans` was the php-cs-fixer default
- build every set on `SetList::PER_CS`, the PER Coding Style 3.0 successor of PSR-12,
  instead of `SetList::PSR_12` — the first run reformats existing code, most visibly by
  adding a trailing comma to multiline argument and parameter lists, and further by `fn()`
  spacing, `?int` type formatting, `Foo::bar` spacing and single-line empty bodies. Imports
  keep being sorted alphabetically and `declare()` parentheses keep being checked, both of
  which the PER-CS set leaves to the caller
- drop `SetList::CLEAN_CODE` (imported by `SetList::COMMON` in full) and 17 skips that
  targeted rules no longer shipped by any ECS 13 set; the effective checker list is
  unchanged
- require PHP 8.2 or newer, up from 7.4. The dependencies still install on 7.4, so this
  is a floor set on purpose: the standard is only run and verified on PHP versions that
  still receive security support
- update to `symplify/easy-coding-standard ^13.3.2`, which bundles php-cs-fixer 3.95 and
  PHP_CodeSniffer 4 — running the whatwedo standard can report additional findings on
  code that passed under ECS 12
- allow `kubawerlos/php-cs-fixer-custom-fixers ^3` and `slevomat/coding-standard ^8`
  again, the version caps ECS 12 needed are no longer required

### Removed

- the two Squiz commenting sniffs are gone, so `@throws` tags and the style of class
  docblocks are no longer checked. `FunctionCommentThrowTagSniff` reads a single method
  body and demands a tag for every `throw` it finds there, which on typed code is noisier
  and less accurate than PHPStan, who follows the call chain. `ClassCommentSniff` was
  registered with its `.Missing` code skipped, so it never asked for a docblock in the
  first place and only policed the shape of the ones that exist

### Fixed

- the file header keeps its own copyright. `FileCommentSniff` is hardcoded to Squiz
  Pty Ltd: `ecs --fix` rewrote `@copyright 2026 whatwedo GmbH` to
  `@copyright 2026 Squiz Pty Ltd (ABN 77 084 670 600)` and asked for
  `@author Squiz Pty Ltd <products@squiz.net>`. A file carrying a `/** */` header also
  never converged, because the sniff went on reporting `MissingPackageTag`,
  `MissingSubpackageTag`, `PackageTagOrder` and `SpacingAfterOpen`, none of them fixable

- `?bool` parameter and return types keep their nullability. `NoNullableBooleanTypeFixer`
  is a risky fixer that rewrites `?bool` to `bool` without touching the body, so
  `ecs --fix` turned working tri-state code into a `TypeError` at the next call with
  `null`. ECS applies risky fixers unconditionally, it has no `--allow-risky` gate, so
  the rule is gone instead of being switched off

- enum cases stay at the top of the enum. The element order configured for
  `OrderedClassElementsFixer` never listed `case`, and every type the list omits is
  sorted to the end, so `ecs --fix` moved the cases of a correctly written enum below
  its methods. The own order is gone entirely rather than patched: `PER_CS` configures
  the fixer as `order => ['use_trait']`, which sorts trait imports to the top and leaves
  every other element where it stands. The cost is that the order of properties,
  constants and methods is no longer enforced — only trait imports are


## [1.3.0] - 2024-05-21

### Changed

- update to `symplify/easy-coding-standard ^12`
