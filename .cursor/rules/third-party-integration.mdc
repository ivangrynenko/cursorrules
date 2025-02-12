---
description: Standards for integrating external services
globs: *.php, *.js, *.ts
---
# Third-Party Integration Standards

Ensures consistent and secure third-party service integration.

<rule>
name: third_party_integration
description: Enforce standards for external service integration
filters:
  - type: file_extension
    pattern: "\\.(php|js|ts)$"

actions:
  - type: enforce
    conditions:
      - pattern: "new\\s+[A-Z][a-zA-Z]*Client\\("
        message: "Implement proper error handling for external services"

      - pattern: "process\\.env\\.|getenv\\("
        message: "Use configuration management for API credentials"

  - type: suggest
    message: |
      Integration Best Practices:
      - Implement proper error handling
      - Use environment variables
      - Create service abstractions
      - Implement retry mechanisms
      - Monitor integration health

metadata:
  priority: high
  version: 1.0
</rule> 