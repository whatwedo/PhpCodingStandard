# Changelog


## [Unreleased]

### Changed

- drop `SetList::CLEAN_CODE` (imported by `SetList::COMMON` in full) and 17 skips that
  targeted rules no longer shipped by any ECS 13 set; the effective checker list is
  unchanged
- update to `symplify/easy-coding-standard ^13`, which bundles php-cs-fixer 3.95 and
  PHP_CodeSniffer 4 — running the whatwedo standard can report additional findings on
  code that passed under ECS 12
- allow `kubawerlos/php-cs-fixer-custom-fixers ^3` and `slevomat/coding-standard ^8`
  again, the version caps ECS 12 needed are no longer required


## [1.3.0] - 2024-05-21

### Changed

- update to `symplify/easy-coding-standard ^12`
