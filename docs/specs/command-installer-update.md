# Command Installer Update

**Date:** 2025-10-24

## Summary
- Added bundled Cursor slash commands to the installer workflow with interactive and non-interactive selection of install targets (project, home, both, or skip).
- Expanded automated tests to cover new command options and validation checks for both project and home installations.
- Refreshed documentation (`AGENTS.md`, `CHANGELOG.md`) and version metadata to reflect the new release (v1.0.8).
- Removed obsolete docs (`docs/prd.md`, `docs/srs.md`) while replacing project documentation with this concise specification record.

## Notes
- Installer reads bundled commands from `.cursor/commands` and mirrors them into the chosen destinations.
- Tests leverage `CURSOR_COMMAND_SOURCE` to provide the bundled command directory during simulated installs.
- Future updates should keep `COMMAND_FILES` in sync with the files stored under `.cursor/commands`.
