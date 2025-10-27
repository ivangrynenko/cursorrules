# Changelog

All notable changes to this project are documented in this file. Entries appear in reverse chronological order so the most recent updates are always at the top. Do not overwrite existing content—prepend new releases instead.

## [1.1.0] - 2025-10-27
### Changed
- Restructured the full Cursor rule bundle set with consistent sections for details, filters, rejections, and suggestions to improve readability and maintenance.
- Incremented internal rule metadata versions across all affected files to reflect the new structure.

## [1.0.8] - 2025-10-24
### Added
- Integrated installation of Cursor slash commands, including project/home/both targets and new `--commands` / `--skip-commands` flags.
- Captured command installation outcomes in generated `AGENTS.md` and `UPDATE.md` files for downstream visibility.

### Changed
- Bumped `CURSOR_RULES_VERSION` to `1.0.8` in preparation for the next release cycle.

## [1.0.7] - 2025-09-02
### Changed
- Streamlined rule bundle organisation and refreshed documentation references to match the markdown migration.
- Tweaked installer configuration and associated file-mapping tests for the updated structure.

## [1.0.6] - 2025-08-20
### Changed
- Updated release metadata to version 1.0.6 in preparation for distribution.

## [1.0.5] - 2025-06-06
### Added
- Expanded pull-request review guidance with multi-language support, large-file detection, and improved security assessment coverage.

### Changed
- Updated installer metadata to version 1.0.5 and refreshed `.cursor/UPDATE.md` with detailed release notes.

## [0.1.0] - 2025-06-01
### Added
- Enhanced GitHub Actions workflow and extended automated test coverage for installer scenarios, including ignore-file and tag option handling.

### Changed
- Updated test utilities and file maps to support the expanded rule set.

## [0.0.2] - 2025-02-28
### Added
- Introduced local rule fallback logic to `install.php`, ensuring installation succeeds when remote downloads are unavailable.
- Added `testing-guidelines.mdc` to the default installation set and documented the new behaviour.

## [0.0.1] - 2025-02-12
### Changed
- Improved installer robustness with better piped-input handling, simplified error messaging, and streamlined logic.
