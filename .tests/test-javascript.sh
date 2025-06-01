#!/bin/bash

# Test for --javascript option
# This test validates the JavaScript installation functionality

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Define paths
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
INSTALLER_PATH="$SCRIPT_DIR/../install.php"
TEST_ROOT_DIR="$SCRIPT_DIR/tmp"

# Source file maps
source "$SCRIPT_DIR/file-maps.sh"

# Function to print colored messages
print_message() {
  local color=$1
  local message=$2
  echo -e "${color}${message}${NC}"
}

# Function to copy installer to test directory
copy_installer() {
  local test_dir=$1
  cp "$INSTALLER_PATH" "$test_dir/"
  if [ $? -ne 0 ]; then
    print_message "$RED" "❌ Failed to copy installer to $test_dir"
    return 1
  fi
  return 0
}

# Test JavaScript installation
test_javascript_installation() {
  local test_name="JavaScript Installation Test"
  local test_dir="$TEST_ROOT_DIR/test_javascript"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with --javascript option
  cd "$test_dir"
  output=$(php install.php --javascript 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "javascript_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Validate installed files
  if validate_javascript "$test_dir"; then
    print_message "$GREEN" "✅ $test_name passed"
    return 0
  else
    print_message "$RED" "❌ $test_name failed validation"
    return 1
  fi
}

# Test JavaScript short option (-j)
test_javascript_short_option() {
  local test_name="JavaScript Short Option Test (-j)"
  local test_dir="$TEST_ROOT_DIR/test_javascript_short"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with -j option
  cd "$test_dir"
  output=$(php install.php -j 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "javascript_short_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Validate installed files
  if validate_javascript "$test_dir"; then
    print_message "$GREEN" "✅ $test_name passed"
    return 0
  else
    print_message "$RED" "❌ $test_name failed validation"
    return 1
  fi
}

# Main test execution
main() {
  print_message "$BLUE" "🚀 Starting JavaScript Installation Tests"
  
  # Cleanup any previous test directories
  rm -rf "$TEST_ROOT_DIR"
  
  local total_tests=0
  local passed_tests=0
  
  # Test JavaScript installation
  ((total_tests++))
  if test_javascript_installation; then
    ((passed_tests++))
  fi
  
  # Test JavaScript short option
  ((total_tests++))
  if test_javascript_short_option; then
    ((passed_tests++))
  fi
  
  # Summary
  print_message "$BLUE" "📊 JavaScript Test Results: $passed_tests/$total_tests tests passed"
  
  if [ $passed_tests -eq $total_tests ]; then
    print_message "$GREEN" "🎉 All JavaScript tests passed!"
    return 0
  else
    print_message "$RED" "❌ Some JavaScript tests failed"
    return 1
  fi
}

# Run tests
main "$@"