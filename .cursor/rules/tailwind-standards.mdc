---
description: Tailwind CSS class organization and best practices
globs: *.vue, *.jsx, *.tsx, *.html
---
# Tailwind CSS Standards

Ensures consistent and optimized usage of Tailwind CSS classes.

<rule>
name: tailwind_standards
description: Enforce Tailwind CSS best practices and organization
filters:
  - type: file_extension
    pattern: "\\.(vue|jsx|tsx|html)$"

actions:
  - type: enforce
    conditions:
      - pattern: "class=\"[^\"]*\\s{2,}"
        message: "Remove multiple spaces between Tailwind classes"

      - pattern: "class=\"[^\"]*(?:text-\\w+\\s+text-\\w+|bg-\\w+\\s+bg-\\w+)"
        message: "Avoid conflicting utility classes"

  - type: suggest
    message: |
      Tailwind Best Practices:
      - Group related utilities together
      - Use @apply for commonly repeated patterns
      - Follow responsive design patterns
      - Implement proper dark mode support
      - Consider extracting components for repeated patterns

metadata:
  priority: medium
  version: 1.0
</rule> 