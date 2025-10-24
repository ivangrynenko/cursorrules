#!/bin/bash

# File maps for Cursor Rules installer tests
# This file defines the expected files for each installation option

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
COMMAND_SOURCE_DIR="$SCRIPT_DIR/../.cursor/commands"

COMMAND_FILES=()
if [ -d "$COMMAND_SOURCE_DIR" ]; then
  while IFS= read -r -d '' file; do
    rel_path="${file#./}"
    COMMAND_FILES+=("$rel_path")
  done < <(cd "$COMMAND_SOURCE_DIR" && find . -type f -print0)
fi

# Core rules
CORE_FILES=(
  "cursor-rules.mdc"
  "git-commit-standards.mdc"
  "github-actions-standards.mdc"
  "improve-cursorrules-efficiency.mdc"
  "pull-request-changelist-instructions.mdc"
  "readme-maintenance-standards.mdc"
  "testing-guidelines.mdc"
)

# Web rules
WEB_FILES=(
  "accessibility-standards.mdc"
  "api-standards.mdc"
  "behat-steps.mdc"
  "build-optimization.mdc"
  "code-generation-standards.mdc"
  "debugging-standards.mdc"
  "docker-compose-standards.mdc"
  "drupal-file-permissions.mdc"
  "generic_bash_style.mdc"
  "javascript-performance.mdc"
  "javascript-standards.mdc"
  "lagoon-docker-compose-standards.mdc"
  "lagoon-yml-standards.mdc"
  "multi-agent-coordination.mdc"
  "node-dependencies.mdc"
  "php-drupal-development-standards.mdc"
  "project-definition-template.mdc"
  "react-patterns.mdc"
  "secret-detection.mdc"
  "tailwind-standards.mdc"
  "tests-documentation-maintenance.mdc"
  "third-party-integration.mdc"
  "vortex-cicd-standards.mdc"
  "vortex-scaffold-standards.mdc"
  "vue-best-practices.mdc"
)

# Drupal rules
DRUPAL_FILES=(
  "drupal-authentication-failures.mdc"
  "drupal-broken-access-control.mdc"
  "drupal-cryptographic-failures.mdc"
  "drupal-database-standards.mdc"
  "drupal-injection.mdc"
  "drupal-insecure-design.mdc"
  "drupal-integrity-failures.mdc"
  "drupal-logging-failures.mdc"
  "drupal-security-misconfiguration.mdc"
  "drupal-ssrf.mdc"
  "drupal-vulnerable-components.mdc"
  "php-drupal-best-practices.mdc"
  "security-practices.mdc"
)

# Python rules
PYTHON_FILES=(
  "python-authentication-failures.mdc"
  "python-broken-access-control.mdc"
  "python-cryptographic-failures.mdc"
  "python-injection.mdc"
  "python-insecure-design.mdc"
  "python-integrity-failures.mdc"
  "python-logging-monitoring-failures.mdc"
  "python-security-misconfiguration.mdc"
  "python-ssrf.mdc"
  "python-vulnerable-outdated-components.mdc"
)

# JavaScript OWASP rules
JAVASCRIPT_FILES=(
  "javascript-broken-access-control.mdc"
  "javascript-cryptographic-failures.mdc"
  "javascript-injection.mdc"
  "javascript-insecure-design.mdc"
  "javascript-security-misconfiguration.mdc"
  "javascript-vulnerable-outdated-components.mdc"
  "javascript-identification-authentication-failures.mdc"
  "javascript-software-data-integrity-failures.mdc"
  "javascript-security-logging-monitoring-failures.mdc"
  "javascript-server-side-request-forgery.mdc"
)

# Function to validate rule files without checking commands
validate_rules_only() {
  local test_dir=$1
  shift
  local files=("$@")
  local missing_files=0
  local missing_file_list=()
  
  for file in "${files[@]}"; do
    if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
      missing_files=$((missing_files + 1))
      missing_file_list+=("$file")
    fi
  done
  
  # Check for UPDATE.md
  if [ ! -f "$test_dir/.cursor/UPDATE.md" ]; then
    missing_files=$((missing_files + 1))
    missing_file_list+=("UPDATE.md (in .cursor directory)")
  fi

  if [ $missing_files -gt 0 ]; then
    echo "Missing files: $missing_files"
    for file in "${missing_file_list[@]}"; do
      echo "  - $file"
    done
    return 1
  fi
  
  return 0
}

# Function to validate files including commands
validate_files() {
  local test_dir=$1
  shift
  local files=("$@")

  if ! validate_rules_only "$test_dir" "${files[@]}"; then
    return 1
  fi

  if ! validate_commands_dir "$test_dir/.cursor/commands"; then
    return 1
  fi

  return 0
}

validate_commands_dir() {
  local commands_dir=$1
  local missing=0
  local missing_list=()

  if [ ${#COMMAND_FILES[@]} -eq 0 ]; then
    echo "Warning: COMMAND_FILES list is empty; skipping command validation"
    return 0
  fi

  if [ ! -d "$commands_dir" ]; then
    echo "Commands directory not found: $commands_dir"
    return 1
  fi

  for command_file in "${COMMAND_FILES[@]}"; do
    if [ ! -f "$commands_dir/$command_file" ]; then
      missing=$((missing + 1))
      missing_list+=("$command_file")
    fi
  done

  if [ $missing -gt 0 ]; then
    echo "Missing command files: $missing"
    for file in "${missing_list[@]}"; do
      echo "  - $file"
    done
    return 1
  fi

  return 0
}

validate_home_commands_dir() {
  local home_dir=$1
  validate_commands_dir "$home_dir/.cursor/commands"
}

validate_no_project_commands() {
  local test_dir=$1
  if [ -d "$test_dir/.cursor/commands" ]; then
    echo "Commands directory should not have been created"
    return 1
  fi
  return 0
}

validate_core_without_commands() {
  local test_dir=$1
  if ! validate_rules_only "$test_dir" "${CORE_FILES[@]}"; then
    return 1
  fi
  if ! validate_no_project_commands "$test_dir"; then
    return 1
  fi
  return 0
}

validate_core_home_commands() {
  local test_dir=$1
  local home_dir=${COMMANDS_HOME_DIR:-"$test_dir/home"}
  if ! validate_rules_only "$test_dir" "${CORE_FILES[@]}"; then
    return 1
  fi
  if [ -z "$home_dir" ]; then
    echo "Home directory for commands not provided"
    return 1
  fi
  if ! validate_home_commands_dir "$home_dir"; then
    return 1
  fi
  if [ -d "$test_dir/.cursor/commands" ]; then
    echo "Project commands should not be installed when targeting home"
    return 1
  fi
  return 0
}

validate_core_both_commands() {
  local test_dir=$1
  local home_dir=${COMMANDS_HOME_DIR:-"$test_dir/home"}
  if ! validate_rules_only "$test_dir" "${CORE_FILES[@]}"; then
    return 1
  fi
  if ! validate_commands_dir "$test_dir/.cursor/commands"; then
    return 1
  fi
  if ! validate_home_commands_dir "$home_dir"; then
    return 1
  fi
  return 0
}

# Function to validate web stack installation
validate_web_stack() {
  local test_dir=$1
  local all_files=("${CORE_FILES[@]}" "${WEB_FILES[@]}" "${DRUPAL_FILES[@]}" "${JAVASCRIPT_FILES[@]}")
  validate_files "$test_dir" "${all_files[@]}"
}

# Function to validate Python installation
validate_python() {
  local test_dir=$1
  local all_files=("${CORE_FILES[@]}" "${PYTHON_FILES[@]}")
  validate_files "$test_dir" "${all_files[@]}"
}

# Function to validate all rules installation
validate_all() {
  local test_dir=$1
  local all_files=("${CORE_FILES[@]}" "${WEB_FILES[@]}" "${DRUPAL_FILES[@]}" "${PYTHON_FILES[@]}" "${JAVASCRIPT_FILES[@]}")
  validate_files "$test_dir" "${all_files[@]}"
}

# Function to validate JavaScript rules installation
validate_javascript() {
  local test_dir=$1
  local all_files=("${CORE_FILES[@]}" "${JAVASCRIPT_FILES[@]}")
  validate_files "$test_dir" "${all_files[@]}"
}

# Function to validate core rules installation
validate_core() {
  local test_dir=$1
  validate_files "$test_dir" "${CORE_FILES[@]}"
}

# Function to validate JavaScript security files only (without core)
validate_javascript_security_only() {
  local test_dir=$1
  validate_files "$test_dir" "${JAVASCRIPT_FILES[@]}"
}

# Function to validate ignore files
validate_ignore_files() {
  local test_dir=$1
  local missing_files=0
  local missing_file_list=()
  
  # Check for .cursorignore
  if [ ! -f "$test_dir/.cursorignore" ]; then
    missing_files=$((missing_files + 1))
    missing_file_list+=(".cursorignore")
  fi
  
  # Check for .cursorindexingignore
  if [ ! -f "$test_dir/.cursorindexingignore" ]; then
    missing_files=$((missing_files + 1))
    missing_file_list+=(".cursorindexingignore")
  fi
  
  if [ $missing_files -gt 0 ]; then
    echo "Missing ignore files: $missing_files"
    for file in "${missing_file_list[@]}"; do
      echo "  - $file"
    done
    return 1
  fi
  
  return 0
} 
