# Custom Command: Drupal Lint

## Command Usage
`/drupal-lint [scope]`

Use the optional `scope` argument to narrow linting (e.g., `php`, `js`, `all`). Omit it to run the full linting workflow. The sections below describe the available tools and when to use them.

# Linting Commands for Drupal Projects

This document provides comprehensive linting instructions for the Drupal project based on Vortex (DrevOps) configuration. When you refactoring existing code (as opposed to making minor adjustments), think harder.

## Quick Reference

### Model use
Use `chatgpt-5-high` model for all tasks

### Run All Linting
```bash
# Run all backend and frontend linting
ahoy lint

# Run only backend linting
ahoy lint-be

# Run only frontend linting
ahoy lint-fe

# Auto-fix linting issues (where possible)
ahoy lint-fix
```

## Backend Linting Tools

### 1. PHP CodeSniffer (PHPCS)

**Purpose**: Checks PHP code against Drupal coding standards.

```bash
# Run PHPCS on entire codebase
ahoy cli vendor/bin/phpcs

# Run on specific file or directory
ahoy cli vendor/bin/phpcs web/modules/custom/module_name

# Show specific sniffs being used
ahoy cli vendor/bin/phpcs -s

# Generate a report
ahoy cli vendor/bin/phpcs --report=summary

# Check specific standard violations
ahoy cli vendor/bin/phpcs --sniffs=Drupal.Commenting.FunctionComment
```

**Configuration**: `phpcs.xml`
- Standards: Drupal, DrupalPractice
- PHP Version: 8.3
- Checks custom modules, themes, and tests

### 2. PHP Code Beautifier and Fixer (PHPCBF)

**Purpose**: Automatically fixes PHPCS violations where possible.

```bash
# Auto-fix all fixable issues
ahoy cli vendor/bin/phpcbf

# Fix specific file or directory
ahoy cli vendor/bin/phpcbf web/modules/custom/module_name

# See what would be fixed without making changes
ahoy cli vendor/bin/phpcbf --dry-run
```

### 3. PHPStan

**Purpose**: Static analysis tool that finds bugs without running code.

```bash
# Run PHPStan analysis (Level 7)
ahoy cli vendor/bin/phpstan

# Run with memory limit
ahoy cli vendor/bin/phpstan --memory-limit=2G

# Analyze specific paths
ahoy cli vendor/bin/phpstan analyse web/modules/custom/module_name

# Clear cache and re-analyze
ahoy cli vendor/bin/phpstan clear-result-cache
ahoy cli vendor/bin/phpstan
```

**Configuration**: `phpstan.neon`
- Level: 7 (strict)
- Includes phpstan-drupal extension

### 4. PHP Mess Detector (PHPMD)

**Purpose**: Detects code smells and possible bugs.

```bash
# Run PHPMD
ahoy cli vendor/bin/phpmd . text phpmd.xml

# Check specific directory
ahoy cli vendor/bin/phpmd web/modules/custom/module_name text phpmd.xml

# Generate HTML report
ahoy cli vendor/bin/phpmd . html phpmd.xml > phpmd-report.html

# Check specific rules
ahoy cli vendor/bin/phpmd . text codesize,unusedcode
```

**Configuration**: `phpmd.xml`
- Rules: unusedcode, codesize, cleancode

### 5. Rector

**Purpose**: Automated refactoring and code upgrades.

```bash
# Dry run (preview changes)
docker compose exec -T cli bash -c "XDEBUG_MODE=off vendor/bin/rector --debug --ansi --memory-limit=2G --no-progress-bar --clear-cache --dry-run"

# Apply changes
docker compose exec -T cli bash -c "XDEBUG_MODE=off vendor/bin/rector --debug --ansi --memory-limit=2G --no-progress-bar --clear-cache"

# Process specific directory
docker compose exec -T cli bash -c "XDEBUG_MODE=off vendor/bin/rector process web/modules/custom/module_name --dry-run"
```

**Configuration**: `rector.php`
- Includes Drupal 8/9/10 upgrade rules
- Code quality improvements

## Frontend Linting Tools

### 6. Twig CS (Twig Coding Standards)

**Purpose**: Checks Twig template files for coding standards.

```bash
# Run Twig CS
ahoy cli vendor/bin/twigcs

# Check specific directory
ahoy cli vendor/bin/twigcs web/themes/custom/theme_name
```

### 7. Theme-specific Linting

**Purpose**: ESLint and Stylelint for JavaScript and CSS.

```bash
# Run theme linting (configured in package.json)
ahoy lint-fe

# Or manually for specific theme
ahoy cli "npm run --prefix web/themes/custom/demirs_ws lint"
ahoy cli "npm run --prefix web/themes/custom/demirs_cp lint"
```

## Common Linting Scenarios

### Before Committing Code
```bash
# Run all linters
ahoy lint

# If issues found, try auto-fix
ahoy lint-fix

# Re-run to check remaining issues
ahoy lint
```

### Module Development
```bash
# Check specific module
MODULE="demirs_file_cleanup"
ahoy cli vendor/bin/phpcs web/modules/custom/$MODULE
ahoy cli vendor/bin/phpstan analyse web/modules/custom/$MODULE
ahoy cli vendor/bin/phpmd web/modules/custom/$MODULE text phpmd.xml
```

### Fix Common Issues

#### Fix PHP Strict Types
```bash
# PHPCS requires strict types declaration
ahoy cli vendor/bin/phpcbf --standard=Generic --sniffs=Generic.PHP.RequireStrictTypes web/modules/custom/module_name
```

#### Fix Drupal Coding Standards
```bash
# Auto-fix Drupal standards
ahoy cli vendor/bin/phpcbf --standard=Drupal web/modules/custom/module_name
```

## Memory Considerations

For large codebases or memory-intensive operations:

```bash
# Increase memory for PHPStan
ahoy cli vendor/bin/phpstan --memory-limit=4G

# Run Rector with more memory
docker compose exec -T cli bash -c "XDEBUG_MODE=off vendor/bin/rector --memory-limit=4G --dry-run"

# Or set PHP memory limit for session
docker compose exec cli php -d memory_limit=-1 vendor/bin/phpcs
```

## Continuous Integration

These commands are typically run in CI/CD pipelines:

```bash
# CI-friendly output
ahoy cli vendor/bin/phpcs --report=junit
ahoy cli vendor/bin/phpstan --error-format=junit
```

## Troubleshooting

### Clear Caches
```bash
# Clear Drupal cache (may affect some tools)
ahoy drush cr

# Clear PHPStan cache
ahoy cli vendor/bin/phpstan clear-result-cache

# Clear Rector cache
rm -rf /tmp/rector_cached_files
```

### Debug Mode
```bash
# Verbose PHPCS
ahoy cli vendor/bin/phpcs -vvv

# Debug Rector
docker compose exec -T cli bash -c "vendor/bin/rector --debug --dry-run"
```

### Exclude Patterns

To temporarily exclude files/directories, modify the respective config files:
- PHPCS: Add to `<exclude-pattern>` in `phpcs.xml`
- PHPStan: Add to `excludePaths` in `phpstan.neon`
- PHPMD: Add to `<exclude>` in `phpmd.xml`

## Best Practices

1. **Run linting before commits**: Use git hooks or manually run `ahoy lint`
2. **Fix issues incrementally**: Start with auto-fixable issues using `ahoy lint-fix`
3. **Module-specific linting**: When developing a module, lint it specifically to get faster feedback
4. **Use appropriate memory limits**: For large codebases, increase memory limits as needed
5. **Keep tools updated**: Regularly update linting tools via Composer

## Common Errors and Solutions

### PHPDoc Parameter Name Mismatch
```
ParamNameNoMatch: Doc comment for parameter $some_service does not match actual variable name $someService
```
**Solution**: Ensure PHPDoc parameter names exactly match the actual parameter names in the function signature.

### Missing Strict Types Declaration
```
MissingDeclareStrictTypes: Missing declare(strict_types=1) statement
```
**Solution**: Add `declare(strict_types=1);` after the opening PHP tag in each file.

### TranslatableMarkup Type Errors
When entity labels return TranslatableMarkup objects instead of strings:
```php
// Convert to string
$label = (string) $entity->label();
```

## References

- [Vortex PHPCS Documentation](https://vortex.drevops.com/tools/phpcs)
- [Vortex PHPMD Documentation](https://vortex.drevops.com/tools/phpmd)
- [Vortex PHPStan Documentation](https://vortex.drevops.com/tools/phpstan)
- [Vortex Rector Documentation](https://vortex.drevops.com/tools/rector)
- [Drupal Coding Standards](https://www.drupal.org/docs/develop/standards)
