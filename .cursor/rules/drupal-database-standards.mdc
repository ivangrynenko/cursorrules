---
description: Database schema changes, migrations, and query optimization
globs: *.php, *.install, *.module
---
# Drupal Database Standards

Ensures proper database handling in Drupal applications.

<rule>
name: drupal_database_standards
description: Enforce Drupal database best practices and standards
filters:
  - type: file_extension
    pattern: "\\.(php|install|module)$"

actions:
  - type: enforce
    conditions:
      - pattern: "db_query"
        message: "Use Database API instead of db_query"

      - pattern: "hook_update_N.*\\{\\s*[^}]*\\}"
        message: "Ensure hook_update_N includes proper schema changes"

      - pattern: "\\$query->execute\\(\\)"
        message: "Consider using try-catch block for database operations"

  - type: suggest
    message: |
      Database Best Practices:
      - Use Schema API for table definitions
      - Implement proper error handling
      - Use update hooks for schema changes
      - Follow Drupal's database abstraction layer
      - Implement proper indexing strategies

metadata:
  priority: critical
  version: 1.0
</rule> 