#!/bin/bash

# Test script for .cursorignore files installation functionality

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

# Function to run ignore files test
run_ignore_test() {
  local test_name="$1"
  local ignore_option="$2"
  local should_install_ignore_files="$3"
  
  TESTS_TOTAL=$((TESTS_TOTAL + 1))
  
  print_message "$BLUE" "\n=== Testing Ignore Files: $test_name ==="
  echo "Ignore option: $ignore_option"
  echo "Should install ignore files: $should_install_ignore_files"
  
  # Create a clean test directory
  local test_dir="$TEMP_DIR/ignore_test_$TESTS_TOTAL"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  # Copy fresh installer to test directory
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer for test $test_name. Skipping."
    TESTS_FAILED=$((TESTS_FAILED + 1))
    return 1
  fi
  
  # Build command
  local command="php install.php --core --yes"
  if [ "$ignore_option" != "default" ]; then
    command="$command --ignore-files=$ignore_option"
  fi
  
  # Run the command
  cd "$test_dir"
  bash -c "$command" > output.log 2>&1
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
  
  # Check if ignore files exist based on expectation
  local validation_passed=true
  
  if [ "$should_install_ignore_files" = "yes" ]; then
    # Should have .cursorignore and .cursorindexingignore files
    if [ ! -f "$test_dir/.cursorignore" ]; then
      print_message "$RED" "Missing expected .cursorignore file"
      validation_passed=false
    fi
    if [ ! -f "$test_dir/.cursorindexingignore" ]; then
      print_message "$RED" "Missing expected .cursorindexingignore file"
      validation_passed=false
    fi
    
    # Validate that files have content
    if [ -f "$test_dir/.cursorignore" ]; then
      ignore_size=$(wc -l < "$test_dir/.cursorignore")
      if [ $ignore_size -lt 10 ]; then
        print_message "$RED" ".cursorignore file seems too small ($ignore_size lines)"
        validation_passed=false
      fi
    fi
    
    if [ -f "$test_dir/.cursorindexingignore" ]; then
      indexing_ignore_size=$(wc -l < "$test_dir/.cursorindexingignore")
      if [ $indexing_ignore_size -lt 5 ]; then
        print_message "$RED" ".cursorindexingignore file seems too small ($indexing_ignore_size lines)"
        validation_passed=false
      fi
    fi
  elif [ "$should_install_ignore_files" = "no" ]; then
    # Should NOT have ignore files
    if [ -f "$test_dir/.cursorignore" ]; then
      print_message "$RED" "Unexpected .cursorignore file found"
      validation_passed=false
    fi
    if [ -f "$test_dir/.cursorindexingignore" ]; then
      print_message "$RED" "Unexpected .cursorindexingignore file found"
      validation_passed=false
    fi
  fi
  
  # Always check that rules were installed
  if [ ! -d "$test_dir/.cursor/rules" ]; then
    print_message "$RED" "Rules directory not created"
    validation_passed=false
  fi
  
  if [ "$validation_passed" = false ]; then
    print_message "$RED" "✗ Validation failed for $test_name"
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

# Run ignore files tests
print_message "$BLUE" "Running ignore files installation tests..."

# Test 1: Default behavior (should install ignore files)
run_ignore_test "Default Ignore Files Installation" "default" "yes"

# Test 2: Explicitly enable ignore files
run_ignore_test "Explicitly Enable Ignore Files" "yes" "yes"

# Test 3: Disable ignore files
run_ignore_test "Disable Ignore Files" "no" "no"

# Print summary
print_message "$BLUE" "\n=== Ignore Files Test Summary ==="
print_message "$BLUE" "Total tests: $TESTS_TOTAL"
print_message "$GREEN" "Passed: $TESTS_PASSED"
if [ $TESTS_FAILED -gt 0 ]; then
  print_message "$RED" "Failed: $TESTS_FAILED"
  exit 1
else
  print_message "$GREEN" "All ignore files tests passed!"
  exit 0
fi