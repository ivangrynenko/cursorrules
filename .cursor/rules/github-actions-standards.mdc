---
description: 
globs: .github/workflows/*.yml
alwaysApply: false
---
 # GitHub Actions Standards

Ensures GitHub Actions workflows follow best practices and use the latest action versions.

<rule>
name: github_actions_standards
description: Enforce standards for GitHub Actions workflows
filters:
  - type: file_extension
    pattern: "\\.ya?ml$"
  - type: file_path
    pattern: "\\.github/workflows/"

actions:
  - type: enforce
    conditions:
      - pattern: "uses:\\s*actions/upload-artifact@v[123]"
        message: "Use actions/upload-artifact@v4 instead of older versions. Version 3 is deprecated: https://github.blog/changelog/2024-04-16-deprecation-notice-v3-of-the-artifact-actions/"

      - pattern: "uses:\\s*actions/download-artifact@v[123]"
        message: "Use actions/download-artifact@v4 instead of older versions."

      - pattern: "uses:\\s*actions/checkout@v[12]"
        message: "Consider using actions/checkout@v4 for the latest features and security updates."

  - type: suggest
    message: |
      **GitHub Actions Best Practices:**
      - **Latest Action Versions:** Always use the latest stable versions of GitHub Actions.
        - `actions/checkout@v4`
        - `actions/upload-artifact@v4`
        - `actions/download-artifact@v4`
        - `actions/setup-node@v4`
        - `actions/setup-python@v5`
      - **Workflow Structure:** Organize workflows with clear job names and step descriptions.
      - **Caching:** Implement caching for dependencies to speed up workflows.
      - **Security:** Use `GITHUB_TOKEN` with minimum required permissions.
      - **Artifacts:** Use descriptive names for artifacts and set appropriate retention periods.
      - **Matrix Strategy:** Use matrix builds for testing across multiple environments.
      - **Timeouts:** Set appropriate timeouts for jobs to prevent hanging workflows.

  - type: validate
    conditions:
      - pattern: "uses:\\s*actions/upload-artifact@v4"
        message: "Good job using the latest version of actions/upload-artifact!"

      - pattern: "uses:\\s*actions/download-artifact@v4"
        message: "Good job using the latest version of actions/download-artifact!"

      - pattern: "uses:\\s*actions/checkout@v[34]"
        message: "Good job using a recent version of actions/checkout!"

metadata:
  priority: high
  version: 1.0
  tags:
    - ci/cd
    - github
    - automation
</rule>