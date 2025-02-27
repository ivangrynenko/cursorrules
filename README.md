# Cursor AI Project Rules for Web Development

[![Cursor Rules Tests](https://github.com/ivangrynenko/cursor-rules/actions/workflows/test.yml/badge.svg)](https://github.com/ivangrynenko/cursor-rules/actions/workflows/test.yml)

## 📌 About This Repository
This repository contains a **set of Cursor AI rules** specifically designed to **enhance efficiency, enforce coding standards, and automate best practices** for **web developers**, particularly those working with **PHP, Drupal, JavaScript, and frontend frameworks**.

These rules help **Cursor AI** assist developers by:
- Enforcing coding standards and best practices
- Ensuring tests and documentation remain up to date
- Detecting inefficiencies in AI query usage and improving response quality
- Providing automated suggestions for commit messages, dependencies, and performance optimizations

---

## 🚀 Who Is This For?
This repository is ideal for:
- **PHP & Drupal developers** following Drupal coding standards
- **Web developers** working with JavaScript, React, Vue, Tailwind, and other frontend technologies
- **Software teams** looking for a structured, automated workflow with Cursor AI
- **Open-source contributors** who want a standardized set of development rules

---

## 📜 Available Cursor Rules
Each rule is written in `.mdc` format and structured to enforce best practices in different aspects of development.

### Core Rules
| File Name | Purpose |
|-----------|---------|
| [`cursor-rules.mdc`](.cursor/rules/cursor-rules.mdc) | Defines standards for creating and organizing Cursor rule files |
| [`improve-cursorrules-efficiency.mdc`](.cursor/rules/improve-cursorrules-efficiency.mdc) | Detects and optimizes inefficient AI queries |
| [`git-commit-standards.mdc`](.cursor/rules/git-commit-standards.mdc) | Enforces structured Git commit messages and prefixes |
| [`github-actions-standards.mdc`](.cursor/rules/github-actions-standards.mdc) | Ensures GitHub Actions workflows follow best practices and use the latest action versions |
| [`govcms-saas.mdc`](.cursor/rules/govcms-saas.mdc) | Defines constraints and best practices for GovCMS Distribution projects focusing on theme-level development. |

### Frontend Development
| File Name | Purpose |
|-----------|---------|
| [`vue-best-practices.mdc`](.cursor/rules/vue-best-practices.mdc) | Vue 3 and NuxtJS specific standards and optimizations |
| [`react-patterns.mdc`](.cursor/rules/react-patterns.mdc) | React component patterns and hooks usage guidelines |
| [`tailwind-standards.mdc`](.cursor/rules/tailwind-standards.mdc) | Tailwind CSS class organization and best practices |
| [`accessibility-standards.mdc`](.cursor/rules/accessibility-standards.mdc) | WCAG compliance and accessibility best practices |

### Backend Development
| File Name | Purpose |
|-----------|---------|
| [`php-drupal-best-practices.mdc`](.cursor/rules/php-drupal-best-practices.mdc) | PHP 8.3+ features and Drupal coding standards |
| [`drupal-database-standards.mdc`](.cursor/rules/drupal-database-standards.mdc) | Database schema changes and query optimization |
| [`security-practices.mdc`](.cursor/rules/security-practices.mdc) | Security best practices for PHP, JavaScript, and Drupal |

### Build & Integration
| File Name | Purpose |
|-----------|---------|
| [`build-optimization.mdc`](.cursor/rules/build-optimization.mdc) | Webpack/Vite configuration and build process optimization |
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

## OWASP Top 10 Security Standards

This section outlines cursor rules for addressing the OWASP Top 10 web application security risks. The Drupal and Python rules implemented below are preliminary and need testing and refinement. We will need to continue to work through additional Top Ten compliance rules for other languages/frameworks.

| Security Risk/Filename | Purpose | Implementation Status |
|---------------|---------|----------------------|
| [`drupal-broken-access-control.mdc`](.cursor/rules/drupal-broken-access-control.mdc) | [A01:2021-Broken Access Control](https://owasp.org/Top10/A01_2021-Broken_Access_Control/) Identify and prevent broken access control patterns in Drupal applications | Completed |
| [`drupal-cryptographic-failures.mdc`](.cursor/rules/drupal-cryptographic-failures.mdc) | [A02:2021-Cryptographic Failures](https://owasp.org/Top10/A02_2021-Cryptographic_Failures/) Detect weak encryption, hardcoded credentials, and insecure data storage in Drupal | Completed |
| [`drupal-injection.mdc`](.cursor/rules/drupal-injection.mdc) | [A03:2021-Injection](https://owasp.org/Top10/A03_2021-Injection/) Flag potential SQL injection, XSS, CSRF, and command injection vulnerabilities in Drupal | Completed |
| [`drupal-insecure-design.mdc`](.cursor/rules/drupal-insecure-design.mdc) | [A04:2021-Insecure Design](https://owasp.org/Top10/A04_2021-Insecure_Design/) Promote secure design patterns and identify architectural issues in Drupal | Completed |
| [`drupal-security-misconfiguration.mdc`](.cursor/rules/drupal-security-misconfiguration.mdc) | [A05:2021-Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/) Identify security misconfigurations in Drupal application settings | Completed |
| [`drupal-vulnerable-components.mdc`](.cursor/rules/drupal-vulnerable-components.mdc) | [A06:2021-Vulnerable and Outdated Components](https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/) Detect deprecated libraries and vulnerable dependencies in Drupal | Completed |
| [`drupal-authentication-failures.mdc`](.cursor/rules/drupal-authentication-failures.mdc) | [A07:2021-Identification and Authentication Failures](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) Verify secure authentication and identification practices in Drupal | Completed |
| [`drupal-integrity-failures.mdc`](.cursor/rules/drupal-integrity-failures.mdc) | [A08:2021-Software and Data Integrity Failures](https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/) Find insecure deserialization and integrity verification issues in Drupal | Completed |
| [`drupal-logging-failures.mdc`](.cursor/rules/drupal-logging-failures.mdc) | [A09:2021-Security Logging and Monitoring Failures](https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/) Ensure proper security event logging and monitoring in Drupal | Completed |
| [`drupal-ssrf.mdc`](.cursor/rules/drupal-ssrf.mdc) | [A10:2021-Server-Side Request Forgery](https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/) Detect and prevent server-side request forgery vulnerabilities in Drupal | Completed |
| [`python-broken-access-control.mdc`](.cursor/rules/python-broken-access-control.mdc) | [A01:2021-Broken Access Control](https://owasp.org/Top10/A01_2021-Broken_Access_Control/) Identify and prevent broken access control patterns in Python applications | Completed |
| [`python-cryptographic-failures.mdc`](.cursor/rules/python-cryptographic-failures.mdc) | [A02:2021-Cryptographic Failures](https://owasp.org/Top10/A02_2021-Cryptographic_Failures/) Detect weak encryption, hardcoded credentials, and insecure data storage in Python | Completed |
| [`python-injection.mdc`](.cursor/rules/python-injection.mdc) | [A03:2021-Injection](https://owasp.org/Top10/A03_2021-Injection/) Flag potential SQL injection, XSS, and command injection vulnerabilities in Python | Completed |
| [`python-insecure-design.mdc`](.cursor/rules/python-insecure-design.mdc) | [A04:2021-Insecure Design](https://owasp.org/Top10/A04_2021-Insecure_Design/) Promote secure design patterns and identify architectural issues in Python | Completed |
| [`python-security-misconfiguration.mdc`](.cursor/rules/python-security-misconfiguration.mdc) | [A05:2021-Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/) Identify security misconfigurations in Python application settings | Completed |
| [`python-vulnerable-outdated-components.mdc`](.cursor/rules/python-vulnerable-outdated-components.mdc) | [A06:2021-Vulnerable and Outdated Components](https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/) Detect outdated dependencies and vulnerable components in Python applications | Completed |
| [`python-authentication-failures.mdc`](.cursor/rules/python-authentication-failures.mdc) | [A07:2021-Identification and Authentication Failures](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) Verify secure authentication and identification practices in Python applications | Completed |
| [`python-integrity-failures.mdc`](.cursor/rules/python-integrity-failures.mdc) | [A08:2021-Software and Data Integrity Failures](https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/) Find insecure deserialization and integrity verification issues in Python applications | Completed |
| [`python-logging-monitoring-failures.mdc`](.cursor/rules/python-logging-monitoring-failures.mdc) | [A09:2021-Security Logging and Monitoring Failures](https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/) Ensure proper security event logging and monitoring in Python applications | Completed |
| [`python-ssrf.mdc`](.cursor/rules/python-ssrf.mdc) | [A10:2021-Server-Side Request Forgery](https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/) Detect and prevent server-side request forgery vulnerabilities in Python applications | Completed |
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

### Implementation Considerations

The following considerations will guide our implementation approach:

| Factor | Approach |
|--------|----------|
| Language-specific rules | Separate rule files for PHP/Drupal, JavaScript, React, Vue, etc. |
| Framework-specific patterns | Framework-specific security patterns and anti-patterns |
| Security context | Consider the security context of different application components |
| Positive patterns | Include recommended secure implementation examples |
| Documentation | Link to detailed remediation guides and security best practices |

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

# Auto-confirm all prompts
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --yes

# Quiet mode (minimal output)
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --quiet

# Combine options
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --web-stack --yes --quiet
```

Short options are also available:
- `-w`: Web Stack (includes core rules)
- `-p`: Python (includes core rules)
- `-a`: All rules (includes core rules)
- `-c`: Core rules only
- `-y`: Auto-confirm
- `-q`: Quiet mode
- `-h`: Help

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
- Customizable rule sets for different types of projects
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

1. **Task Initialization**
   - Planner analyzes requirements
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
- After adding the rules to your project, use the **Cursor AI** and the **"cursor-small"** model to document your project's purpose, technical stack, folder structure, customizations, and libraries.
- **Steps to Use Cursor AI:**
  1. **Invoke Cursor AI** with the context of your project.
  2. **Request updates** for the README.md file.
  3. **Review the suggested changes** and ensure they align with your project goals.

### Option 2: Manual Definition of Your Project Context
1. **Define Your Project Context:**
   - Search for the README file and `/docs/` folder to gather context.
   - Use the `project-definition-template.mdc` rule to document your project's purpose, technical stack, folder structure, customizations, and libraries.

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
   - Centralized documentation and examples

2. **Rule Filtering System**:
   - Built-in file extension and path filtering prevents irrelevant rule application
   - Rules for specific languages/frameworks won't be triggered for unrelated files
   - Metadata tagging allows for logical organization without physical separation

3. **Holistic Development Experience**:
   - Comprehensive coverage across different aspects of development
   - Consistent enforcement of standards across technologies
   - Simplified onboarding for new team members

### Recommendations for Users

1. **Selective Rule Usage**:
   - Disable rules not relevant to your specific technology stack
   - Configure rule priorities based on your project's needs
   - Consider creating custom installation scripts that only install relevant rules

2. **Performance Optimization**:
   - If experiencing slowdowns, review which rules are most frequently triggered
   - Consider disabling computationally expensive rules for very large files
   - Report performance issues so rule patterns can be optimized

3. **Custom Rule Development**:
   - When creating custom rules, follow the patterns established in existing rules
   - Use specific file filters to minimize unnecessary rule evaluation
   - Test new rules thoroughly in isolation before adding to the collection

### Future Scalability Plans

While maintaining all rules in a single repository currently provides the best developer experience, we're preparing for potential future growth:

1. **Enhanced Categorization**:
   - Rules include clear language/framework tagging with a structured hierarchical system (As seen in the OWASP Top Ten Rules):
     - `language:php` - Explicitly identifies the programming language
     - `framework:drupal` - Specifies the framework or CMS
     - `category:security` - Defines the primary functional category
     - `subcategory:injection` - Provides more granular categorization (e.g., injection, authentication)
     - `standard:owasp-top10` - Identifies the security standard being applied
     - `risk:a01-broken-access-control` - Specifies the exact risk identifier
   - This tagging system enables selective installation based on language, framework, or security concern
   - Installation scripts can target specific categories (e.g., only install PHP rules or only OWASP rules)

2. **Modular Design**:
   - Rule file structure supports potential future separation
   - Consistent naming conventions facilitate organization

3. **Monitoring and Feedback**:
   - Repository growth and performance impacts are monitored
   - User feedback helps identify optimization opportunities

If you encounter any issues with rule management or have suggestions for improving organization, please submit an issue or pull request.