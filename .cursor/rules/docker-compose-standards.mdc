---
description: Docker Compose standards Rule
globs: 
alwaysApply: false
---
<rule>
name: docker_compose_best_practices
description: Enforces best practices in docker-compose files to ensure maintainability, security, and consistency
filters:
  - type: file_name
    pattern: "docker-compose\\.ya?ml$"
  - type: event
    pattern: "(file_create|file_modify)"
actions:
  # 1. Prevent deprecated 'version' field
  - type: reject
    conditions:
      - pattern: "^\\s*version\\s*:"
        message: "The 'version' field is deprecated in Docker Compose files. Compose files are now version-less by default."
  # 2. Enforce consistent indentation
  - type: reject
    conditions:
      - pattern: "^(  |\t)"
        message: "Inconsistent indentation detected. Use 2 spaces for indentation."
  # 3. Prevent usage of deprecated 'links' key
  - type: reject
    conditions:
      - pattern: "^\\s*links\\s*:"
        message: "The 'links' key is deprecated. Use networks and service names for inter-service communication."
  # 4. Enforce explicit image tags
  - type: reject
    conditions:
      - pattern: "^\\s*image\\s*:\\s*[^:]+$"
        message: "Specify an explicit image tag to ensure consistency."
  # 5. Prevent services from running in privileged mode
  - type: reject
    conditions:
      - pattern: "^\\s*privileged\\s*:\\s*true"
        message: "Running services in privileged mode is discouraged for security reasons."
  # 6. Enforce defining resource limits
  - type: reject
    conditions:
      - pattern: "^\\s*services\\s*:\\s*[^\\n]+\\n(?!.*\\blimits\\b)"
        message: "Define resource limits for each service to prevent resource exhaustion."
  # Suggestions for best practices
  - type: suggest
    message: |
      To adhere to Docker Compose best practices:

      1. **Omit the 'version' field**: Compose files are version-less by default.
         ```yaml
         services:
           web:
             image: nginx
         ```

      2. **Use consistent indentation**: Use 2 spaces for indentation.
         ```yaml
         services:
           web:
             image: nginx
         ```

      3. **Avoid 'links' key**: Use networks and service names for service communication.
         ```yaml
         services:
           web:
             image: nginx
             networks:
               - my-network
           db:
             image: mysql
             networks:
               - my-network
         networks:
           my-network:
         ```

      4. **Specify explicit image tags**: Prevent unintended updates by defining image tags.
         ```yaml
         services:
           web:
             image: nginx:1.21.0
         ```

      5. **Avoid privileged mode**: Do not use 'privileged: true'. Grant specific capabilities if necessary.
         ```yaml
         services:
           web:
             image: nginx
             cap_add:
               - NET_ADMIN
         ```

      6. **Define resource limits**: Prevent services from consuming excessive resources.
         ```yaml
         services:
           web:
             image: nginx
             deploy:
               resources:
                 limits:
                   cpus: '0.50'
                   memory: '512M'
         ```

      Implementing these practices ensures secure, maintainable, and consistent Docker Compose configurations.
examples:
  - input: |
      version: '3'
      services:
        web:
          image: nginx
          links:
            - db
          privileged: true
        db:
          image: mysql
    output: |
      services:
        web:
          image: nginx:1.21.0
          networks:
            - my-network
          deploy:
            resources:
              limits:
                cpus: '0.50'
                memory: '512M'
        db:
          image: mysql:5.7
          networks:
            - my-network
      networks:
        my-network:
metadata:
  priority: high
  version: 1.0
</rule>