---
description: Standards for Vortex/DrevOps scaffold usage and best practices
globs: *.yml, *.sh, composer.json, README.md
---
# Vortex/DrevOps Scaffold Standards

Ensures proper usage of Vortex/DrevOps scaffold features and workflows.

<rule>
name: vortex_scaffold_standards
description: Enforce standards for Vortex/DrevOps scaffold usage
filters:
  - type: file_extension
    pattern: "\\.(yml|yaml|sh|json|md)$"
  - type: file_path
    pattern: "scripts/(vortex|drevops)/"

actions:
  - type: enforce
    conditions:
      - pattern: "custom-download-db\\.sh"
        message: "Use scripts/vortex/download-db.sh router script instead of custom implementation"

      - pattern: "drush\\s+[a-z-]+\\s+--uri="
        message: "Use DRUPAL_SITE_URL environment variable instead of hardcoded URI"

      - pattern: "composer\\s+require\\s+[^-]"
        message: "Use Vortex's composer.json template and Renovate for dependency management"

      - pattern: "docker\\s+exec\\s+-it\\s+\\$\\(docker-compose"
        message: "Use Ahoy commands for container interactions"

  - type: suggest
    message: |
      Vortex/DrevOps Best Practices:
      - Use centralized workflow scripts from scripts/vortex/
      - Leverage environment variables for configuration
      - Use Renovate for automated dependency updates
      - Follow the router script pattern for customizations
      - Implement proper CI/CD integration
      - Use provided tool configurations (PHPCS, PHPStan, etc.)
      - Maintain documentation structure
      - Ensure CI/CD pipelines include testing and deployment steps
      - Document CI/CD processes in the README for clarity

  - type: validate
    conditions:
      - pattern: "^\\s*source\\s+\\.env"
        message: "Use scripts/vortex/bootstrap.sh for environment setup"

      - pattern: "docker-compose\\s+exec\\s+cli\\s+vendor/bin/"
        message: "Use provided Ahoy commands for tool execution"

metadata:
  priority: high
  version: 1.1
</rule> 