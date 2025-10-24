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
TEMP_DIR="$BASE_DIR/temp"
INSTALLER_PATH="$BASE_DIR/../install.php"

# Import file maps
source "$BASE_DIR/file-maps.sh"

# Create temp directory if it doesn't exist
mkdir -p "$TEMP_DIR"

# Function to print colored output
print_message() {
  local color=$1
  local message=$2
  echo -e "${color}${message}${NC}"
}

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
  
  # Copy a fresh installer for this test
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "✗ Test failed: Could not copy installer"
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Run the command
  cd "$test_dir"
  local command_source="$BASE_DIR/../.cursor/commands"
  if [ -d "$command_source" ]; then
    env CURSOR_COMMAND_SOURCE="$command_source" CURSOR_COMMANDS_SOURCE="$command_source" bash -c "$command" > output.log 2>&1
  else
    bash -c "$command" > output.log 2>&1
  fi
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

# Test 1: Web Stack Installation
run_test "Web Stack Installation" "php install.php --web-stack --yes" "validate_web_stack"

# Test 2: Python Installation
run_test "Python Installation" "php install.php --python --yes" "validate_python"

# Test 3: All Rules Installation
run_test "All Rules Installation" "php install.php --all --yes" "validate_all"

# Test 4: Core Rules Installation
run_test "Core Rules Installation" "php install.php --core --yes" "validate_core"

# Test 5: Skip Commands Option
run_test "Skip Commands Option" "php install.php --core --yes --commands=skip" "validate_core_without_commands"

# Test 6: Commands Home Option
run_test "Commands Home Option" 'HOME="$(pwd)/home" php install.php --core --yes --commands=home' "validate_core_home_commands"

# Test 7: Commands Both Option
run_test "Commands Both Option" 'HOME="$(pwd)/home" php install.php --core --yes --commands=both' "validate_core_both_commands"

# Test 8: Interactive Skip Commands
run_test "Interactive Skip Commands" 'CURSOR_INSTALLER_INPUT="1,n" php install.php' "validate_core_without_commands"

# Test 9: Help Information
run_test "Help Information" "php install.php --help" "" 0

# Test 10: Web Stack with Short Option
run_test "Web Stack with Short Option" "php install.php -w -y" "validate_web_stack"

# Test 11: Python with Short Option
run_test "Python with Short Option" "php install.php -p -y" "validate_python"

# Test 12: Invalid Option
print_message "$BLUE" "\n=== Running Test: Invalid Option ==="
echo "Command: php install.php --invalid-option"

# Create a clean test directory
TEST_DIR="$TEMP_DIR/test_invalid_option"
rm -rf "$TEST_DIR"
mkdir -p "$TEST_DIR"

# Copy a fresh installer for this test
get_fresh_installer "$TEST_DIR/install.php"
if [ $? -ne 0 ]; then
  print_message "$RED" "✗ Test failed: Could not copy installer"
  TESTS_FAILED=$((TESTS_FAILED + 1))
else
  # Run the command
  cd "$TEST_DIR"
  set +e
  php install.php --invalid-option > output.log 2>&1
  EXIT_CODE=$?
  set -e
  cd "$BASE_DIR"

  # Display output
  print_message "$YELLOW" "Command output:"
  cat "$TEST_DIR/output.log"
  print_message "$YELLOW" "Exit code: $EXIT_CODE"

  # Check exit code
  if [ $EXIT_CODE -ne 1 ]; then
    print_message "$RED" "✗ Test failed: Expected exit code 1, got $EXIT_CODE"
    TESTS_FAILED=$((TESTS_FAILED + 1))
  else
    print_message "$GREEN" "✓ Test passed: Invalid Option"
    TESTS_PASSED=$((TESTS_PASSED + 1))
  fi
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
fi

# Test 13: Conflicting Options
print_message "$BLUE" "\n=== Running Test: Conflicting Options ==="
echo "Command: php install.php --web-stack --python"

# Create a clean test directory
TEST_DIR="$TEMP_DIR/test_conflicting_options"
rm -rf "$TEST_DIR"
mkdir -p "$TEST_DIR"

# Copy a fresh installer for this test
get_fresh_installer "$TEST_DIR/install.php"
if [ $? -ne 0 ]; then
  print_message "$RED" "✗ Test failed: Could not copy installer"
  TESTS_FAILED=$((TESTS_FAILED + 1))
else
  # Run the command
  cd "$TEST_DIR"
  set +e
  php install.php --web-stack --python > output.log 2>&1
  EXIT_CODE=$?
  set -e
  cd "$BASE_DIR"

  # Display output
  print_message "$YELLOW" "Command output:"
  cat "$TEST_DIR/output.log"
  print_message "$YELLOW" "Exit code: $EXIT_CODE"

  # Check exit code
  if [ $EXIT_CODE -ne 1 ]; then
    print_message "$RED" "✗ Test failed: Expected exit code 1, got $EXIT_CODE"
    TESTS_FAILED=$((TESTS_FAILED + 1))
  else
    print_message "$GREEN" "✓ Test passed: Conflicting Options"
    TESTS_PASSED=$((TESTS_PASSED + 1))
  fi
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
fi

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
