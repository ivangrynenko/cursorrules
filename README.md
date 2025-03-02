# Cursor AI Project Rules for Web Development

## 📌 About This Repository
This repository contains a **set of Cursor AI rules** specifically designed to **enhance efficiency, enforce coding standards, and automate best practices** for **web developers**, particularly those working with **PHP, Drupal, JavaScript, and frontend frameworks**.

These rules help **Cursor AI** assist developers by:
- Enforcing coding standards and best practices
- Ensuring tests and documentation remain up to date
- Detecting inefficiencies in AI query usage and improving response quality
- Providing automated suggestions for commit messages, dependencies, and performance optimisations

---

## 🚀 Who Is This For?
This repository is ideal for:
- **PHP & Drupal developers** following Drupal coding standards
- **Web developers** working with JavaScript, React, Vue, Tailwind, and other frontend technologies
- **Software teams** looking for a structured, automated workflow with Cursor AI
- **Open-source contributors** who want a standardised set of development rules

---

## 🔧 Installation

You can install these rules using one of the following methods:

### Option 1: Quick Install (Recommended)

> **⚠️ Important Update**: Core rules (cursor-rules, improve-cursorrules-efficiency, git-commit-standards, readme-maintenance-standards) are automatically included in all installation types. This ensures essential functionality is always available regardless of your project type.

Run this command in your project root:

```sh
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php
```

This will:
1. Download and run the installer
2. Prompt you to select your primary use case:
   - **Web Stack** (Drupal, PHP, JavaScript, CSS + core rules)
   - **Python** (Python, Django, Flask + core rules)
   - **All Rules** (Install everything, includes core rules)
   - **Core Rules Only** (Install only essential rules)
   - **Tag-Based Selection** (Filter rules by tags)
   - **Custom Selection** (Choose specific rule sets)
3. Create the `.cursor/rules` directory if it doesn't exist
4. Install all selected Cursor rules
5. Install the UPDATE.md file with instructions for future updates
6. Remove the installer script automatically

#### CLI Options

The installer supports the following command-line options:

```sh
# Install Web Stack rules (Drupal, PHP, JS, CSS) + Core rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --web-stack

# Install Python rules + Core rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --python

# Install all rules (Core, Web Stack, Python)
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --all

# Install only core rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --core

# Install rules by tag expression
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "language:javascript category:security"

# Install rules using a predefined tag preset
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset security

# Language-specific security presets
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset php-security  # PHP security rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset js-security   # JavaScript security rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset python-security  # Python security rules

# OWASP Top 10 presets by language
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset php-owasp     # PHP OWASP rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset js-owasp      # JavaScript OWASP rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset python-owasp  # Python OWASP rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset drupal-owasp  # Drupal OWASP rules

# Control installation of .cursorignore files
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --ignore-files yes  # Always install
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --ignore-files no   # Never install
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --ignore-files ask  # Prompt user (default)

# Auto-confirm all prompts
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --yes

# Quiet mode (minimal output)
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --quiet

# Combine options
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --web-stack --yes --quiet
# OR
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "framework:drupal" --yes --quiet
```

Short options are also available:
- `-w`: Web Stack (includes core rules)
- `-p`: Python (includes core rules)
- `-a`: All rules (includes core rules)
- `-c`: Core rules only
- `-t`: Tag expression
- `-y`: Auto-confirm
- `-q`: Quiet mode
- `-h`: Help

#### Tag-Based Selection

The installer now supports filtering rules by tags, allowing you to install only the rules relevant to your project:

```sh
# Install all JavaScript security rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "language:javascript category:security"

# Install all OWASP Top 10 rules for PHP
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "language:php standard:owasp-top10"

# Install all React-related rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "framework:react"

# Install rules matching multiple criteria with OR logic
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "language:javascript OR language:php"
```

Available tag presets:
- `web`: JavaScript, HTML, CSS, PHP
- `frontend`: JavaScript, HTML, CSS
- `drupal`: Drupal-specific rules
- `react`: React-specific rules
- `vue`: Vue-specific rules
- `python`: Python-specific rules
- `security`: Security-focused rules
- `owasp`: OWASP Top 10 rules
- `a11y`: Accessibility rules
- `php-security`: PHP security-focused rules
- `js-security`: JavaScript security-focused rules
- `python-security`: Python security-focused rules
- `drupal-security`: Drupal security-focused rules
- `php-owasp`: PHP OWASP Top 10 rules
- `js-owasp`: JavaScript OWASP Top 10 rules
- `python-owasp`: Python OWASP Top 10 rules
- `drupal-owasp`: Drupal OWASP Top 10 rules

See the [TAG_STANDARDS.md](TAG_STANDARDS.md) file for detailed information about the tagging system.

### Option 2: Manual Installation

1. **Clone this repository** into your project:
```sh
git clone https://github.com/ivangrynenko/cursor-rules.git
cd cursor-rules
```

2. **Copy the rules into your project's .cursor/rules/ directory:**
```sh
mkdir -p .cursor/rules
cp .cursor/rules/*.mdc .cursor/rules/
cp .cursor/UPDATE.md .cursor/
```

After installation, the rules will automatically be used by Cursor AI in your workflow.

### Updating Cursor Rules

For information on updating your cursor rules, see the `.cursor/UPDATE.md` file that is installed along with the rules, or run the installer script again.

---

## 📜 Available Cursor Rules
Each rule is written in `.mdc` format and structured to enforce best practices in different aspects of development.

### Implementation Considerations

The following considerations will guide our implementation approach:

| Factor | Approach |
|--------|----------|
| Language-specific rules | Separate rule files for PHP/Drupal, JavaScript, React, Vue, etc. |
| Framework-specific patterns | Framework-specific security patterns and anti-patterns |
| Security context | Consider the security context of different application components |
| Positive patterns | Include recommended secure implementation examples |
| Documentation | Link to detailed remediation guides and security best practices |

### Core Rules
| File Name | Purpose |
|-----------|---------|
| [`cursor-rules.mdc`](.cursor/rules/cursor-rules.mdc) | Defines standards for creating and organising Cursor rule files |
| [`improve-cursorrules-efficiency.mdc`](.cursor/rules/improve-cursorrules-efficiency.mdc) | Detects and optimises inefficient AI queries |
| [`git-commit-standards.mdc`](.cursor/rules/git-commit-standards.mdc) | Enforces structured Git commit messages and prefixes |
| [`govcms-saas.mdc`](.cursor/rules/govcms-saas.mdc) | Defines constraints and best practices for GovCMS Distribution projects focusing on theme-level development. |

### Frontend Development
| File Name | Purpose |
|-----------|---------|
| [`vue-best-practices.mdc`](.cursor/rules/vue-best-practices.mdc) | Vue 3 and NuxtJS specific standards and optimisations |
| [`react-patterns.mdc`](.cursor/rules/react-patterns.mdc) | React component patterns and hooks usage guidelines |
| [`tailwind-standards.mdc`](.cursor/rules/tailwind-standards.mdc) | Tailwind CSS class organisation and best practices |
| [`accessibility-standards.mdc`](.cursor/rules/accessibility-standards.mdc) | WCAG compliance and accessibility best practices |

### Backend Development
| File Name | Purpose |
|-----------|---------|
| [`php-drupal-best-practices.mdc`](.cursor/rules/php-drupal-best-practices.mdc) | PHP 8.3+ features and Drupal coding standards |
| [`drupal-database-standards.mdc`](.cursor/rules/drupal-database-standards.mdc) | Database schema changes and query optimisation |
| [`security-practices.mdc`](.cursor/rules/security-practices.mdc) | Security best practices for PHP, JavaScript, and Drupal |

### Build & Integration
| File Name | Purpose |
|-----------|---------|
| [`build-optimization.mdc`](.cursor/rules/build-optimization.mdc) | Webpack/Vite configuration and build process optimisation |
| [`node-dependencies.mdc`](.cursor/rules/node-dependencies.mdc) | Node.js versioning and package management |
| [`api-standards.mdc`](.cursor/rules/api-standards.mdc) | RESTful API design and documentation standards |
| [`third-party-integration.mdc`](.cursor/rules/third-party-integration.mdc) | Standards for integrating external services |
| [`lagoon-yml-standards.mdc`](.cursor/rules/lagoon-yml-standards.mdc) | Standards for Lagoon configuration files |
| [`lagoon-docker-compose-standards.mdc`](.cursor/rules/lagoon-docker-compose-standards.mdc) | Standards for Lagoon Docker Compose files |
| [`vortex-scaffold-standards.mdc`](.cursor/rules/vortex-scaffold-standards.mdc) | Standards for Vortex/DrevOps scaffold usage |
| [`vortex-cicd-standards.mdc`](.cursor/rules/vortex-cicd-standards.mdc) | Standards for Vortex CI/CD configuration |

### Documentation & Process
| File Name | Purpose |
|-----------|---------|
| [`readme-maintenance-standards.mdc`](.cursor/rules/readme-maintenance-standards.mdc) | Standards for README documentation |
| [`multi-agent-coordination.mdc`](.cursor/rules/multi-agent-coordination.mdc) | Multi-agent coordination standards |
| [`code-generation-standards.mdc`](.cursor/rules/code-generation-standards.mdc) | Standards for code generation |
| [`debugging-standards.mdc`](.cursor/rules/debugging-standards.mdc) | Standards for debugging and error handling |
| [`project-definition-template.mdc`](.cursor/rules/project-definition-template.mdc) | Template for defining project context |

### OWASP Top 10 Security Standards

This section outlines cursor rules for addressing the OWASP Top 10 web application security risks. The Drupal and Python rules implemented below are preliminary and need testing and refinement. We will need to continue to work through additional Top Ten compliance rules for other languages/frameworks.

| Security Risk/Filename | Purpose | Implementation Status |
|---------------|---------|----------------------|
| [`drupal-broken-access-control.mdc`](.cursor/rules/drupal-broken-access-control.mdc) | [A01:2021-Broken Access Control](https://owasp.org/Top10/A01_2021-Broken_Access_Control/) Identify and prevent broken access control patterns in Drupal applications | Ready for testing |
| [`drupal-cryptographic-failures.mdc`](.cursor/rules/drupal-cryptographic-failures.mdc) | [A02:2021-Cryptographic Failures](https://owasp.org/Top10/A02_2021-Cryptographic_Failures/) Detect weak encryption, hardcoded credentials, and insecure data storage in Drupal | Ready for testing |
| [`drupal-injection.mdc`](.cursor/rules/drupal-injection.mdc) | [A03:2021-Injection](https://owasp.org/Top10/A03_2021-Injection/) Flag potential SQL injection, XSS, CSRF, and command injection vulnerabilities in Drupal | Ready for testing |
| [`drupal-insecure-design.mdc`](.cursor/rules/drupal-insecure-design.mdc) | [A04:2021-Insecure Design](https://owasp.org/Top10/A04_2021-Insecure_Design/) Promote secure design patterns and identify architectural issues in Drupal | Ready for testing |
| [`drupal-security-misconfiguration.mdc`](.cursor/rules/drupal-security-misconfiguration.mdc) | [A05:2021-Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/) Identify security misconfigurations in Drupal application settings | Ready for testing |
| [`drupal-vulnerable-components.mdc`](.cursor/rules/drupal-vulnerable-components.mdc) | [A06:2021-Vulnerable and Outdated Components](https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/) Detect deprecated libraries and vulnerable dependencies in Drupal | Ready for testing |
| [`drupal-authentication-failures.mdc`](.cursor/rules/drupal-authentication-failures.mdc) | [A07:2021-Identification and Authentication Failures](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) Verify secure authentication and identification practices in Drupal | Ready for testing |
| [`drupal-integrity-failures.mdc`](.cursor/rules/drupal-integrity-failures.mdc) | [A08:2021-Software and Data Integrity Failures](https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/) Find insecure deserialisation and integrity verification issues in Drupal | Ready for testing |
| [`drupal-logging-failures.mdc`](.cursor/rules/drupal-logging-failures.mdc) | [A09:2021-Security Logging and Monitoring Failures](https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/) Ensure proper security event logging and monitoring in Drupal | Ready for testing |
| [`drupal-ssrf.mdc`](.cursor/rules/drupal-ssrf.mdc) | [A10:2021-Server-Side Request Forgery](https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/) Detect and prevent server-side request forgery vulnerabilities in Drupal | Ready for testing |
| [`python-broken-access-control.mdc`](.cursor/rules/python-broken-access-control.mdc) | [A01:2021-Broken Access Control](https://owasp.org/Top10/A01_2021-Broken_Access_Control/) Identify and prevent broken access control patterns in Python applications | Ready for testing |
| [`python-cryptographic-failures.mdc`](.cursor/rules/python-cryptographic-failures.mdc) | [A02:2021-Cryptographic Failures](https://owasp.org/Top10/A02_2021-Cryptographic_Failures/) Detect weak encryption, hardcoded credentials, and insecure data storage in Python | Ready for testing |
| [`python-injection.mdc`](.cursor/rules/python-injection.mdc) | [A03:2021-Injection](https://owasp.org/Top10/A03_2021-Injection/) Flag potential SQL injection, XSS, and command injection vulnerabilities in Python | Ready for testing |
| [`python-insecure-design.mdc`](.cursor/rules/python-insecure-design.mdc) | [A04:2021-Insecure Design](https://owasp.org/Top10/A04_2021-Insecure_Design/) Promote secure design patterns and identify architectural issues in Python | Ready for testing |
| [`python-security-misconfiguration.mdc`](.cursor/rules/python-security-misconfiguration.mdc) | [A05:2021-Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/) Identify security misconfigurations in Python application settings | Ready for testing |
| [`python-vulnerable-outdated-components.mdc`](.cursor/rules/python-vulnerable-outdated-components.mdc) | [A06:2021-Vulnerable and Outdated Components](https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/) Detect outdated dependencies and vulnerable components in Python applications | Ready for testing |
| [`python-authentication-failures.mdc`](.cursor/rules/python-authentication-failures.mdc) | [A07:2021-Identification and Authentication Failures](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) Verify secure authentication and identification practices in Python applications | Ready for testing |
| [`python-integrity-failures.mdc`](.cursor/rules/python-integrity-failures.mdc) | [A08:2021-Software and Data Integrity Failures](https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/) Find insecure deserialisation and integrity verification issues in Python applications | Ready for testing |
| [`python-logging-monitoring-failures.mdc`](.cursor/rules/python-logging-monitoring-failures.mdc) | [A09:2021-Security Logging and Monitoring Failures](https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/) Ensure proper security event logging and monitoring in Python applications | Ready for testing |
| [`python-ssrf.mdc`](.cursor/rules/python-ssrf.mdc) | [A10:2021-Server-Side Request Forgery](https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/) Detect and prevent server-side request forgery vulnerabilities in Python applications | Ready for testing |
| [`javascript-broken-access-control.mdc`](.cursor/rules/javascript-broken-access-control.mdc) | [A01:2021-Broken Access Control](https://owasp.org/Top10/A01_2021-Broken_Access_Control/) Identify and prevent broken access control patterns in JavaScript applications | Ready for testing |
| [`javascript-cryptographic-failures.mdc`](.cursor/rules/javascript-cryptographic-failures.mdc) | [A02:2021-Cryptographic Failures](https://owasp.org/Top10/A02_2021-Cryptographic_Failures/) Detect weak encryption, hardcoded credentials, and insecure data storage in JavaScript | Ready for testing |
| [`javascript-injection.mdc`](.cursor/rules/javascript-injection.mdc) | [A03:2021-Injection](https://owasp.org/Top10/A03_2021-Injection/) Flag potential SQL injection, XSS, CSRF, and command injection vulnerabilities in JavaScript | Ready for testing |
| [`javascript-insecure-design.mdc`](.cursor/rules/javascript-insecure-design.mdc) | [A04:2021-Insecure Design](https://owasp.org/Top10/A04_2021-Insecure_Design/) Promote secure design patterns and identify architectural issues in JavaScript | Ready for testing |
| [`javascript-security-misconfiguration.mdc`](.cursor/rules/javascript-security-misconfiguration.mdc) | [A05:2021-Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/) Identify security misconfigurations in JavaScript application settings | Ready for testing |
| [`javascript-vulnerable-outdated-components.mdc`](.cursor/rules/javascript-vulnerable-outdated-components.mdc) | [A06:2021-Vulnerable and Outdated Components](https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/) Detect deprecated libraries and known vulnerable dependencies in JavaScript applications | Ready for testing |
| [`javascript-identification-authentication-failures.mdc`](.cursor/rules/javascript-identification-authentication-failures.mdc) | [A07:2021-Identification and Authentication Failures](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) Verify secure authentication and identification practices in JavaScript applications | Ready for testing |
| [`javascript-software-data-integrity-failures.mdc`](.cursor/rules/javascript-software-data-integrity-failures.mdc) | [A08:2021-Software and Data Integrity Failures](https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/) Find insecure deserialisation and integrity verification issues in JavaScript applications | Ready for testing |
| [`javascript-security-logging-monitoring-failures.mdc`](.cursor/rules/javascript-security-logging-monitoring-failures.mdc) | [A09:2021-Security Logging and Monitoring Failures](https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/) Ensure proper security event logging and monitoring in JavaScript applications | Ready for testing |
| [`javascript-server-side-request-forgery.mdc`](.cursor/rules/javascript-server-side-request-forgery.mdc) | [A10:2021-Server-Side Request Forgery](https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/) Detect and prevent server-side request forgery vulnerabilities in JavaScript applications | Ready for testing |
| [A01:2021-Broken Access Control](https://owasp.org/Top10/A01_2021-Broken_Access_Control/) | #TODO Identify and prevent broken access control patterns | Not started |
| [A02:2021-Cryptographic Failures](https://owasp.org/Top10/A02_2021-Cryptographic_Failures/) | #TODO Detect weak encryption, hardcoded credentials, and insecure data storage | Not started |
| [A03:2021-Injection](https://owasp.org/Top10/A03_2021-Injection/) | #TODO Flag potential SQL injection, XSS, and command injection vulnerabilities | Not started |
| [A04:2021-Insecure Design](https://owasp.org/Top10/A04_2021-Insecure_Design/) | #TODO Promote secure design patterns and identify architectural issues | Not started |
| [A05:2021-Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/) | #TODO Identify security misconfigurations in application settings | Not started |
| [A06:2021-Vulnerable and Outdated Components](https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/) | #TODO Detect deprecated libraries and known vulnerable dependencies | Not started |
| [A07:2021-Identification and Authentication Failures](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) | #TODO Verify secure authentication practices | Not started |
| [A08:2021-Software and Data Integrity Failures](https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/) | #TODO Find insecure deserialization and integrity verification issues | Not started |
| [A09:2021-Security Logging and Monitoring Failures](https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/) | #TODO Ensure proper security event logging | Not started |
| [A10:2021-Server-Side Request Forgery](https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/) | #TODO Identify when user input influences outbound requests | Not started |

---

## 🤖 Using Cursor AI

To enhance your documentation and ensure it remains up-to-date, consider using **Cursor AI** itself. The **"cursor-small"** model can assist in updating your README.md file based on the rules and context defined in your project. 

### Steps to Use Cursor AI:
1. **Invoke Cursor AI** with the context of your project.
2. **Request updates** for the README.md file.
3. **Review the suggested changes** and ensure they align with your project goals.

## 🤝 Contributing

Contributions are welcome! If you have suggestions, feel free to open a pull request or submit an issue.

How to Contribute:
- Fork this repository
- Create a new branch (`feature/my-improvement`)
- Commit changes using proper commit prefixes (`feat:`, `fix:`, etc.)
- Submit a pull request for review

## 📝 License

This repository is licensed under the MIT License, allowing free and open usage.

## 🎯 Future Enhancements
- Additional rules for specific frameworks and CMS platforms
- Customisable rule sets for different types of projects
- Integration with CI/CD pipelines to automate rule enforcement
- Use the `project-definition-template.mdc` rule to define your project's context and structure.

🚀 Let's improve web development workflows together with Cursor AI!

---

### **Key Features of This README:**
✅ **Clear Purpose:** Explains the repository's goal and its relevance to web developers  
✅ **User-Friendly Structure:** Provides a **table** listing the available rules and their function  
✅ **Step-by-Step Instructions:** Explains how to use the rules with Cursor AI  
✅ **Contribution Guidelines:** Encourages open-source collaboration  
✅ **Future Enhancements:** Shows a roadmap for potential improvements  

---

💡 **Note:** This repository is actively maintained and updated. Feel free to submit issues or pull requests for improvements!

## 🔒 Security Features

### Default .cursorignore File

This repository includes a default `.cursorignore` file that prevents Cursor from analysing sensitive or irrelevant files. This improves both security and performance by excluding files like:

- Version control directories (`.git/`)
- Dependency directories (`node_modules/`, `vendor/`)
- Environment and secret files (`.env`, `*.key`, `*secret*`)
- Private keys and certificates (`*.pem`, `*.p12`)
- Build artifacts and temporary files

When you install the cursor rules, the `.cursorignore` file is automatically copied to your project root directory.

### Secret Detection Rule

The repository includes a dedicated rule for detecting potential secrets and sensitive data in code files:

| File Name | Purpose |
|-----------|---------|
| [`secret-detection.mdc`](.cursor/rules/secret-detection.mdc) | Detect and warn about potential secrets, API keys, and credentials in code |

This rule helps prevent accidental exposure of sensitive information by identifying common patterns for:
- API keys and tokens
- Database credentials
- Private keys and certificates
- Hardcoded passwords
- Connection strings
- OAuth tokens
- JWT tokens
- AWS, Google Cloud, and Azure credentials

When detected, the rule provides warnings and suggests best practices for secure secret management.

### Intelligent OWASP Rule Selection

The installer now features intelligent OWASP rule selection based on language tags:

- When you specify a language tag (e.g., `language:php`) along with security-related tags (e.g., `category:security` or `standard:owasp-top10`), the installer automatically includes all relevant OWASP rules for that language.
- Language-specific security presets are available for quick installation of security rules for specific languages.
- The secret detection rule is now included in all installations by default to ensure basic security coverage.

Example:
```sh
# This will automatically include all PHP OWASP rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "language:php standard:owasp-top10"

# This will include all JavaScript security rules
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tag-preset js-security
```

The interactive installer also includes a new "Security Focus" option that allows you to select language-specific security rules.

## 🏷️ Tag-Based Rule Selection

The repository includes a Python script for selecting cursor rules based on tags. This allows you to install only the rules relevant to your project:

```sh
# Install rules based on a tag query
python scripts/select_rules.py --query "language:javascript AND category:security" --target-dir /path/to/project/.cursor/rules

# Install rules using a preset
python scripts/select_rules.py --preset web --target-dir /path/to/project/.cursor/rules

# List matching rules without copying
python scripts/select_rules.py --preset python --list-only
```

Available presets:
- `web`: JavaScript, HTML, CSS, PHP
- `frontend`: JavaScript, HTML, CSS, React, Vue, Angular
- `backend`: PHP, Python, Node.js
- `drupal`: Drupal-specific rules
- `react`: React-specific rules
- `vue`: Vue-specific rules
- `python`: Python-specific rules
- `security`: Security-focused rules
- `owasp`: OWASP Top 10 rules
- `a11y`: Accessibility rules
- `core`: Essential core rules

See the [TAG_STANDARDS.md](TAG_STANDARDS.md) file for detailed information about tags, including:
- Tag structure and hierarchy
- Primary tag categories
- Guidelines for using and adding tags
- Example tag queries

## 📋 Role-Based Development

This repository implements a multi-agent development workflow with two primary roles:

### Planner Role
- Performs high-level analysis
- Breaks down tasks into manageable units
- Defines success criteria
- Evaluates progress
- Uses high-intelligence models for planning

### Executor Role
- Implements specific tasks
- Writes and tests code
- Reports progress
- Raises questions or blockers
- Follows Planner's directives

## 📝 Workflow Guidelines

1. **Task Initialisation**
   - Planner analyses requirements
   - Documents background and motivation
   - Creates high-level task breakdown

2. **Development Cycle**
   - Executor implements tasks
   - Reports progress regularly
   - Raises questions when blocked
   - Planner reviews and adjusts plans

3. **Quality Control**
   - Planner verifies task completion
   - Cross-checks against success criteria
   - Provides feedback for improvements

4. **Documentation**
   - Track progress in structured format
   - Maintain clear communication records
   - Document lessons learned

## 📝 Initial Setup Steps

### Option 1: Define Your Project Context Using Cursor AI
- After adding the rules to your project, use the **Cursor AI** and the **"cursor-small"** model to document your project's purpose, technical stack, folder structure, customisations, and libraries.
- **Steps to Use Cursor AI:**
  1. **Invoke Cursor AI** with the context of your project.
  2. **Request updates** for the README.md file.
  3. **Review the suggested changes** and ensure they align with your project goals.

### Option 2: Manual Definition of Your Project Context
1. **Define Your Project Context:**
   - Search for the README file and `/docs/` folder to gather context.
   - Use the `project-definition-template.mdc` rule to document your project's purpose, technical stack, folder structure, customisations, and libraries.

2. **Follow the Guidelines:**
   - Update the README file with the necessary sections as outlined in the project definition rule.
   - Maintain clear and concise documentation for future reference.

3. **Continue with Other Rules:**
   - Once the project context is defined, proceed to implement other rules to enhance code quality and maintainability.

## 📊 Managing Cursor Rules at Scale

This repository contains a significant number of rules covering multiple languages, frameworks, and security concerns. Here are some considerations and recommendations for managing rules at scale:

### Potential Constraints

1. **Performance Considerations**:
   - Each rule requires processing when Cursor AI evaluates a file
   - While individual rules have minimal impact, large collections could potentially affect performance
   - Current collection size (25+ general rules, 10 OWASP security rules) should not cause notable performance issues

2. **Rule Conflicts**:
   - Rules from different frameworks or languages might occasionally provide conflicting recommendations
   - Filter patterns help mitigate this by ensuring rules only trigger for relevant files
   - Priority settings in rule metadata can help resolve conflicts when multiple rules apply

3. **Maintenance Complexity**:
   - As the rule collection grows, testing and maintenance effort increases
   - Version compatibility across rules becomes more important to track
   - Documentation needs increase proportionally with rule count

### Benefits of a Unified Repository

1. **Simplified Installation and Management**:
   - Single installation command for all rules
   - Consistent versioning across all rules
   - Centralised documentation and examples

2. **Rule Filtering System**:
   - Built-in file extension and path filtering prevents irrelevant rule application
   - Rules for specific languages/frameworks won't be triggered for unrelated files
   - Metadata tagging allows for logical organisation without physical separation

3. **Holistic Development Experience**:
   - Comprehensive coverage across different aspects of development
   - Consistent enforcement of standards across technologies
   - Simplified onboarding for new team members

### Recommendations for Users

1. **Selective Rule Usage**:
   - Disable rules not relevant to your specific technology stack
   - Configure rule priorities based on your project's needs
   - Consider creating custom installation scripts that only install relevant rules

2. **Performance Optimisation**:
   - If experiencing slowdowns, review which rules are most frequently triggered
   - Consider disabling computationally expensive rules for very large files
   - Report performance issues so rule patterns can be optimised

3. **Custom Rule Development**:
   - When creating custom rules, follow the patterns established in existing rules
   - Use specific file filters to minimise unnecessary rule evaluation
   - Test new rules thoroughly in isolation before adding to the collection

### Future Scalability Plans

While maintaining all rules in a single repository currently provides the best developer experience, we're preparing for potential future growth:

1. **Enhanced Categorisation**:
   - Rules include clear language/framework tagging with a structured hierarchical system (As seen in the OWASP Top Ten Rules):
     - `language:php` - Explicitly identifies the programming language
     - `framework:drupal` - Specifies the framework or CMS
     - `category:security` - Defines the primary functional category
     - `subcategory:injection` - Provides more granular categorisation (e.g., injection, authentication)
     - `standard:owasp-top10` - Identifies the security standard being applied
     - `risk:a01-broken-access-control` - Specifies the exact risk identifier
   - This tagging system enables selective installation based on language, framework, or security concern
   - Installation scripts can target specific categories (e.g., only install PHP rules or only OWASP rules)

2. **Modular Design**:
   - Rule file structure supports potential future separation
   - Consistent naming conventions facilitate organisation

3. **Monitoring and Feedback**:
   - Repository growth and performance impacts are monitored
   - User feedback helps identify optimisation opportunities

If you encounter any issues with rule management or have suggestions for improving organisation, please submit an issue or pull request.

## Categorisation System

Cursor Rules now feature a structured hierarchical tagging system that enables precise rule filtering based on project requirements:

### Standardised Tag Structure

- **Language tags**: `language:php`, `language:javascript`, `language:python`, etc.
- **Framework tags**: `framework:drupal`, `framework:react`, `framework:django`, etc.
- **Category tags**: `category:security`, `category:performance`, `category:accessibility`, etc.
- **Subcategory tags**: `subcategory:injection`, `subcategory:authentication`, `subcategory:xss`, etc.
- **Standard tags**: `standard:owasp-top10`, `standard:wcag`, `standard:pci-dss`, etc.
- **Risk tags**: `risk:a01-broken-access-control`, `risk:a05-security-misconfiguration`, etc.

### Tag-Based Rule Selection

The enhanced tagging system enables selective installation of rules:

- **Project-specific rules**: Automatically select rules based on your project's languages and frameworks
- **Security-focused installations**: Target specific security concerns (e.g., only OWASP Top 10 rules)
- **Composite filtering**: Combine multiple criteria (e.g., PHP Drupal security rules)

For complete documentation of the tagging system, see [TAG_STANDARDS.md](TAG_STANDARDS.md).

### Rule Selection Script

A Python script (`select_rules.py`) is provided to automate rule selection based on tags:

```bash
# Auto-detect project type and select appropriate rules
python select_rules.py --auto

# Select rules by specific tags
python select_rules.py --tags "language:python standard:owasp-top10"

# List all available tags
python select_rules.py --list-tags
```