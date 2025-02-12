---
description: Standards for debugging and error handling
globs: *.php, *.js, *.ts, *.vue, *.jsx, *.tsx, *.py
---
# Debugging Standards

Ensures proper debugging practices and error handling.

<rule>
name: debugging_standards
description: Enforce standards for debugging and error handling
filters:
  - type: file_extension
    pattern: "\\.(php|js|ts|vue|jsx|tsx|py)$"

actions:
  - type: enforce
    conditions:
      - pattern: "console\\.log\\(|print_r\\(|var_dump\\("
        message: "Replace debug statements with proper logging"

      - pattern: "catch\\s*\\([^)]*\\)\\s*\\{\\s*\\}"
        message: "Implement proper error handling in catch blocks"

  - type: suggest
    message: |
      Debugging Best Practices:
      - Address root causes, not symptoms
      - Add descriptive logging messages
      - Create isolated test functions
      - Implement comprehensive error handling
      - Use appropriate logging levels
      - Add context to error messages
      - Consider debugging tools integration

metadata:
  priority: high
  version: 1.0
</rule> 