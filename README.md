# Cursor AI Project Rules for Web Development

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

---

## 🔧 Installation

You can install these rules using one of the following methods:

### Option 1: Quick Install (Recommended)

Run this command in your project root:

```sh
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php
```

This will:
1. Download and run the installer
2. Create the `.cursor/rules` directory if it doesn't exist
3. Install all Cursor rules
4. Remove the installer script automatically

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
```

After installation, the rules will automatically be used by Cursor AI in your workflow.

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