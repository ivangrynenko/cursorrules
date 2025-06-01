#!/bin/bash

# Test for --ignore-files option functionality
# This test validates the ignore files installation functionality

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

# Test ignore files installation with core rules
test_ignore_files_with_core() {
  local test_name="Ignore Files with Core Rules Test"
  local test_dir="$TEST_ROOT_DIR/test_ignore_core"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with --ignore-files and --core
  cd "$test_dir"
  output=$(php install.php --ignore-files --core 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "ignore_files_core_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Validate core files
  if ! validate_core "$test_dir"; then
    print_message "$RED" "❌ $test_name failed core validation"
    return 1
  fi
  
  # Validate ignore files
  if validate_ignore_files "$test_dir"; then
    print_message "$GREEN" "✅ $test_name passed"
    return 0
  else
    print_message "$RED" "❌ $test_name failed ignore files validation"
    return 1
  fi
}

# Test ignore files installation with all rules
test_ignore_files_with_all() {
  local test_name="Ignore Files with All Rules Test"
  local test_dir="$TEST_ROOT_DIR/test_ignore_all"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with --ignore-files and --all
  cd "$test_dir"
  output=$(php install.php --ignore-files --all 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "ignore_files_all_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Validate all files
  if ! validate_all "$test_dir"; then
    print_message "$RED" "❌ $test_name failed all rules validation"
    return 1
  fi
  
  # Validate ignore files
  if validate_ignore_files "$test_dir"; then
    print_message "$GREEN" "✅ $test_name passed"
    return 0
  else
    print_message "$RED" "❌ $test_name failed ignore files validation"
    return 1
  fi
}

# Test ignore files only (without other rules)
test_ignore_files_only() {
  local test_name="Ignore Files Only Test"
  local test_dir="$TEST_ROOT_DIR/test_ignore_only"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with only --ignore-files
  cd "$test_dir"
  output=$(php install.php --ignore-files 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "ignore_files_only_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Validate ignore files
  if validate_ignore_files "$test_dir"; then
    print_message "$GREEN" "✅ $test_name passed"
    return 0
  else
    print_message "$RED" "❌ $test_name failed ignore files validation"
    return 1
  fi
}

# Test ignore files content
test_ignore_files_content() {
  local test_name="Ignore Files Content Test"
  local test_dir="$TEST_ROOT_DIR/test_ignore_content"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with --ignore-files
  cd "$test_dir"
  output=$(php install.php --ignore-files 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "ignore_files_content_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that ignore files have content
  if [ -s "$test_dir/.cursorignore" ] && [ -s "$test_dir/.cursorindexingignore" ]; then
    # Check for common ignore patterns
    if grep -q "node_modules" "$test_dir/.cursorignore" && grep -q "\.git" "$test_dir/.cursorignore"; then
      print_message "$GREEN" "✅ $test_name passed (ignore files have expected content)"
      return 0
    else
      print_message "$RED" "❌ $test_name failed - ignore files missing expected patterns"
      return 1
    fi
  else
    print_message "$RED" "❌ $test_name failed - ignore files are empty"
    return 1
  fi
}

# Test without ignore files (default behavior)
test_without_ignore_files() {
  local test_name="Without Ignore Files Test"
  local test_dir="$TEST_ROOT_DIR/test_no_ignore"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer without --ignore-files
  cd "$test_dir"
  output=$(php install.php --core 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "no_ignore_files_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Validate core files
  if ! validate_core "$test_dir"; then
    print_message "$RED" "❌ $test_name failed core validation"
    return 1
  fi
  
  # Check that ignore files were NOT installed
  if [ ! -f "$test_dir/.cursorignore" ] && [ ! -f "$test_dir/.cursorindexingignore" ]; then
    print_message "$GREEN" "✅ $test_name passed (ignore files not installed by default)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - ignore files were installed without --ignore-files"
    return 1
  fi
}

# Main test execution
main() {
  print_message "$BLUE" "🚀 Starting Ignore Files Tests"
  
  # Cleanup any previous test directories
  rm -rf "$TEST_ROOT_DIR"
  
  local total_tests=0
  local passed_tests=0
  
  # Test ignore files with core rules
  ((total_tests++))
  if test_ignore_files_with_core; then
    ((passed_tests++))
  fi
  
  # Test ignore files with all rules
  ((total_tests++))
  if test_ignore_files_with_all; then
    ((passed_tests++))
  fi
  
  # Test ignore files only
  ((total_tests++))
  if test_ignore_files_only; then
    ((passed_tests++))
  fi
  
  # Test ignore files content
  ((total_tests++))
  if test_ignore_files_content; then
    ((passed_tests++))
  fi
  
  # Test without ignore files
  ((total_tests++))
  if test_without_ignore_files; then
    ((passed_tests++))
  fi
  
  # Summary
  print_message "$BLUE" "📊 Ignore Files Test Results: $passed_tests/$total_tests tests passed"
  
  if [ $passed_tests -eq $total_tests ]; then
    print_message "$GREEN" "🎉 All ignore files tests passed!"
    return 0
  else
    print_message "$RED" "❌ Some ignore files tests failed"
    return 1
  fi
}

# Run tests
main "$@"