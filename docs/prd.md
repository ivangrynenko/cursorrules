# Product Requirements Document: Cursor Rules Installer

## 1. Elevator Pitch
A PHP-based installation tool that enables developers to easily install cursor rules into their projects with a single curl command. The tool offers both interactive and non-interactive options for selecting rule sets (WebStack, Core, Python, or All), supporting keyboard navigation for a seamless user experience.

## 2. Who is this app for?
This tool is designed for developers who work with cursor AI software and need to efficiently install cursor rules into their projects. It streamlines the process of integrating these rules, reducing setup time and ensuring consistency across multiple projects.

## 3. Functional Requirements
- **Installation Method**: Simple curl command that can be executed via PHP
- **Rule Sets Support**:
  - WebStack rules
  - Core rules
  - Python rules
  - All rules option
- **Installation Logic**:
  - Core rules should be installed when either Python or WebStack are selected
  - Support for installing all rules at once
- **Interactive Mode**:
  - Selection via keyboard up/down arrow navigation
  - Visual prompts for selection options
- **Non-Interactive Mode**:
  - Command-line parameters for automated installation
  - Support for all rule set options
- **Technical Specifications**:
  - PHP 8.3 compatibility
  - Local testing capability (installing to temporary folder)
  - GitHub Actions integration for CI/CD testing
  - Testing coverage for all options, including invalid inputs

## 4. User Stories
1. **Basic Installation**
   - As a developer, I want to copy a single curl command from the GitHub repository and execute it to install cursor rules into my project.

2. **Interactive Rule Selection**
   - As a developer, I want to interactively select which rule sets to install using keyboard navigation so that I can easily choose the appropriate rules for my project.

3. **Automated Installation**
   - As a developer, I want to specify rule sets via command-line parameters so that I can automate the installation process in scripts or CI/CD pipelines.

4. **Core Rule Integration**
   - As a developer, I want Core rules to be automatically included when I select either WebStack or Python rules so that I have the necessary foundational rules.

5. **Complete Rules Installation**
   - As a developer, I want to easily install all available rules with a single option so that I can quickly set up a comprehensive rule set.

## 5. User Interface
As this is a command-line tool, the UI will consist of:

1. **Installation Command**
   - A simple, copy-pastable curl command visible in the GitHub repository README.

2. **Interactive Mode Interface**
   - Clear text prompts showing available options
   - Visual indicators for currently selected option
   - Up/down arrow navigation support
   - Confirmation messages after selection

3. **Command Execution Feedback**
   - Progress indicators during installation
   - Success/failure messages
   - Summary of installed rule sets
   - Use of common colours to indicate success, notification, warning and error type of messages.

4. **Help Information**
   - Documentation for command-line parameters
   - Examples of common usage patterns

## 6. Testing Requirements
- Local tests that install rules into a temporary folder
- Test coverage for all rule set combinations
- Test handling of invalid options
- GitHub Action for automated testing on push or pull request
- Validation of PHP 8.3 compatibility