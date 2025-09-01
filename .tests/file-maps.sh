#!/bin/bash

# File maps for Cursor Rules installer tests
# This file defines the expected files for each installation option

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

# Function to validate files
validate_files() {
  local test_dir=$1
  local files=("${@:2}")
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