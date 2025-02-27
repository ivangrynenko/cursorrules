#!/bin/bash

# Cursor Rules Installer Test Runner
# This script runs tests for the Cursor Rules installer

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Test counter
TESTS_TOTAL=0
TESTS_PASSED=0
TESTS_FAILED=0

# Base directory
BASE_DIR=$(pwd)
TEMP_DIR="$BASE_DIR/.tests/temp"
INSTALLER_PATH="$BASE_DIR/install.php"

# Create temp directory if it doesn't exist
mkdir -p "$TEMP_DIR"

# Function to print colored output
print_message() {
  local color=$1
  local message=$2
  echo -e "${color}${message}${NC}"
}

# Function to run a test
run_test() {
  local test_name=$1
  local command=$2
  local expected_files=$3
  local expected_exit_code=${4:-0}
  
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
  
  print_message "$BLUE" "\n=== Running Test: $test_name ==="
  echo "Command: $command"
  
  # Create a clean test directory
  local test_dir="$TEMP_DIR/test_$TESTS_TOTAL"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  cp "$INSTALLER_PATH" "$test_dir/"
  
  # Run the command
  cd "$test_dir"
  eval "$command" > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  # Check exit code
  if [ $exit_code -ne $expected_exit_code ]; then
    print_message "$RED" "✗ Test failed: Expected exit code $expected_exit_code, got $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Check for expected files if exit code is 0
  if [ $expected_exit_code -eq 0 ] && [ -n "$expected_files" ]; then
    local missing_files=0
    for file in $expected_files; do
      if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
        print_message "$RED" "✗ Expected file not found: .cursor/rules/$file"
        missing_files=$((missing_files + 1))
      fi
    done
    
    if [ $missing_files -gt 0 ]; then
      print_message "$RED" "✗ Test failed: $missing_files expected files not found"
      print_message "$YELLOW" "Command output:"
      cat "$test_dir/output.log"
      TESTS_FAILED=$((TESTS_FAILED + 1))
      return 1
    fi
  fi
  
  # Test passed
  print_message "$GREEN" "✓ Test passed: $test_name"
  TESTS_PASSED=$((TESTS_PASSED + 1))
  return 0
}

# Function to check if UPDATE.md was installed
check_update_md() {
  local test_dir=$1
  if [ ! -f "$test_dir/.cursor/UPDATE.md" ]; then
    print_message "$RED" "✗ UPDATE.md not found in .cursor directory"
    return 1
  fi
  return 0
}

# Test 1: Web Stack Installation
run_test "Web Stack Installation" "php install.php --web-stack --yes" "cursor-rules.mdc improve-cursorrules-efficiency.mdc git-commit-standards.mdc readme-maintenance-standards.mdc accessibility-standards.mdc api-standards.mdc build-optimization.mdc javascript-performance.mdc javascript-standards.mdc node-dependencies.mdc react-patterns.mdc tailwind-standards.mdc third-party-integration.mdc vue-best-practices.mdc security-practices.mdc php-drupal-best-practices.mdc drupal-database-standards.mdc govcms-saas.mdc"
check_update_md "$TEMP_DIR/test_$TESTS_TOTAL"

# Test 2: Python Installation
run_test "Python Installation" "php install.php --python --yes" "cursor-rules.mdc improve-cursorrules-efficiency.mdc git-commit-standards.mdc readme-maintenance-standards.mdc python-broken-access-control.mdc python-cryptographic-failures.mdc python-injection.mdc python-insecure-design.mdc python-security-misconfiguration.mdc python-vulnerable-outdated-components.mdc python-authentication-failures.mdc python-integrity-failures.mdc python-logging-monitoring-failures.mdc python-ssrf.mdc"
check_update_md "$TEMP_DIR/test_$TESTS_TOTAL"

# Test 3: All Rules Installation
run_test "All Rules Installation" "php install.php --all --yes" "cursor-rules.mdc improve-cursorrules-efficiency.mdc git-commit-standards.mdc readme-maintenance-standards.mdc"
check_update_md "$TEMP_DIR/test_$TESTS_TOTAL"

# Test 4: Core Rules Installation
run_test "Core Rules Installation" "php install.php --core --yes" "cursor-rules.mdc improve-cursorrules-efficiency.mdc git-commit-standards.mdc readme-maintenance-standards.mdc"
check_update_md "$TEMP_DIR/test_$TESTS_TOTAL"

# Test 5: Help Information
run_test "Help Information" "php install.php --help" "" 0

# Test 6: Web Stack with Short Option
run_test "Web Stack with Short Option" "php install.php -w -y" "cursor-rules.mdc improve-cursorrules-efficiency.mdc git-commit-standards.mdc readme-maintenance-standards.mdc accessibility-standards.mdc api-standards.mdc build-optimization.mdc javascript-performance.mdc javascript-standards.mdc node-dependencies.mdc react-patterns.mdc tailwind-standards.mdc third-party-integration.mdc vue-best-practices.mdc security-practices.mdc php-drupal-best-practices.mdc drupal-database-standards.mdc govcms-saas.mdc"
check_update_md "$TEMP_DIR/test_$TESTS_TOTAL"

# Test 7: Python with Short Option
run_test "Python with Short Option" "php install.php -p -y" "cursor-rules.mdc improve-cursorrules-efficiency.mdc git-commit-standards.mdc readme-maintenance-standards.mdc python-broken-access-control.mdc python-cryptographic-failures.mdc python-injection.mdc python-insecure-design.mdc python-security-misconfiguration.mdc python-vulnerable-outdated-components.mdc python-authentication-failures.mdc python-integrity-failures.mdc python-logging-monitoring-failures.mdc python-ssrf.mdc"
check_update_md "$TEMP_DIR/test_$TESTS_TOTAL"

# Test 8: Invalid Option
run_test "Invalid Option" "php install.php --invalid-option" "" 1

# Test 9: Conflicting Options
run_test "Conflicting Options" "php install.php --web-stack --python" "" 1

# Print summary
print_message "$BLUE" "\n=== Test Summary ==="
print_message "$BLUE" "Total tests: $TESTS_TOTAL"
print_message "$GREEN" "Passed: $TESTS_PASSED"
if [ $TESTS_FAILED -gt 0 ]; then
  print_message "$RED" "Failed: $TESTS_FAILED"
  exit 1
else
  print_message "$GREEN" "All tests passed!"
  exit 0
fi 