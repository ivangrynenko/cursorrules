---
description: Standards for maintaining README.md documentation
globs: README.md, *.md
alwaysApply: false
---
# Enhanced README Maintenance Standards

Ensures that README files are consistently maintained, up-to-date, and informative.

<rule>
name: enhanced_readme_maintenance_standards
description: Enforce standards for maintaining README documentation
filters:
  - type: file_extension
    pattern: "\\.md$"
  - type: file_name
    pattern: "^README\\.md$"

actions:
  - type: enforce
    conditions:
      - pattern: "## (Available Rules|Features|Components)"
        message: "Update the 'Available Rules/Features/Components' section whenever new elements are added."

      - pattern: "\\[`[^`]+`\\]\\([^)]+\\)"
        message: "Ensure all file references in the README are properly linked and point to existing files."

      - pattern: "## (Installation|Usage|Configuration)"
        message: "Keep setup, usage, and configuration sections current with the latest project changes."

      - pattern: "## (Contributing|License)"
        message: "Ensure contributing guidelines and license information are accurate and up-to-date."

      - pattern: "\\[Version\\s*(\\d+\\.)?(\\d+\\.)?\\d+\\]"
        message: "Update version information to reflect the current state of the project."

      - pattern: "## (Changelog|Changes|Updates)"
        message: "Maintain a changelog for significant updates, fixes, and features."

  - type: suggest
    message: |
      **README Maintenance Best Practices:**
      - **Rule Listings:** Automatically update or manually check if new rules or features are reflected in the README.
      - **Installation & Configuration:** Regularly review and update installation and configuration instructions to match the latest project state.
      - **Documentation of Changes:** Document new features, bug fixes, and changes in a changelog or dedicated section.
      - **Section Hierarchy:** Maintain a logical structure with clear headings for easy navigation.
      - **Examples:** Include or update examples for new or changed functionalities.
      - **Version Information:** Keep version numbers and release notes current, linking to the changelog if applicable.
      - **Table of Contents:** Ensure the table of contents reflects the current document structure, using auto-generated if possible.
      - **Badges:** Update badges for CI/CD status, test coverage, or dependencies to reflect current project health.
      - **Accessibility:** Write with accessibility in mind, using alt text for images and semantic markdown.

  - type: validate
    conditions:
      - pattern: "^# [^\\n]+\\n\\n## "
        message: "Ensure proper markdown heading hierarchy for readability."

      - pattern: "\\|[^|]+\\|[^|]+\\|\\n\\|\\s*-+\\s*\\|"
        message: "Use consistent table formatting throughout the document."

      - pattern: "\\[(.*?)\\]\\((?!http|\\/)[^\\)]+\\)"
        message: "All local links should point to existing files or sections within the project."

      - pattern: "\\[Version\\s*(\\d+\\.)?(\\d+\\.)?\\*\\d+\\]"
        message: "Check that version placeholders are updated to actual numbers before release."

metadata:
  priority: high
  version: 1.1
</rule>