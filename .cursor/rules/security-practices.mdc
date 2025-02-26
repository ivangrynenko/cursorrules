---
description: Security best practices for PHP, JavaScript, and Drupal
globs: *.php, *.js, *.vue, *.jsx, *.tsx
alwaysApply: false
---
# Security Best Practices

Ensures application security standards are maintained.

<rule>
name: security_practices
description: Enforce security best practices across the application
filters:
  - type: file_extension
    pattern: "\\.(php|js|vue|jsx|tsx)$"

actions:
  - type: enforce
    conditions:
      - pattern: "eval\\("
        message: "Avoid using eval() - security risk"

      - pattern: "\\$_GET|\\$_POST|\\$_REQUEST"
        message: "Use Drupal's input sanitization methods"

      - pattern: "innerHTML"
        message: "Use textContent or sanitize HTML content"

  - type: suggest
    message: |
      Security Best Practices:
      - Implement CSRF protection
      - Use prepared statements for queries
      - Sanitize user input
      - Implement proper access controls
      - Follow security updates protocol
      - Ensure Drupal file permissions are secure (see drupal-file-permissions.mdc)
      - Use ahoy cli commands instead of direct docker compose exec

metadata:
  priority: critical
  version: 1.0
</rule> 