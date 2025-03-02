# Secret Detection and Warning Rule

This rule helps identify potential secrets, credentials, and sensitive data in code files to prevent accidental exposure or leakage. It provides warnings when secrets are detected and suggests best practices for secure secret management.

<rule>
name: secret_detection_warning
description: Detect and warn about potential secrets and sensitive data in code files
filters:
  - type: file_extension
    pattern: "\\.(php|js|py|ts|jsx|tsx|java|rb|go|cs|c|cpp|h|hpp|ini|conf|yaml|yml|json|xml|properties|env|config|sh|bash|zsh)$"
  - type: file_path
    pattern: ".*"
    exclude: "(node_modules|vendor|bower_components|.git|.yarn|dist|build|out|\\.bundle|cache)"

actions:
  - type: enforce
    conditions:
      # Generic API Keys, Tokens, and Credentials
      - pattern: "(?i)(api[_-]?key|apikey|api[_-]?secret|apisecret|app[_-]?key|appkey|app[_-]?secret|access[_-]?key|accesskey|access[_-]?token|auth[_-]?key|authkey|client[_-]?secret|consumer[_-]?key|consumer[_-]?secret|oauth[_-]?token|token)[\\s]*[=:]\\s*['\\\"](\\w|[\\-]){16,}['\\\"]"
        message: "Potential API key or secret detected. Consider using environment variables or a secure secrets manager instead of hardcoding sensitive values."

      # AWS Keys and Tokens
      - pattern: "(?i)(aws[_-]?access[_-]?key|aws[_-]?secret[_-]?key|aws[_-]?account[_-]?id)[\\s]*[=:]\\s*['\\\"](\\w|[\\-]){16,}['\\\"]"
        message: "Potential AWS key detected. AWS credentials should be stored securely using AWS SDK credential providers, environment variables, or a secrets manager."

      # Google Cloud and Firebase
      - pattern: "(?i)(google[_-]?api[_-]?key|google[_-]?cloud[_-]?key|firebase[_-]?api[_-]?key)[\\s]*[=:]\\s*['\\\"](\\w|[\\-]){16,}['\\\"]"
        message: "Potential Google Cloud or Firebase key detected. Use environment variables or a secure secrets manager to store these credentials."

      # Azure and Microsoft
      - pattern: "(?i)(azure[_-]?key|azure[_-]?connection[_-]?string|microsoft[_-]?key)[\\s]*[=:]\\s*['\\\"](\\w|[\\-]){16,}['\\\"]"
        message: "Potential Azure or Microsoft key detected. Use Azure Key Vault, environment variables, or a secure secrets manager instead of hardcoding credentials."

      # Database Connection Strings and Credentials
      - pattern: "(?i)(jdbc:|mongodb[\\+]?://|postgres://|mysql://|database[_-]?url|connection[_-]?string)[^\\n]{10,}(password|pwd)[^\\n]{3,}"
        message: "Potential database connection string with credentials detected. Use environment variables or a secure configuration manager for database connections."

      # Database Credentials
      - pattern: "(?i)(db[_-]?password|mysql[_-]?password|postgres[_-]?password|mongo[_-]?password|database[_-]?password)[\\s]*[=:]\\s*['\\\"][^\\s]{3,}['\\\"]"
        message: "Potential database password detected. Store database credentials in environment variables or use a secure configuration manager."

      # Private Keys and Certificates
      - pattern: "(?i)-----(BEGIN|END) (RSA |DSA |EC )?(PRIVATE KEY|CERTIFICATE)-----"
        message: "Private key or certificate material detected. Never include these directly in code - store them securely and reference them from protected locations."

      # SSH Keys
      - pattern: "(?i)ssh-rsa AAAA[0-9A-Za-z+/]+[=]{0,3}"
        message: "SSH key detected. SSH keys should be managed securely and never included directly in code files."

      # Passwords
      - pattern: "(?i)(password|passwd|pwd|secret)[\\s]*[=:]\\s*['\\\"][^\\s]{3,}['\\\"]"
        message: "Potential password detected. Never hardcode passwords in code files. Use environment variables or a secure secrets manager."

      # OAuth Tokens
      - pattern: "(?i)(bearer|oauth|access[_-]?token)[\\s]*[=:]\\s*['\\\"][\\w\\d\\-_.]{30,}['\\\"]"
        message: "Potential OAuth token detected. Store tokens securely and consider implementing proper token rotation."

      # JWT Tokens
      - pattern: "(?i)ey[a-zA-Z0-9]{20,}\\.ey[a-zA-Z0-9\\-_]{20,}\\.[a-zA-Z0-9\\-_]{20,}"
        message: "JWT token detected. Never hardcode JWT tokens directly in your code."

      # GitHub Tokens
      - pattern: "(?i)gh[pousr]_[a-zA-Z0-9]{20,}"
        message: "GitHub token detected. GitHub tokens should be stored securely in environment variables or a secrets manager."

      # Slack Tokens
      - pattern: "(?i)(xox[pbar]-[0-9]{12}-[0-9]{12}-[0-9]{12}-[a-z0-9]{32})"
        message: "Slack token detected. Store Slack tokens securely using environment variables or a secrets manager."

      # Stripe API Keys
      - pattern: "(?i)(sk|pk)_(test|live)_[0-9a-zA-Z]{24,}"
        message: "Stripe API key detected. Store Stripe keys securely in environment variables or a secrets manager."

      # Generic Encryption Keys
      - pattern: "(?i)(encryption[_-]?key|cipher[_-]?key|aes[_-]?key)[\\s]*[=:]\\s*['\\\"][\\w\\d\\-_.]{16,}['\\\"]"
        message: "Potential encryption key detected. Encryption keys should be managed securely and never hardcoded."

      # .env or config files with credentials
      - pattern: "(?i)(DB_PASSWORD|API_KEY|SECRET_KEY|ADMIN_PASSWORD)[\\s]*=[\\s]*['\"]?[\\w\\d\\-_.]{3,}['\"]?"
        message: "Environment variable with credential detected. Make sure .env files are included in .gitignore and .cursorignore."

      # IP Addresses (if they appear with credentials)
      - pattern: "(?i)(username|password|login|credential)[^\\n]{3,}(?:\\d{1,3}\\.){3}\\d{1,3}"
        message: "IP address detected near potential credentials. Consider using DNS names and storing connection details securely."

  - type: suggest
    message: |
      **Secure Secret Management Best Practices:**
      
      1. **Never hardcode secrets in source code**
         - Secrets in code can be exposed via version control, logs, or screenshots
         - Code is often shared, backed up, and stored in multiple locations
      
      2. **Use environment variables for configuration**
         - Load secrets from environment variables at runtime
         - Use libraries like dotenv, but ensure .env files are in .gitignore
         - Example: `API_KEY=os.environ.get("API_KEY")`
      
      3. **Implement secret rotation**
         - Regularly rotate credentials and keys
         - Use short-lived tokens when possible
         - Implement proper secret lifecycle management
      
      4. **Use secrets management solutions**
         - AWS Secrets Manager, Azure Key Vault, HashiCorp Vault
         - Platform-specific solutions like Kubernetes Secrets
         - These provide encryption, access control, and audit trails
      
      5. **Implement access controls**
         - Limit who can access secrets
         - Use the principle of least privilege
         - Implement proper authentication for secret access
      
      6. **Use .gitignore and .cursorignore**
         - Add patterns for files that might contain secrets
         - Example patterns: `.env`, `*.key`, `*secret*`, `*.pem`
         - Verify these files are not committed to version control
      
      7. **Consider using secure by default libraries**
         - Libraries that separate configuration from code
         - Frameworks with built-in secrets management
         - Encryption libraries with secure defaults
      
      8. **Implement detection tools**
         - Use pre-commit hooks to prevent secret leakage
         - Implement scanning in CI/CD pipelines
         - Consider tools like git-secrets, trufflehog, or detect-secrets
      
      9. **Audit and monitor**
         - Regularly audit code for leaked secrets
         - Monitor for unauthorized access to secrets
         - Implement alerts for potential compromises
      
      10. **Educate your team**
          - Train developers on secure secret management
          - Establish clear procedures for handling secrets
          - Create a response plan for leaked credentials

  - type: validate
    conditions:
      - pattern: "(?i)import\\s+os\\s*;?\\s*.*\\s+os\\.environ(\\.get)?"
        message: "Environment variable usage detected, which is a good practice for managing secrets."
      
      - pattern: "(?i)process\\.env\\."
        message: "Environment variable usage in JavaScript detected, which is a good practice for managing secrets."
      
      - pattern: "(?i)dotenv"
        message: "Dotenv library usage detected, which can help with environment variable management."
      
      - pattern: "(?i)(secret[s]?[_-]?manager|key[_-]?vault|hashicorp|vault)"
        message: "Secret management solution reference detected, which is a best practice for handling secrets."

metadata:
  priority: high
  version: 1.0
  tags:
    - category:security
    - subcategory:secrets
    - subcategory:sensitive-data
    - language:all
    - priority:critical
  references:
    - "https://owasp.org/www-community/vulnerabilities/Hardcoded_credentials"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Secrets_Management_Cheat_Sheet.html"
    - "https://docs.github.com/en/code-security/secret-scanning/about-secret-scanning"
    - "https://cloud.google.com/secret-manager/docs/best-practices"
    - "https://aws.amazon.com/blogs/security/how-to-use-aws-secrets-manager-securely-store-rotate-deploy-database-credentials/"
</rule>