---
description: Standards for code generation and implementation
globs: *.php, *.js, *.ts, *.vue, *.jsx, *.tsx, *.py
---
# Enhanced Code Generation Standards

Ensures high-quality, executable code generation adhering to best practices across multiple programming languages.

<rule>
name: enhanced_code_generation_standards
description: Enforce standards for code generation ensuring high quality and integration readiness
filters:
  - type: file_extension
    pattern: "\\.(php|js|ts|vue|jsx|tsx|py|rb|java)$"  # Expanded to include Ruby and Java

actions:
  - type: enforce
    conditions:
      - pattern: "// TODO:|#\\s*TODO:"
        message: "Replace TODOs with actual implementation - no placeholders allowed."

      - pattern: "function\\s+\\w+\\s*\\([^)]*\\)\\s*\\{\\s*(?:return\\s+null|throw\\s+new\\s+Error|console\\.log)\\s*\\}"
        message: "Implement full functionality - no stub methods."

      - pattern: "\\bif\\b\\s*\\(\\s*false\\s*\\)"
        message: "Remove or replace conditional statements that are always false."

      - pattern: "\\bconsole\\.[^(]+|print\\s*\\("
        pattern_negate: "DEBUG|LOGGING"
        message: "Remove debug logging unless it's conditional on a debug flag."

      - pattern: "^\\s*#\\s*\\w+:\\s*\\w+\\s*$"
        language: python
        message: "In Python, prefer type hints over comments for type annotations."

  - type: suggest
    message: |
      **Code Generation Best Practices:**
      - **Executable Solutions:** Generate fully functional code, not just skeletons or stubs.
      - **Readability:** 
        - Prioritize code readability, with clear naming conventions and logical structure.
        - Use whitespace effectively to enhance code clarity.
      - **Error Handling:** 
        - Implement comprehensive error handling with appropriate exceptions or error codes.
        - Consider edge cases and provide meaningful error messages.
      - **Imports/Dependencies:** 
        - Include all necessary imports or require statements at the beginning of the file.
        - Manage dependencies to ensure the code is self-contained or clearly documented for setup.
      - **Integration:** 
        - Code should be immediately usable within the project's existing framework or technology stack.
        - Ensure compatibility with existing patterns or libraries used in the project.
      - **Formatting:** 
        - Adhere to the project's coding style guide (e.g., Prettier, Black for Python, etc.).
        - Use linters and formatters to maintain consistent code style.
      - **Testing:** 
        - Include unit or integration tests where applicable to validate generated code.
        - Encourage test-driven development if part of the project's culture.
      - **Documentation:** 
        - Provide inline comments for complex logic or algorithms.
        - Write docstrings or JSDoc for functions, classes, and modules to describe usage, parameters, and return values.
        - Consider generating external documentation if the project uses tools like Swagger for APIs or Sphinx for Python.
      - **Security:** 
        - Avoid hardcoded credentials or sensitive information.
        - Follow security best practices for the language (e.g., SQL injection prevention in PHP, XSS in JavaScript).
      - **Performance:** While readability takes precedence, be mindful of performance implications of the generated code.

metadata:
  priority: critical
  version: 1.1
</rule>