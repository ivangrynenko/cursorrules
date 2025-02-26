---
description: Standards for Lagoon configuration files and deployment workflows
globs: .lagoon.yml, .lagoon.*.yml
---
# Lagoon Configuration Standards

Ensures proper configuration and best practices for Lagoon deployment files, focusing on environment configuration, routes, tasks, and deployment workflows.

<rule>
name: lagoon_yml_standards
description: Enforce standards for Lagoon configuration files
filters:
  - type: file_extension
    pattern: "\\.(yml|yaml)$"
  - type: file_name
    pattern: "^\\.lagoon(\\.\\w+)?\\.yml$"

actions:
  - type: enforce
    conditions:
      - pattern: "environments:\\s*[\\w-]+:\\s*routes:\\s*-\\s*\\w+:\\s*-[^:]+:\\s*tls-acme:\\s*true"
        message: "Ensure tls-acme is set to 'false' until DNS points to Lagoon to prevent certificate issuance failures"

      - pattern: "post-rollout:\\s*-\\s*run:\\s*command:\\s*drush(?!.*\\|\\|)"
        message: "Wrap Drush commands in proper error handling using '|| exit 1' to ensure deployment fails on command errors"

      - pattern: "pre-rollout:\\s*-\\s*run:\\s*command:\\s*(?!.*if)"
        message: "Add conditional checks for pre-rollout tasks to ensure they only run when necessary"

      - pattern: "cronjobs:\\s*-\\s*name:[^\\n]*\\n\\s*schedule:\\s*'\\*\\s*\\*'"
        message: "Use 'M' or 'H' notation for randomized cron scheduling to prevent server load spikes"
        
      - pattern: "routes:\\s*-\\s*\\w+:\\s*-[^:]+:\\s*(?!.*redirects:)"
        message: "Consider configuring redirects for routes to handle legacy URLs or domain migrations"

  - type: suggest
    message: |
      ## Lagoon Configuration Best Practices:
      
      ### Environment Configuration
      - Use environment-specific configurations for different deployment targets
      - Define environment types for proper resource allocation
      - Configure environment variables specific to each environment
      - Use environment-specific routes and domains
      
      ### Routes Configuration
      - Configure routes with appropriate SSL settings
      - Set up redirects for legacy URLs
      - Configure proper insecure traffic handling (Allow or Redirect)
      - Use wildcard domains for feature branch environments
      
      ### Tasks Configuration
      - Implement proper pre-rollout tasks with error handling
      - Configure post-rollout tasks with appropriate conditions
      - Use conditional task execution based on environment
      - Include database sync in PR environments
      - Implement proper backup strategies before major changes
      
      ### Cron Configuration
      - Use randomized cron schedules with 'M' and 'H' notation
      - Set appropriate frequency for different tasks
      - Ensure cron jobs have proper error handling
      - Use descriptive names for cron jobs
      
      ### Example Configuration:
      ```yaml
      environments:
        main:
          cronjobs:
            - name: drush-cron
              schedule: '*/15 * * * *'
              command: drush cron
              service: cli
          routes:
            - nginx:
              - example.com:
                  tls-acme: true
                  insecure: Redirect
                  redirects:
                    - www.example.com
          tasks:
            pre-rollout:
              - run:
                  name: Drush pre-update
                  command: |
                    if drush status --fields=bootstrap | grep -q "Successful"; then
                      drush state:set system.maintenance_mode 1 -y
                      drush cr
                    fi
                  service: cli
            post-rollout:
              - run:
                  name: Drush post-update
                  command: |
                    drush updb -y || exit 1
                    drush cr
                    drush state:set system.maintenance_mode 0 -y
                  service: cli
      ```

  - type: validate
    conditions:
      - pattern: "environments:\\s*[\\w-]+:\\s*types:\\s*[^\\n]*"
        message: "Define environment types for proper resource allocation and environment-specific configuration"

      - pattern: "tasks:\\s*(pre|post)-rollout:"
        message: "Include both pre and post rollout tasks for robust deployments and proper application state management"

      - pattern: "routes:\\s*-\\s*\\w+:\\s*-[^:]+:\\s*insecure:\\s*(Allow|Redirect)"
        message: "Configure proper insecure traffic handling to ensure secure access to your application"
        
      - pattern: "(?!.*backup-strategy:)"
        message: "Consider implementing a backup strategy for critical environments to prevent data loss"
        
      - pattern: "cronjobs:\\s*-\\s*name:[^\\n]*\\n\\s*schedule:[^\\n]*\\n\\s*(?!.*service:)"
        message: "Specify the service for cron jobs to ensure they run in the correct container"

metadata:
  priority: critical
  version: 1.1
</rule> 