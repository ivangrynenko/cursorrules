# Cursor AI Project Rules for Modern Development

[![Cursor Rules Tests](https://github.com/ivangrynenko/cursor-rules/actions/workflows/test.yml/badge.svg)](https://github.com/ivangrynenko/cursor-rules/actions/workflows/test.yml)

## 📌 About This Repository
This repository contains a **comprehensive set of Cursor AI rules** designed to **enhance efficiency, enforce coding standards, and automate best practices** across **multiple programming languages and frameworks**, including **PHP/Drupal, JavaScript/React/Vue, Python, and DevOps technologies**, with a **strong focus on security** following **OWASP Top 10** guidelines.

These rules help **Cursor AI** assist developers by:
- Enforcing coding standards and best practices
- Ensuring tests and documentation remain up to date
- Detecting inefficiencies in AI query usage and improving response quality
- Providing automated suggestions for commit messages, dependencies, and performance optimisations

---

## 🚀 Who Is This For?
This repository is ideal for:
- **PHP & Drupal developers** following Drupal coding standards and security best practices
- **Frontend developers** working with JavaScript, React, Vue, Tailwind, and other modern frameworks
- **Python developers** building secure applications following OWASP guidelines
- **DevOps engineers** working with Docker, CI/CD, and deployment workflows
- **Security-conscious developers** implementing OWASP Top 10 protections
- **Software teams** looking for a structured, automated workflow with comprehensive rule sets
- **Open-source contributors** who want standardized development and security practices

---

## 📥 Installation

### Interactive Installation (Recommended)

For a fully interactive installation with prompts:

```bash
# Step 1: Download the installer
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php -o install.php

# Step 2: Run the installer interactively
php install.php
```

This two-step process ensures you get the interactive experience with:
- Prompts to choose which rule sets to install (Core, Web Stack, Python, or All)
- Option to remove the installer file after installation (defaults to yes)

### Quick Non-Interactive Installation

For a quick installation without prompts (installs core rules only):

```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php
```

or install rules by tag expression
```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --tags "language:javascript category:security"
```

⚠️ **Note**: When using the curl piping method above, interactive mode is **not possible** because STDIN is already being used for the script input. The installer will automatically default to installing core rules only.

### Installation with Specific Options

To install with specific options and bypass the interactive mode:

```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- [options]
```

For example, to install all rules:

```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --all
```

### Installation Options

The installer supports the following options:
- `--core`: Install core rules only
- `--web-stack` or `--ws`: Install web stack rules (includes core rules)
- `--python`: Install Python rules (includes core rules)
- `--all`: Install all rules
- `--yes` or `-y`: Automatically answer yes to all prompts
- `--destination=DIR`: Install to a custom directory (default: .cursor/rules)
- `--debug`: Enable detailed debug output for troubleshooting installation issues
- `--ignore-files <opt>`: Control installation of .cursorignore files (yes, no, ask), default's to yes
- `--help` or `-h`: Show help message

### .cursorignore Files

The installer can automatically add recommended `.cursorignore` and `.cursorindexingignore` files to your project. These files tell Cursor AI which files and directories to exclude from processing, which helps to:

- **Improve performance** by skipping large generated files, vendor directories, and node_modules
- **Reduce noise** in AI responses by focusing only on relevant project files
- **Prevent unnecessary context** from third-party code being included in AI prompts

The `.cursorignore` file ensures files are not indexed by Cursior and they are not read by Cursor or sent to the models for processing. This is a good setting for files that may contain secrets or other information you'd prefer to keep private. The `.cursorindexingignore` file is just for indexing and is there mainly for performance reasons.

By default, the installer will add these files (controlled by the `--ignore-files` option). You can:
- Set to `yes` (default): Always install ignore files
- Set to `no`: Never install ignore files
- Set to `ask`: Prompt during installation

If you need to modify the ignore patterns, you can edit the `.cursorignore` files manually after installation.

### Troubleshooting Installation

If you encounter issues during installation, try running the installer with the debug option:

```bash
php install.php --debug
```

This will provide detailed information about what the installer is doing, which can help identify the source of any problems.

Common issues:
- If only core rules are installed when selecting other options, make sure your internet connection is working properly as the installer needs to download additional rules from GitHub.
- If you're behind a corporate firewall or proxy, you may need to configure PHP to use your proxy settings.

### Examples

Install core rules only:
```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --core
```

Install web stack rules (includes core rules):
```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --web-stack
# Or using the shorter alias
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --ws
```

Install all rules:
```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --all
```

Install to a custom directory:
```bash
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --all --destination=my/custom/path
```

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

### Manual Installation

If you prefer to install manually:

1. Clone this repository:
   ```bash
   git clone https://github.com/ivangrynenko/cursor-rules.git
   ```

2. Copy the rules to your project:
   ```bash
   mkdir -p /path/to/your/project/.cursor/rules
   cp -r cursor-rules/.cursor/rules/* /path/to/your/project/.cursor/rules/
   ```

---

## 📜 Available Cursor Rules

Each rule is written in `.mdc` format and structured to enforce best practices in different aspects of development.

### Core Rules
| File Name | Purpose |
|-----------|---------|
| [`cursor-rules.mdc`](.cursor/rules/cursor-rules.mdc) | Defines standards for creating and organising Cursor rule files |
| [`git-commit-standards.mdc`](.cursor/rules/git-commit-standards.mdc) | Enforces structured Git commit messages with proper prefixes and formatting |
| [`github-actions-standards.mdc`](.cursor/rules/github-actions-standards.mdc) | Ensures GitHub Actions workflows follow best practices |
| [`improve-cursorrules-efficiency.mdc`](.cursor/rules/improve-cursorrules-efficiency.mdc) | Detects and optimises inefficient AI queries |
| [`pull-request-changelist-instructions.mdc`](.cursor/rules/pull-request-changelist-instructions.mdc) | Guidelines for creating consistent pull request changelists in markdown format with proper code block formatting |
| [`readme-maintenance-standards.mdc`](.cursor/rules/readme-maintenance-standards.mdc) | Ensures README documentation is comprehensive and up-to-date |
| [`testing-guidelines.mdc`](.cursor/rules/testing-guidelines.mdc) | Ensures proper testing practices and separation between test and production code |

### Web Development Rules

#### Frontend Development
| File Name | Purpose |
|-----------|---------|
| [`accessibility-standards.mdc`](.cursor/rules/accessibility-standards.mdc) | WCAG compliance and accessibility best practices |
| [`api-standards.mdc`](.cursor/rules/api-standards.mdc) | RESTful API design and documentation standards |
| [`build-optimization.mdc`](.cursor/rules/build-optimization.mdc) | Webpack/Vite configuration and build process optimisation |
| [`javascript-performance.mdc`](.cursor/rules/javascript-performance.mdc) | Best practices for optimising JavaScript performance |
| [`javascript-standards.mdc`](.cursor/rules/javascript-standards.mdc) | Standards for JavaScript development in Drupal |
| [`node-dependencies.mdc`](.cursor/rules/node-dependencies.mdc) | Node.js versioning and package management best practices |
| [`react-patterns.mdc`](.cursor/rules/react-patterns.mdc) | React component patterns and hooks usage guidelines |
| [`tailwind-standards.mdc`](.cursor/rules/tailwind-standards.mdc) | Tailwind CSS class organisation and best practices |
| [`vue-best-practices.mdc`](.cursor/rules/vue-best-practices.mdc) | Vue 3 and NuxtJS specific standards and optimisations |

#### Backend Development
| File Name | Purpose |
|-----------|---------|
| [`php-drupal-best-practices.mdc`](.cursor/rules/php-drupal-best-practices.mdc) | PHP & Drupal Development Standards and Best Practices |
| [`php-drupal-development-standards.mdc`](.cursor/rules/php-drupal-development-standards.mdc) | Standards for PHP and Drupal development |
| [`drupal-database-standards.mdc`](.cursor/rules/drupal-database-standards.mdc) | Database schema changes, migrations, and query optimisation |
| [`drupal-file-permissions.mdc`](.cursor/rules/drupal-file-permissions.mdc) | Drupal file permissions security standards |

#### Security Rules
| File Name | Purpose |
|-----------|---------|
| [`drupal-authentication-failures.mdc`](.cursor/rules/drupal-authentication-failures.mdc) | Prevents authentication failures in Drupal |
| [`drupal-broken-access-control.mdc`](.cursor/rules/drupal-broken-access-control.mdc) | Prevents broken access control vulnerabilities in Drupal |
| [`drupal-cryptographic-failures.mdc`](.cursor/rules/drupal-cryptographic-failures.mdc) | Prevents cryptographic failures in Drupal applications |
| [`drupal-injection.mdc`](.cursor/rules/drupal-injection.mdc) | Prevents injection vulnerabilities in Drupal |
| [`drupal-insecure-design.mdc`](.cursor/rules/drupal-insecure-design.mdc) | Prevents insecure design patterns in Drupal |
| [`drupal-integrity-failures.mdc`](.cursor/rules/drupal-integrity-failures.mdc) | Prevents integrity failures in Drupal |
| [`drupal-logging-failures.mdc`](.cursor/rules/drupal-logging-failures.mdc) | Prevents logging failures in Drupal |
| [`drupal-security-misconfiguration.mdc`](.cursor/rules/drupal-security-misconfiguration.mdc) | Prevents security misconfigurations in Drupal |
| [`drupal-ssrf.mdc`](.cursor/rules/drupal-ssrf.mdc) | Prevents Server-Side Request Forgery in Drupal |
| [`drupal-vulnerable-components.mdc`](.cursor/rules/drupal-vulnerable-components.mdc) | Identifies and prevents vulnerable components in Drupal |
| [`javascript-broken-access-control.mdc`](.cursor/rules/javascript-broken-access-control.mdc) | Prevents broken access control vulnerabilities in JavaScript applications |
| [`javascript-cryptographic-failures.mdc`](.cursor/rules/javascript-cryptographic-failures.mdc) | Prevents cryptographic failures in JavaScript applications |
| [`javascript-injection.mdc`](.cursor/rules/javascript-injection.mdc) | Prevents injection vulnerabilities in JavaScript applications |
| [`javascript-insecure-design.mdc`](.cursor/rules/javascript-insecure-design.mdc) | Prevents insecure design patterns in JavaScript applications |
| [`javascript-security-misconfiguration.mdc`](.cursor/rules/javascript-security-misconfiguration.mdc) | Prevents security misconfigurations in JavaScript applications |
| [`javascript-vulnerable-outdated-components.mdc`](.cursor/rules/javascript-vulnerable-outdated-components.mdc) | Identifies and prevents vulnerable components in JavaScript applications |
| [`javascript-identification-authentication-failures.mdc`](.cursor/rules/javascript-identification-authentication-failures.mdc) | Prevents authentication failures in JavaScript applications |
| [`javascript-software-data-integrity-failures.mdc`](.cursor/rules/javascript-software-data-integrity-failures.mdc) | Prevents software and data integrity failures in JavaScript applications |
| [`javascript-security-logging-monitoring-failures.mdc`](.cursor/rules/javascript-security-logging-monitoring-failures.mdc) | Prevents logging and monitoring failures in JavaScript applications |
| [`javascript-server-side-request-forgery.mdc`](.cursor/rules/javascript-server-side-request-forgery.mdc) | Prevents Server-Side Request Forgery in JavaScript applications |
| [`security-practices.mdc`](.cursor/rules/security-practices.mdc) | Security best practices for PHP, JavaScript, and Drupal |
| [`secret-detection.mdc`](.cursor/rules/secret-detection.mdc) | Detects and prevents secrets from being committed to code |

#### DevOps & Infrastructure
| File Name | Purpose |
|-----------|---------|
| [`docker-compose-standards.mdc`](.cursor/rules/docker-compose-standards.mdc) | Docker Compose standards |
| [`lagoon-docker-compose-standards.mdc`](.cursor/rules/lagoon-docker-compose-standards.mdc) | Standards for Lagoon Docker Compose configuration |
| [`lagoon-yml-standards.mdc`](.cursor/rules/lagoon-yml-standards.mdc) | Standards for Lagoon configuration files and deployment workflows |
| [`vortex-cicd-standards.mdc`](.cursor/rules/vortex-cicd-standards.mdc) | Standards for Vortex CI/CD and Renovate configuration |
| [`vortex-scaffold-standards.mdc`](.cursor/rules/vortex-scaffold-standards.mdc) | Standards for Vortex/DrevOps scaffold usage and best practices |

#### Development Process
| File Name | Purpose |
|-----------|---------|
| [`code-generation-standards.mdc`](.cursor/rules/code-generation-standards.mdc) | Standards for code generation and implementation |
| [`debugging-standards.mdc`](.cursor/rules/debugging-standards.mdc) | Standards for debugging and error handling |
| [`generic_bash_style.mdc`](.cursor/rules/generic_bash_style.mdc) | Enforce general Bash scripting standards with enhanced logging |
| [`multi-agent-coordination.mdc`](.cursor/rules/multi-agent-coordination.mdc) | Multi-agent coordination and workflow standards |
| [`project-definition-template.mdc`](.cursor/rules/project-definition-template.mdc) | Template for defining project context |
| [`tests-documentation-maintenance.mdc`](.cursor/rules/tests-documentation-maintenance.mdc) | Require tests for new functionality and enforce documentation updates |
| [`third-party-integration.mdc`](.cursor/rules/third-party-integration.mdc) | Standards for integrating external services |
| [`behat-steps.mdc`](.cursor/rules/behat-steps.mdc) | Documentation for available Behat testing steps in Drupal projects |
| [`behat-ai-guide.mdc`](.cursor/rules/behat-ai-guide.mdc) | AI assistant guide for writing Behat tests using drevops/behat-steps package |

### Python Rules
| File Name | Purpose |
|-----------|---------|
| [`python-authentication-failures.mdc`](.cursor/rules/python-authentication-failures.mdc) | Prevents authentication failures in Python |
| [`python-broken-access-control.mdc`](.cursor/rules/python-broken-access-control.mdc) | Prevents broken access control vulnerabilities in Python |
| [`python-cryptographic-failures.mdc`](.cursor/rules/python-cryptographic-failures.mdc) | Prevents cryptographic failures in Python applications |
| [`python-injection.mdc`](.cursor/rules/python-injection.mdc) | Prevents injection vulnerabilities in Python |
| [`python-insecure-design.mdc`](.cursor/rules/python-insecure-design.mdc) | Prevents insecure design patterns in Python |
| [`python-integrity-failures.mdc`](.cursor/rules/python-integrity-failures.mdc) | Prevents integrity failures in Python |
| [`python-logging-monitoring-failures.mdc`](.cursor/rules/python-logging-monitoring-failures.mdc) | Prevents logging and monitoring failures in Python |
| [`python-security-misconfiguration.mdc`](.cursor/rules/python-security-misconfiguration.mdc) | Prevents security misconfigurations in Python |
| [`python-ssrf.mdc`](.cursor/rules/python-ssrf.mdc) | Prevents Server-Side Request Forgery in Python |
| [`python-vulnerable-outdated-components.mdc`](.cursor/rules/python-vulnerable-outdated-components.mdc) | Identifies and prevents vulnerable components in Python |

---

## 🔧 Usage

### In Cursor AI

Once installed, Cursor AI will automatically use these rules when working with your codebase. The rules will:

1. **Provide Guidance**: Offer suggestions and best practices when writing code
2. **Enforce Standards**: Flag code that doesn't meet the defined standards
3. **Automate Repetitive Tasks**: Generate boilerplate code, documentation, and tests
4. **Improve Security**: Identify potential security vulnerabilities
5. **Optimise Performance**: Suggest performance improvements

### Rule Customisation

You can customise the rules by:

1. **Editing Rule Files**: Modify the `.mdc` files to match your project's specific requirements
2. **Adding New Rules**: Create new `.mdc` files following the same format
3. **Disabling Rules**: Remove or rename rule files you don't want to use

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'feat: add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Commit Message Standards

This project follows the [Conventional Commits](https://www.conventionalcommits.org/) specification. Commit messages should be structured as follows:

```
<type>: <description>

[optional body]

[optional footer(s)]
```

Types include:
- `fix`: for bug fixes
- `feat`: for new features
- `perf`: for performance improvements
- `docs`: for documentation updates
- `style`: for frontend changes (SCSS, Twig, etc.)
- `refactor`: for code refactoring
- `test`: for adding or updating tests
- `chore`: for maintenance tasks

Example: `feat: add support for Python security rules`

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgements

- [Cursor AI](https://cursor.sh/) for the amazing AI-powered code editor
- All contributors who have helped improve these rules

---

## 📊 Benefits of Using These Rules

### For Individual Developers

1. **Consistency**:
   - Maintain consistent coding style across projects
   - Reduce cognitive load when switching between tasks
   - Ensure best practices are followed even when under time pressure

2. **Efficiency**:
   - Automate repetitive coding tasks
   - Reduce time spent on boilerplate code
   - Get immediate feedback on code quality

3. **Learning**:
   - Learn best practices through contextual suggestions
   - Discover security vulnerabilities and how to fix them
   - Improve coding habits through consistent reinforcement

### For Teams

1. **Standardisation**:
   - Enforce team-wide coding standards
   - Reduce code review friction
   - Maintain consistent documentation

2. **Knowledge Sharing**:
   - Codify team knowledge in rules
   - Reduce onboarding time for new team members
   - Share best practices automatically

3. **Quality Assurance**:
   - Catch common issues before they reach code review
   - Ensure security best practices are followed
   - Maintain high code quality across the team

### For Organisations

1. **Governance**:
   - Enforce organisational standards
   - Ensure compliance with security requirements
   - Maintain consistent code quality across teams

2. **Efficiency**:
   - Reduce time spent on code reviews
   - Decrease technical debt accumulation
   - Streamline development processes

3. **Knowledge Management**:
   - Preserve institutional knowledge in rules
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