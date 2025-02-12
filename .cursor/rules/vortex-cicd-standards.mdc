---
description: Standards for Vortex CI/CD and Renovate configuration
globs: .circleci/config.yml, renovate.json, .github/workflows/*.yml
---
# Vortex CI/CD Standards

Ensures proper CI/CD and dependency management configuration.

<rule>
name: vortex_cicd_standards
description: Enforce standards for Vortex CI/CD and Renovate configuration
filters:
  - type: file_name
    pattern: "^config\\.yml$|^renovate\\.json$|\\.github/workflows/.*\\.yml$"

actions:
  - type: enforce
    conditions:
      - pattern: "workflows:\\s+version:\\s*2\\.1"
        message: "Use Vortex's CircleCI configuration template"

      - pattern: "\"extends\":\\s*\\[\\s*\"config:base\"\\s*\\]"
        message: "Extend Vortex's Renovate configuration for Drupal projects"

      - pattern: "steps:\\s+- run:\\s+name:\\s+Install dependencies"
        message: "Use scripts/vortex/provision.sh for consistent provisioning"

  - type: suggest
    message: |
      CI/CD Best Practices:
      - Use dual schedules for Drupal updates
      - Configure automated PR assignments
      - Enable deployment notifications
      - Use provided test scaffolds
      - Implement proper caching strategy
      - Configure branch protection rules
      - Use standardized job naming

  - type: validate
    conditions:
      - pattern: "\"packageRules\":\\s*\\[\\s*\\{\\s*\"matchPackagePatterns\":\\s*\\[\"^drupal/core"
        message: "Configure separate update schedules for Drupal core and contrib"

      - pattern: "jobs:\\s+build_test:"
        message: "Include all required test jobs from Vortex template"

      - pattern: "- store_test_results:"
        message: "Enable test results storage for better CI visibility"

metadata:
  priority: critical
  version: 1.0
</rule> 