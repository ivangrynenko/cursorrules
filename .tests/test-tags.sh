#!/bin/bash

# Test for --tags option functionality
# This test validates the tag-based filtering functionality

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

# Test tags with JavaScript language filter
test_tags_javascript_language() {
  local test_name="Tags JavaScript Language Filter Test"
  local test_dir="$TEST_ROOT_DIR/test_tags_js_lang"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with tags filter for JavaScript language
  cd "$test_dir"
  output=$(php install.php --tags "language:javascript" 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "tags_js_lang_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that some JavaScript files were installed
  local js_files_found=0
  for file in "${JAVASCRIPT_FILES[@]}"; do
    if [ -f "$test_dir/.cursor/rules/$file" ]; then
      ((js_files_found++))
    fi
  done
  
  if [ $js_files_found -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $js_files_found JavaScript files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no JavaScript files found"
    return 1
  fi
}

# Test tags with security category filter
test_tags_security_category() {
  local test_name="Tags Security Category Filter Test"
  local test_dir="$TEST_ROOT_DIR/test_tags_security"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with tags filter for security category
  cd "$test_dir"
  output=$(php install.php --tags "category:security" 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "tags_security_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that some security-related files were installed
  # Look for files with security keywords in their names
  local security_files_found=0
  if ls "$test_dir/.cursor/rules/"*security* 2>/dev/null; then
    security_files_found=$(ls "$test_dir/.cursor/rules/"*security* 2>/dev/null | wc -l)
  fi
  
  # Also check for OWASP-related files
  local owasp_files_found=0
  if ls "$test_dir/.cursor/rules/"*broken-access* "$test_dir/.cursor/rules/"*injection* "$test_dir/.cursor/rules/"*crypto* 2>/dev/null; then
    owasp_files_found=$(ls "$test_dir/.cursor/rules/"*broken-access* "$test_dir/.cursor/rules/"*injection* "$test_dir/.cursor/rules/"*crypto* 2>/dev/null | wc -l)
  fi
  
  local total_security_files=$((security_files_found + owasp_files_found))
  
  if [ $total_security_files -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $total_security_files security-related files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no security files found"
    return 1
  fi
}

# Test complex tag expression
test_tags_complex_expression() {
  local test_name="Tags Complex Expression Test"
  local test_dir="$TEST_ROOT_DIR/test_tags_complex"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with complex tag expression
  cd "$test_dir"
  output=$(php install.php --tags "language:javascript AND category:security" 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "tags_complex_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that JavaScript security files were installed
  local js_security_files=0
  for file in "${JAVASCRIPT_FILES[@]}"; do
    # Count files that have security-related names
    if [[ "$file" == *"security"* ]] || [[ "$file" == *"injection"* ]] || [[ "$file" == *"crypto"* ]] || [[ "$file" == *"access"* ]]; then
      if [ -f "$test_dir/.cursor/rules/$file" ]; then
        ((js_security_files++))
      fi
    fi
  done
  
  if [ $js_security_files -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $js_security_files JavaScript security files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no JavaScript security files found"
    return 1
  fi
}

# Test invalid tag expression
test_tags_invalid_expression() {
  local test_name="Tags Invalid Expression Test"
  local test_dir="$TEST_ROOT_DIR/test_tags_invalid"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with invalid tag expression
  cd "$test_dir"
  output=$(php install.php --tags "invalid:expression AND" 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "tags_invalid_test.log"
  
  # This should either succeed (installing matching files) or fail gracefully
  # We expect it to handle the invalid expression without crashing
  if [ $exit_code -eq 0 ] || [ $exit_code -eq 1 ]; then
    print_message "$GREEN" "✅ $test_name passed (handled invalid expression gracefully)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed with unexpected exit code $exit_code"
    return 1
  fi
}

# Main test execution
main() {
  print_message "$BLUE" "🚀 Starting Tags Functionality Tests"
  
  # Cleanup any previous test directories
  rm -rf "$TEST_ROOT_DIR"
  
  local total_tests=0
  local passed_tests=0
  
  # Test JavaScript language filter
  ((total_tests++))
  if test_tags_javascript_language; then
    ((passed_tests++))
  fi
  
  # Test security category filter
  ((total_tests++))
  if test_tags_security_category; then
    ((passed_tests++))
  fi
  
  # Test complex expression
  ((total_tests++))
  if test_tags_complex_expression; then
    ((passed_tests++))
  fi
  
  # Test invalid expression handling
  ((total_tests++))
  if test_tags_invalid_expression; then
    ((passed_tests++))
  fi
  
  # Summary
  print_message "$BLUE" "📊 Tags Test Results: $passed_tests/$total_tests tests passed"
  
  if [ $passed_tests -eq $total_tests ]; then
    print_message "$GREEN" "🎉 All tags tests passed!"
    return 0
  else
    print_message "$RED" "❌ Some tags tests failed"
    return 1
  fi
}

# Run tests
main "$@"