# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a repository for managing and distributing Cursor AI rules, particularly focused on web development with strong emphasis on PHP/Drupal, frontend frameworks, and security best practices. The project provides an interactive PHP installer that allows developers to selectively install rule sets into their projects.

## Common Development Tasks

### Running Tests
```bash
# Run all tests
cd .tests && ./run-all-tests.sh

# Run individual test scripts
cd .tests
./test-copy.sh              # Test basic installation functionality
./test-debug.sh             # Test debug mode
./test-invalid-option.sh    # Test invalid option handling
./test-conflicting-options.sh  # Test conflicting options
./test-missing-files.sh     # Test missing file handling
```

### Testing the Installer
```bash
# Test installation interactively
php install.php

# Test with specific options
php install.php --core           # Install core rules only
php install.php --web-stack      # Install web stack rules (includes core)
php install.php --python         # Install Python rules (includes core)
php install.php --all            # Install all rules

# Test with debug mode
php install.php --debug --core

# Test installation to custom directory
php install.php --all --destination=my/custom/path
```

### Linting and Code Quality
- PHP syntax validation: `php -l install.php`
- No specific linting commands configured - consider adding phpcs/phpmd

## Architecture and Code Structure

### Project Organization
- **install.php**: Main installer script (v1.0.4) - Uses builder and strategy patterns for rule set installation
- **.cursor/rules/**: Contains 56 MDC rule files organized by category
- **.tests/**: Bash test scripts for installer validation
- **.github/workflows/**: CI/CD pipeline using GitHub Actions for PHP 8.3

### Rule Categories
1. **Core Rules** (7 files): Git standards, testing guidelines, README maintenance
2. **Web Development Rules**:
   - Frontend: JavaScript, React, Vue, Tailwind, accessibility
   - Backend: PHP/Drupal standards, database, GovCMS
   - Security: OWASP Top 10 implementations for Drupal
   - DevOps: Docker, Lagoon, Vortex configurations
3. **Python Rules** (10 files): Security-focused rules following OWASP standards

### Key Design Patterns
- **Installer Architecture**:
  - Stateless design - each execution is independent
  - Builder pattern for rule set construction
  - Strategy pattern for interactive vs non-interactive modes
  - Factory pattern for rule set management

### Installation Flow
1. User executes install.php (directly or via curl)
2. Script detects if running interactively or with parameters
3. Creates .cursor/rules directory structure
4. Downloads and installs selected rule files from GitHub
5. Creates UPDATE.md file to track version

## Important Considerations

### When Adding New Rules
- Follow MDC format (Markdown with custom rule syntax)
- Place in appropriate category under .cursor/rules/
- Update the rule arrays in install.php (core_rules, web_stack_rules, python_rules)
- Add rule to README.md documentation table
- Consider rule dependencies (e.g., web stack includes core rules)

### When Modifying the Installer
- Maintain PHP 8.3+ compatibility
- Preserve both interactive and non-interactive modes
- Update CURSOR_RULES_VERSION constant when making changes
- Ensure all tests pass before committing
- Test with both local files and GitHub downloads

### Testing Guidelines
- All tests are bash scripts in .tests/ directory
- Tests use temporary directories to avoid affecting the actual installation
- Each test should output clear success/failure messages
- GitHub Actions runs all tests on push/PR to main branch

## Security Considerations
- Never commit sensitive information or API keys
- Rule files should not contain hardcoded credentials
- Installer validates file permissions and directory creation
- Downloaded files are fetched over HTTPS from GitHub

## Contributing
- Follow conventional commits format (fix:, feat:, docs:, etc.)
- Update relevant documentation when adding features
- Ensure all tests pass before submitting PR
- New rules should include clear descriptions and examples