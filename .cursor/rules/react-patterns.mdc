---
description: React component patterns and hooks usage guidelines
globs: *.jsx, *.tsx
---
# React Patterns and Best Practices

Ensures React components follow recommended patterns and hook usage.

<rule>
name: react_patterns
description: Enforce React component patterns and hooks best practices
filters:
  - type: file_extension
    pattern: "\\.(jsx|tsx)$"

actions:
  - type: enforce
    conditions:
      - pattern: "useEffect\\([^,]+\\)"
        message: "Specify dependencies array in useEffect"

      - pattern: "useState\\([^)]*\\).*useState\\([^)]*\\)"
        message: "Consider combining related state variables"

      - pattern: "React\\.memo\\(.*\\)"
        message: "Ensure React.memo is used appropriately for performance"

  - type: suggest
    message: |
      React Best Practices:
      - Use functional components with hooks
      - Implement proper memoization
      - Follow the Rules of Hooks
      - Use TypeScript for prop types
      - Consider custom hooks for reusable logic

metadata:
  priority: high
  version: 1.0
</rule> 