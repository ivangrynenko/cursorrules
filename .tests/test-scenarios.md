# Cursor Rules Installer Test Scenarios

This document outlines the test scenarios for the Cursor Rules installer script.

## ⚠️ Important Note

**Core rules are always included** in all installation types (web-stack, python, all). This ensures that essential functionality such as Git commit standards, readme maintenance standards, and Cursor rules efficiency improvements are available regardless of the selected installation option.

## CLI Options to Test

| Option | Short | Description |
|--------|-------|-------------|
| `--web-stack` | `-w` | Install core, web, and Drupal rules |
| `--python` | `-p` | Install core and Python rules |
| `--all` | `-a` | Install all rule sets (includes all core, web, Drupal, and Python rules) |
| `--core` | `-c` | Install only core rules |
| `--custom` | | Enable selective installation (interactive) |
| `--help` | `-h` | Display help information |
| `--quiet` | `-q` | Suppress verbose output |
| `--yes` | `-y` | Automatically confirm all prompts |

## Test Scenarios

### Basic Installation Tests

1. **Web Stack Installation**
   - Command: `php install.php --web-stack`
   - Expected: Core, web, and Drupal rules installed

2. **Python Installation**
   - Command: `php install.php --python`
   - Expected: Core and Python rules installed

3. **All Rules Installation**
   - Command: `php install.php --all`
   - Expected: All rule sets installed (core, web, Drupal, and Python)

4. **Core Rules Installation**
   - Command: `php install.php --core`
   - Expected: Only core rules installed

5. **Custom Selection**
   - Command: `php install.php --custom`
   - Expected: Interactive prompts for selecting rule sets (core rules remain mandatory)

6. **Help Information**
   - Command: `php install.php --help`
   - Expected: Display help information and exit

### Option Combination Tests

7. **Web Stack with Auto-confirm**
   - Command: `php install.php --web-stack --yes`
   - Expected: Web stack rules installed without confirmation prompts

8. **Python with Quiet Mode**
   - Command: `php install.php --python --quiet`
   - Expected: Python rules installed with minimal output

9. **All Rules with Auto-confirm and Quiet Mode**
   - Command: `php install.php --all --yes --quiet`
   - Expected: All rules installed without prompts and minimal output

10. **Core Rules with Short Options**
    - Command: `php install.php -c -y -q`
    - Expected: Core rules installed without prompts and minimal output

### Edge Case Tests

11. **Invalid Option**
    - Command: `php install.php --invalid-option`
    - Expected: Error message and help information

12. **Conflicting Options**
    - Command: `php install.php --web-stack --python`
    - Expected: Error message about conflicting options

13. **Directory Creation**
    - Precondition: Remove .cursor/rules directory
    - Command: `php install.php --core --yes`
    - Expected: Directory created and core rules installed

14. **File Overwriting**
    - Precondition: Create .cursor/rules with existing files
    - Command: `php install.php --core --yes`
    - Expected: Existing files overwritten with new versions

## Test Environment Setup

Each test should run in its own clean environment to avoid interference between tests. The test runner will:

1. Create a temporary test directory
2. Copy the installer script to the test directory
3. Run the test command
4. Verify the results
5. Clean up the test directory

## Success Criteria

A test is considered successful if:

1. The command exits with the expected status code
2. The expected files are installed in the correct locations
3. The output matches the expected pattern (for help, error messages, etc.)
4. No unexpected files are created or modified 