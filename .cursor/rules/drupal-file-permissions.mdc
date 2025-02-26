---
description: Drupal file permissions security standards
globs: *.dockerfile, *.sh, docker-compose.yml, Dockerfile
---
# Drupal File Permissions Security

Standards for securing Drupal file permissions in Docker environments and production servers, ensuring proper security while maintaining functionality.

<rule>
name: drupal_file_permissions
description: Enforce secure file permissions for Drupal sites/default directory and critical files
filters:
  - type: file_extension
    pattern: "\\.(dockerfile|sh|yml)$"
  - type: file_name
    pattern: "^Dockerfile$|^docker-compose\\.yml$"
  - type: content
    pattern: "(?i)chmod|chown|drupal|settings\\.php|services\\.yml"

actions:
  - type: enforce
    conditions:
      - pattern: "chmod\\s+(?!755)\\d+\\s+[^\\n]*sites\\/default(?![^\\n]*files)"
        message: "sites/default directory should have 755 permissions (read-only for group/others)"

      - pattern: "chmod\\s+(?!444)\\d+\\s+[^\\n]*settings\\.php"
        message: "settings.php should have 444 permissions (read-only for everyone)"

      - pattern: "chmod\\s+(?!444)\\d+\\s+[^\\n]*services\\.yml"
        message: "services.yml should have 444 permissions (read-only for everyone)"
        
      - pattern: "chmod\\s+(?!755)\\d+\\s+[^\\n]*sites\\/default\\/files"
        message: "sites/default/files directory should have 755 permissions with proper ownership"
        
      - pattern: "chown\\s+(?!www-data:www-data)[^\\s]+\\s+[^\\n]*sites\\/default\\/files"
        message: "sites/default/files should be owned by the web server user (www-data:www-data)"

  - type: suggest
    message: |
      ## Drupal File Permissions Security Best Practices

      ### 1. Critical File Permissions
      - **sites/default directory**: 755 (drwxr-xr-x)
      - **settings.php**: 444 (r--r--r--)
      - **services.yml**: 444 (r--r--r--)
      - **settings.local.php**: 444 (r--r--r--)
      - **sites/default/files**: 755 (drwxr-xr-x)
      - **sites/default/files/** (contents): 644 (rw-r--r--) for files, 755 (drwxr-xr-x) for directories

      ### 2. Ownership Configuration
      - **Web root**: application user (varies by environment)
      - **sites/default/files**: web server user (www-data:www-data)
      
      ### 3. Implementation in Dockerfile
      ```dockerfile
      # Set proper permissions for Drupal
      RUN mkdir -p /app/${WEBROOT}/sites/default/files && \
          chown www-data:www-data /app/${WEBROOT}/sites/default/files && \
          chmod 755 /app/${WEBROOT}/sites/default && \
          chmod 444 /app/${WEBROOT}/sites/default/settings.php && \
          chmod 444 /app/${WEBROOT}/sites/default/services.yml && \
          find /app/${WEBROOT}/sites/default/files -type d -exec chmod 755 {} \\; && \
          find /app/${WEBROOT}/sites/default/files -type f -exec chmod 644 {} \\;
      ```

      ### 4. Permission Fix Script
      Create a script at `/app/scripts/custom/fix-drupal-permissions.sh`:
      ```bash
      #!/bin/bash
      
      # Exit on error
      set -e
      
      WEBROOT=${WEBROOT:-web}
      
      echo "Setting Drupal file permissions..."
      
      # Ensure directories exist
      mkdir -p /app/${WEBROOT}/sites/default/files
      
      # Set ownership
      chown www-data:www-data /app/${WEBROOT}/sites/default/files
      
      # Set directory permissions
      chmod 755 /app/${WEBROOT}/sites/default
      chmod 755 /app/${WEBROOT}/sites/default/files
      find /app/${WEBROOT}/sites/default/files -type d -exec chmod 755 {} \;
      
      # Set file permissions
      chmod 444 /app/${WEBROOT}/sites/default/settings.php
      [ -f /app/${WEBROOT}/sites/default/services.yml ] && chmod 444 /app/${WEBROOT}/sites/default/services.yml
      [ -f /app/${WEBROOT}/sites/default/settings.local.php ] && chmod 444 /app/${WEBROOT}/sites/default/settings.local.php
      find /app/${WEBROOT}/sites/default/files -type f -exec chmod 644 {} \;
      
      echo "Drupal file permissions set successfully."
      ```

      ### 5. Verify Permissions
      ```bash
      # Check file permissions
      ahoy cli "ls -la /app/${WEBROOT}/sites/default"
      ahoy cli "ls -la /app/${WEBROOT}/sites/default/files"
      
      # Check Drupal status
      ahoy drush status-report | grep -i "protected"
      ```

      ### 6. Security Considerations
      - Never set 777 permissions on any Drupal files or directories
      - Temporary files should be stored in private file system when possible
      - Use Drupal's private file system for sensitive uploads
      - Implement file access controls through Drupal's permission system
      - Consider using file encryption for highly sensitive data

examples:
  - input: |
      # Bad: Insecure permissions
      RUN chmod 777 /app/${WEBROOT}/sites/default
      RUN chmod 666 /app/${WEBROOT}/sites/default/settings.php
      RUN chmod -R 777 /app/${WEBROOT}/sites/default/files

      # Good: Secure permissions
      RUN chmod 755 /app/${WEBROOT}/sites/default
      RUN chmod 444 /app/${WEBROOT}/sites/default/settings.php
      RUN chmod 444 /app/${WEBROOT}/sites/default/services.yml
      RUN chown www-data:www-data /app/${WEBROOT}/sites/default/files
      RUN find /app/${WEBROOT}/sites/default/files -type d -exec chmod 755 {} \;
      RUN find /app/${WEBROOT}/sites/default/files -type f -exec chmod 644 {} \;
    output: "Correctly set Drupal file permissions with proper security"

metadata:
  priority: high
  version: 1.1
</rule> 
