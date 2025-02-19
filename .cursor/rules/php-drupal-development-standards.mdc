---
description: Standards for PHP and Drupal development
globs: *.php, *.module, *.inc, *.install, *.theme
---
# Enhanced PHP and Drupal Development Standards

Ensures adherence to PHP 8.3+ features and Drupal development best practices for improved code quality, security, and maintainability.

<rule>
name: enhanced_php_drupal_development_standards
description: Enforce PHP 8.3+ and Drupal development standards
filters:
  - type: file_extension
    pattern: "\\.(php|module|inc|install|theme)$"
  - type: file_path
    pattern: "web/modules/custom/|web/themes/custom/"

actions:
  - type: enforce
    conditions:
      - pattern: "^(?!declare\\(strict_types=1\\);)"
        message: "Add 'declare(strict_types=1);' at the beginning of PHP files for type safety."

      - pattern: "class\\s+\\w+\\s*(?!\\{[^}]*readonly\\s+\\$)"
        message: "Consider using readonly properties where immutability is required for better code safety."

      - pattern: "public\\s+function\\s+\\w+\\([^)]*\\)\\s*(?!:)"
        message: "Add return type declarations for all methods to enhance type safety."

      - pattern: "extends\\s+\\w+\\s*\\{[^}]*public\\s+function\\s+\\w+\\([^)]*\\)\\s*(?!#\\[Override\\])"
        message: "Add #[Override] attribute for overridden methods for clear intent."

      - pattern: "\\$\\w+\\s*(?!:)"
        message: "Use typed properties with proper nullability to improve code readability and prevent errors."

      - pattern: "function\\s+hook_\\w+\\([^)]*\\)\\s*(?!:)"
        message: "Add type hints and return types for all hooks to leverage PHP's type system."

      - pattern: "new\\s+\\w+\\([^)]*\\)\\s*(?!;\\s*//\\s*@inject)"
        message: "Use proper dependency injection with services for better testability and modularity."

      - pattern: "extends\\s+FormBase\\s*\\{[^}]*validate"
        message: "Implement proper form validation in FormBase classes for security."

      - pattern: "(?<!\\bTRUE\\b)\\btrue\\b|(?<!\\bFALSE\\b)\\bfalse\\b|(?<!\\bNULL\\b)\\bnull\\b"
        message: "Use uppercase for TRUE, FALSE, and NULL constants for consistency."

      - pattern: "(?i)\\/\\/\\s[a-z]"
        message: "Ensure inline comments begin with a capital letter and end with a period for readability."

      - pattern: "\\$this->config\\('\\w+'\\)"
        message: "Use ConfigFactory for configuration management to ensure proper dependency injection."

  - type: suggest
    message: |
      **PHP/Drupal Development Best Practices:**
      - **File Structure:** Place module files in `web/modules/custom/[module_name]/` for organization.
      - **Module Files:** Ensure modules include .info.yml, .module, .libraries.yml, .services.yml where applicable.
      - **Dependencies:** Use hook_requirements() to manage external dependencies.
      - **Forms:** Use FormBase or ConfigFormBase for creating forms, always include CSRF protection.
      - **Caching:** Apply proper cache tags and contexts for performance optimization.
      - **Error Handling & Logging:** Implement robust error handling and logging using Drupal's mechanisms.
      - **Type Safety:** Leverage type safety in form methods and throughout your code.
      - **Dependency Injection:** Follow Drupal's dependency injection patterns for better maintainability.
      - **Service Container:** Use Drupal's service container to manage dependencies.
      - **Security:** Validate all user inputs, use Drupal's security practices like sanitization and escaping.
      - **Schema Updates:** Implement hook_update_N() for database schema changes.
      - **Translation:** Use Drupal's t() function for all user-facing strings.

  - type: validate
    conditions:
      - pattern: "web/modules/custom/[^/]+/\\.info\\.yml$"
        message: "Ensure each custom module has a required .info.yml file."

      - pattern: "web/modules/custom/[^/]+/\\.module$"
        message: "Ensure module has .module file if hooks are implemented."

      - pattern: "web/modules/custom/[^/]+/src/Form/\\w+Form\\.php$"
        message: "Place form classes in the Form directory for consistency."

      - pattern: "try\\s*\\{[^}]*\\}\\s*catch\\s*\\([^)]*\\)\\s*\\{\\s*\\}"
        message: "Implement proper exception handling in catch blocks for robustness."

metadata:
  priority: critical
  version: 1.1
</rule>