#!/bin/bash

# Test script for tag-based filtering functionality

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Base directory
BASE_DIR=$(dirname "$0")
TEMP_DIR="$BASE_DIR/temp"
INSTALLER_PATH="$BASE_DIR/../install.php"

# Import file maps
source "$BASE_DIR/file-maps.sh"

# Function to copy a fresh installer to the target path
get_fresh_installer() {
  local target_path=${1:-"$INSTALLER_PATH"}
  echo -e "${BLUE}Copying installer to $target_path...${NC}"
  
  # Ensure the installer exists
  if [ ! -f "$INSTALLER_PATH" ]; then
    echo -e "${RED}Installer not found at $INSTALLER_PATH!${NC}"
    return 1
  fi
  
  # Create directory if it doesn't exist
  mkdir -p "$(dirname "$target_path")"
  
  # Copy the installer
  cp "$INSTALLER_PATH" "$target_path"
  if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to copy installer!${NC}"
    return 1
  fi
  return 0
}

# Function to print colored output
print_message() {
  local color=$1
  local message=$2
  echo -e "${color}${message}${NC}"
}

# Test counter
TESTS_TOTAL=0
TESTS_PASSED=0
TESTS_FAILED=0

# Function to run a tag filtering test
run_tag_test() {
  local test_name="$1"
  local tag_expression="$2"
  local expected_pattern="$3"
  
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
  
  print_message "$BLUE" "\n=== Testing Tag Filter: $test_name ==="
  echo "Tag expression: $tag_expression"
  echo "Expected pattern: $expected_pattern"
  
  # Create a clean test directory
  local test_dir="$TEMP_DIR/tag_test_$TESTS_TOTAL"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  # Copy fresh installer to test directory
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer for test $test_name. Skipping."
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Run the tag filtering command
  cd "$test_dir"
  php install.php --tags "$tag_expression" --yes > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "✗ Test failed: Command exited with code $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Check if expected files exist based on pattern
  local validation_passed=true
  case "$expected_pattern" in
    "javascript_security")
      # Should have only JavaScript security rules + core
      for file in "${JAVASCRIPT_FILES[@]}"; do
        if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
          print_message "$RED" "Missing expected JavaScript file: $file"
          validation_passed=false
        fi
      done
      for file in "${CORE_FILES[@]}"; do
        if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
          print_message "$RED" "Missing expected core file: $file"
          validation_passed=false
        fi
      done
      ;;
    "python_security")
      # Should have only Python security rules + core
      for file in "${PYTHON_FILES[@]}"; do
        if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
          print_message "$RED" "Missing expected Python file: $file"
          validation_passed=false
        fi
      done
      for file in "${CORE_FILES[@]}"; do
        if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
          print_message "$RED" "Missing expected core file: $file"
          validation_passed=false
        fi
      done
      ;;
    "core_only")
      # Should have only core rules
      for file in "${CORE_FILES[@]}"; do
        if [ ! -f "$test_dir/.cursor/rules/$file" ]; then
          print_message "$RED" "Missing expected core file: $file"
          validation_passed=false
        fi
      done
      # Check that no other files exist
      rule_count=$(find "$test_dir/.cursor/rules" -name "*.mdc" | wc -l)
      expected_count=${#CORE_FILES[@]}
      if [ $rule_count -ne $expected_count ]; then
        print_message "$RED" "Expected $expected_count core files, found $rule_count"
        validation_passed=false
      fi
      ;;
  esac
  
  if [ "$validation_passed" = false ]; then
    print_message "$RED" "✗ File validation failed for $test_name"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Test passed
  print_message "$GREEN" "✓ Test passed: $test_name"
  TESTS_PASSED=$((TESTS_PASSED + 1))
  return 0
}

# Function to run tag preset tests
run_tag_preset_test() {
  local test_name="$1"
  local preset_name="$2"
  local expected_pattern="$3"
  
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
  
  print_message "$BLUE" "\n=== Testing Tag Preset: $test_name ==="
  echo "Preset: $preset_name"
  
  # Create a clean test directory
  local test_dir="$TEMP_DIR/preset_test_$TESTS_TOTAL"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  # Copy fresh installer to test directory
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer for test $test_name. Skipping."
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Run the tag preset command
  cd "$test_dir"
  php install.php --tag-preset "$preset_name" --yes > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "✗ Test failed: Command exited with code $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Basic validation - check that files were installed
  if [ ! -d "$test_dir/.cursor/rules" ]; then
    print_message "$RED" "✗ No rules directory created"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  rule_count=$(find "$test_dir/.cursor/rules" -name "*.mdc" | wc -l)
  if [ $rule_count -eq 0 ]; then
    print_message "$RED" "✗ No rules installed"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Test passed
  print_message "$GREEN" "✓ Test passed: $test_name ($rule_count rules installed)"
  TESTS_PASSED=$((TESTS_PASSED + 1))
  return 0
}

# Run tag filtering tests
print_message "$BLUE" "Running tag-based filtering tests..."

# Test JavaScript security rules filtering
run_tag_test "JavaScript Security Rules" "language:javascript AND category:security" "javascript_security"

# Test Python security rules filtering  
run_tag_test "Python Security Rules" "language:python AND category:security" "python_security"

# Test core rules only (should match git standards, etc.)
run_tag_test "Core Rules Only" "category:standards AND NOT category:security" "core_only"

# Run tag preset tests
print_message "$BLUE" "Running tag preset tests..."

# Test JavaScript security preset
run_tag_preset_test "JavaScript Security Preset" "js-security" "javascript_security"

# Test JavaScript OWASP preset
run_tag_preset_test "JavaScript OWASP Preset" "js-owasp" "javascript_security"

# Test Python security preset
run_tag_preset_test "Python Security Preset" "python-security" "python_security"

# Test Python OWASP preset
run_tag_preset_test "Python OWASP Preset" "python-owasp" "python_security"

# Test general security preset
run_tag_preset_test "General Security Preset" "security" "general_security"

# Test OWASP preset
run_tag_preset_test "OWASP Preset" "owasp" "owasp_rules"

# Print summary
print_message "$BLUE" "\n=== Tag Filtering Test Summary ==="
print_message "$BLUE" "Total tests: $TESTS_TOTAL"
print_message "$GREEN" "Passed: $TESTS_PASSED"
if [ $TESTS_FAILED -gt 0 ]; then
  print_message "$RED" "Failed: $TESTS_FAILED"
  exit 1
else
  print_message "$GREEN" "All tag filtering tests passed!"
  exit 0
fi