---
description: Standards for Lagoon Docker Compose configuration
globs: docker-compose.yml, docker-compose.*.yml
---
# Lagoon Docker Compose Standards

Ensures proper Docker Compose configuration for Lagoon deployments, following best practices and Lagoon-specific requirements.

<rule>
name: lagoon_docker_compose_standards
description: Enforce standards for Lagoon Docker Compose files
filters:
  - type: file_name
    pattern: "^docker-compose(\\.\\w+)?\\.yml$"

actions:
  - type: enforce
    conditions:
      - pattern: "services:\\s+\\w+:\\s+(?!.*labels:[\\s\\S]*lagoon)"
        message: "Add Lagoon labels to service definitions for proper Lagoon integration"

      - pattern: "version:\\s*['\"]*2"
        message: "Use Docker Compose format version 3 or higher for compatibility with modern Docker features"

      - pattern: "volumes:\\s+[^:]+:\\s+(?!.*delegated)"
        message: "Use 'delegated' mount consistency for better performance on macOS development environments"
        
      - pattern: "services:\\s+\\w+:\\s+(?!.*restart:)"
        message: "Define restart policy for services to ensure proper behavior during deployment"

  - type: suggest
    message: |
      ## Lagoon Docker Compose Best Practices:
      
      ### Service Configuration
      - Define service types via labels (e.g., `lagoon.type: nginx`)
      - Use proper image naming conventions (e.g., `amazeeio/nginx-drupal:latest`)
      - Set appropriate environment variables using Lagoon variables
      - Define health checks for critical services
      - Configure proper networking with Lagoon defaults
      - Set resource constraints appropriate for each environment
      
      ### Volume Configuration
      - Use named volumes for persistent data
      - Configure appropriate volume mounts with correct permissions
      - Use 'delegated' mount consistency for macOS performance
      - Avoid mounting the entire codebase when possible
      
      ### Build Configuration
      - Use build arguments appropriately
      - Define proper Dockerfile paths
      - Use multi-stage builds for smaller images
      
      ### Example Service Configuration:
      ```yaml
      services:
        nginx:
          build:
            context: .
            dockerfile: nginx.dockerfile
          labels:
            lagoon.type: nginx
            lagoon.persistent: /app/web/sites/default/files/
          volumes:
            - app:/app:delegated
          depends_on:
            - php
          environment:
            LAGOON_ROUTE: ${LAGOON_ROUTE:-http://project.docker.amazee.io}
      ```

  - type: validate
    conditions:
      - pattern: "services:\\s+cli:\\s+(?!.*build:)"
        message: "CLI service should have proper build configuration for Lagoon compatibility"

      - pattern: "services:\\s+\\w+:\\s+(?!.*depends_on:)"
        message: "Define service dependencies for proper startup order and container relationships"

      - pattern: "networks:\\s+(?!.*default:)"
        message: "Configure proper network settings for Lagoon compatibility and service communication"
        
      - pattern: "services:\\s+mariadb:\\s+(?!.*image:\\s+amazeeio\\/mariadb)"
        message: "Use Lagoon-provided MariaDB image for compatibility with Lagoon environment"
        
      - pattern: "services:\\s+\\w+:\\s+environment:\\s+(?!.*\\$\\{LAGOON)"
        message: "Use Lagoon environment variables with fallbacks for local development"

metadata:
  priority: high
  version: 1.1
</rule> 