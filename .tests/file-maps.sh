#!/bin/bash

# File maps for Cursor Rules installer tests
# This file defines the expected files for each installation option

# Core rules
CORE_FILES=(
  "cursor-rules.mdc"
  "improve-cursorrules-efficiency.mdc"
  "git-commit-standards.mdc"
  "readme-maintenance-standards.mdc"
  "github-actions-standards.mdc"
  "testing-guidelines.mdc"
)

# Web rules
WEB_FILES=(
  "accessibility-standards.mdc"
  "api-standards.mdc"
  "build-optimization.mdc"
  "javascript-performance.mdc"
  "javascript-standards.mdc"
  "node-dependencies.mdc"
  "react-patterns.mdc"
  "tailwind-standards.mdc"
  "third-party-integration.mdc"
  "vue-best-practices.mdc"
)

# Drupal rules
DRUPAL_FILES=(
  "php-drupal-best-practices.mdc"
  "drupal-database-standards.mdc"
  "govcms-saas.mdc"
  "drupal-broken-access-control.mdc"
  "drupal-cryptographic-failures.mdc"
  "drupal-injection.mdc"
  "drupal-insecure-design.mdc"
  "drupal-security-misconfiguration.mdc"
  "drupal-vulnerable-components.mdc"
  "drupal-authentication-failures.mdc"
  "drupal-integrity-failures.mdc"
  "drupal-logging-failures.mdc"
  "drupal-ssrf.mdc"
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
  "security-practices.mdc"
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
  local all_files=("${CORE_FILES[@]}" "${WEB_FILES[@]}" "${DRUPAL_FILES[@]}")
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
  local all_files=("${CORE_FILES[@]}" "${WEB_FILES[@]}" "${DRUPAL_FILES[@]}" "${PYTHON_FILES[@]}")
  validate_files "$test_dir" "${all_files[@]}"
}

# Function to validate core rules installation
validate_core() {
  local test_dir=$1
  validate_files "$test_dir" "${CORE_FILES[@]}"
} 