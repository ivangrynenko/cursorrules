#!/bin/bash

# Combined test script for Cursor Rules installer

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Base directory
BASE_DIR=$(pwd)
TEMP_DIR="$BASE_DIR/temp"
INSTALLER_PATH="$BASE_DIR/../install.php"

# Import file maps
source "$BASE_DIR/file-maps.sh"

# Function to copy a fresh installer to the target path
get_fresh_installer() {
  local target_path=${1:-"$INSTALLER_PATH"}
  print_message "$BLUE" "Copying installer to $target_path..."
  
  # Ensure the installer exists
  if [ ! -f "$INSTALLER_PATH" ]; then
    print_message "$RED" "Installer not found at $INSTALLER_PATH!"
    return 1
  fi
  
  # Create directory if it doesn't exist
  mkdir -p "$(dirname "$target_path")"
  
  # Copy the installer
  cp "$INSTALLER_PATH" "$target_path"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer!"
    return 1
  fi
  return 0
}

# Test counter
TESTS_TOTAL=0
TESTS_PASSED=0
TESTS_FAILED=0

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
  local validation_function=$3
  local expected_exit_code=${4:-0}
  
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
  
  print_message "$BLUE" "\n=== Running Test: $test_name ==="
  echo "Command: $command"
  
  # Create a clean test directory
  local test_dir="$TEMP_DIR/test_$TESTS_TOTAL"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  # Copy fresh installer to test directory
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer for test $test_name. Skipping."
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Run the command
  cd "$test_dir"
  bash -c "$command" > output.log 2>&1
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
  
  # Validate files if exit code is 0 and validation function is provided
  if [ $expected_exit_code -eq 0 ] && [ -n "$validation_function" ]; then
    print_message "$BLUE" "Validating installed files..."
    
    # Run the validation function
    validation_output=$($validation_function "$test_dir" 2>&1)
    validation_result=$?
    
    if [ $validation_result -ne 0 ]; then
      print_message "$RED" "✗ File validation failed:"
      print_message "$YELLOW" "$validation_output"
      print_message "$YELLOW" "Command output:"
      cat "$test_dir/output.log"
      TESTS_FAILED=$((TESTS_FAILED + 1))
      return 1
    else
      print_message "$GREEN" "✓ All expected files are present"
    fi
  fi
  
  # Test passed
  print_message "$GREEN" "✓ Test passed: $test_name"
  TESTS_PASSED=$((TESTS_PASSED + 1))
  return 0
}

# Run the installation tests
print_message "$BLUE" "Running installation tests..."

# Test 1: Web Stack Installation
run_test "Web Stack Installation" "php install.php --web-stack --yes" "validate_web_stack"

# Test 2: Python Installation
run_test "Python Installation" "php install.php --python --yes" "validate_python"

# Test 3: All Rules Installation
run_test "All Rules Installation" "php install.php --all --yes" "validate_all"

# Test 4: Core Rules Installation
run_test "Core Rules Installation" "php install.php --core --yes" "validate_core"

# Test 5: Help Information
run_test "Help Information" "php install.php --help" "" 0

# Test 6: Web Stack with Short Option
run_test "Web Stack with Short Option" "php install.php -w -y" "validate_web_stack"

# Test 7: Python with Short Option
run_test "Python with Short Option" "php install.php -p -y" "validate_python"

# Run the error handling tests
print_message "$BLUE" "Running error handling tests..."

# Run the individual test scripts
print_message "$BLUE" "Running invalid option test..."
./test-invalid-option.sh
if [ $? -eq 0 ]; then
  TESTS_PASSED=$((TESTS_PASSED + 1))
else
  TESTS_FAILED=$((TESTS_FAILED + 1))
fi
TESTS_TOTAL=$((TESTS_TOTAL + 1))

print_message "$BLUE" "Running conflicting options test..."
./test-conflicting-options.sh
if [ $? -eq 0 ]; then
  TESTS_PASSED=$((TESTS_PASSED + 1))
else
  TESTS_FAILED=$((TESTS_FAILED + 1))
fi
TESTS_TOTAL=$((TESTS_TOTAL + 1))

print_message "$BLUE" "Running missing file detection test..."
./test-missing-files.sh
if [ $? -eq 0 ]; then
  TESTS_PASSED=$((TESTS_PASSED + 1))
else
  TESTS_FAILED=$((TESTS_FAILED + 1))
fi
TESTS_TOTAL=$((TESTS_TOTAL + 1))

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