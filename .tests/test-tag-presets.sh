#!/bin/bash

# Test for --tag-preset option functionality
# This test validates the tag preset functionality

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

# Test js-owasp preset
test_preset_js_owasp() {
  local test_name="Tag Preset js-owasp Test"
  local test_dir="$TEST_ROOT_DIR/test_preset_js_owasp"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with js-owasp preset
  cd "$test_dir"
  output=$(php install.php --tag-preset js-owasp 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "preset_js_owasp_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that JavaScript OWASP files were installed
  local js_owasp_files=0
  for file in "${JAVASCRIPT_FILES[@]}"; do
    # Count files that have OWASP-related names
    if [[ "$file" == *"broken-access-control"* ]] || [[ "$file" == *"injection"* ]] || [[ "$file" == *"cryptographic"* ]] || 
       [[ "$file" == *"insecure-design"* ]] || [[ "$file" == *"security-misconfiguration"* ]] || [[ "$file" == *"vulnerable"* ]] ||
       [[ "$file" == *"authentication-failures"* ]] || [[ "$file" == *"integrity-failures"* ]] || [[ "$file" == *"logging"* ]] ||
       [[ "$file" == *"ssrf"* ]]; then
      if [ -f "$test_dir/.cursor/rules/$file" ]; then
        ((js_owasp_files++))
      fi
    fi
  done
  
  if [ $js_owasp_files -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $js_owasp_files JavaScript OWASP files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no JavaScript OWASP files found"
    return 1
  fi
}

# Test security preset
test_preset_security() {
  local test_name="Tag Preset security Test"
  local test_dir="$TEST_ROOT_DIR/test_preset_security"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with security preset
  cd "$test_dir"
  output=$(php install.php --tag-preset security 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "preset_security_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that security files from multiple categories were installed
  local security_files=0
  
  # Check for security-related files in rules directory
  if [ -d "$test_dir/.cursor/rules" ]; then
    security_files=$(find "$test_dir/.cursor/rules" -name "*security*" -o -name "*injection*" -o -name "*crypto*" -o -name "*access*" -o -name "*auth*" -o -name "*vulnerable*" -o -name "*ssrf*" -o -name "*logging*" | wc -l)
  fi
  
  if [ $security_files -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $security_files security files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no security files found"
    return 1
  fi
}

# Test python-owasp preset
test_preset_python_owasp() {
  local test_name="Tag Preset python-owasp Test"
  local test_dir="$TEST_ROOT_DIR/test_preset_python_owasp"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with python-owasp preset
  cd "$test_dir"
  output=$(php install.php --tag-preset python-owasp 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "preset_python_owasp_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that Python OWASP files were installed
  local python_owasp_files=0
  for file in "${PYTHON_FILES[@]}"; do
    # Count files that have OWASP-related names
    if [[ "$file" == *"broken-access-control"* ]] || [[ "$file" == *"injection"* ]] || [[ "$file" == *"cryptographic"* ]] || 
       [[ "$file" == *"insecure-design"* ]] || [[ "$file" == *"security-misconfiguration"* ]] || [[ "$file" == *"vulnerable"* ]] ||
       [[ "$file" == *"authentication-failures"* ]] || [[ "$file" == *"integrity-failures"* ]] || [[ "$file" == *"logging"* ]] ||
       [[ "$file" == *"ssrf"* ]]; then
      if [ -f "$test_dir/.cursor/rules/$file" ]; then
        ((python_owasp_files++))
      fi
    fi
  done
  
  if [ $python_owasp_files -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $python_owasp_files Python OWASP files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no Python OWASP files found"
    return 1
  fi
}

# Test drupal preset
test_preset_drupal() {
  local test_name="Tag Preset drupal Test"
  local test_dir="$TEST_ROOT_DIR/test_preset_drupal"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with drupal preset
  cd "$test_dir"
  output=$(php install.php --tag-preset drupal 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "preset_drupal_test.log"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "❌ $test_name failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    echo "$output"
    return 1
  fi
  
  # Check that Drupal files were installed
  local drupal_files=0
  for file in "${DRUPAL_FILES[@]}"; do
    if [ -f "$test_dir/.cursor/rules/$file" ]; then
      ((drupal_files++))
    fi
  done
  
  if [ $drupal_files -gt 0 ]; then
    print_message "$GREEN" "✅ $test_name passed (found $drupal_files Drupal files)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - no Drupal files found"
    return 1
  fi
}

# Test invalid preset
test_preset_invalid() {
  local test_name="Tag Preset Invalid Test"
  local test_dir="$TEST_ROOT_DIR/test_preset_invalid"
  
  print_message "$BLUE" "🧪 Running: $test_name"
  
  # Create test directory
  mkdir -p "$test_dir"
  
  # Copy installer
  if ! copy_installer "$test_dir"; then
    return 1
  fi
  
  # Run installer with invalid preset
  cd "$test_dir"
  output=$(php install.php --tag-preset invalid-preset 2>&1)
  exit_code=$?
  
  # Save output to log
  echo "$output" > "preset_invalid_test.log"
  
  # This should fail gracefully
  if [ $exit_code -eq 1 ]; then
    print_message "$GREEN" "✅ $test_name passed (failed gracefully for invalid preset)"
    return 0
  else
    print_message "$RED" "❌ $test_name failed - expected exit code 1, got $exit_code"
    return 1
  fi
}

# Main test execution
main() {
  print_message "$BLUE" "🚀 Starting Tag Preset Tests"
  
  # Cleanup any previous test directories
  rm -rf "$TEST_ROOT_DIR"
  
  local total_tests=0
  local passed_tests=0
  
  # Test js-owasp preset
  ((total_tests++))
  if test_preset_js_owasp; then
    ((passed_tests++))
  fi
  
  # Test security preset
  ((total_tests++))
  if test_preset_security; then
    ((passed_tests++))
  fi
  
  # Test python-owasp preset
  ((total_tests++))
  if test_preset_python_owasp; then
    ((passed_tests++))
  fi
  
  # Test drupal preset
  ((total_tests++))
  if test_preset_drupal; then
    ((passed_tests++))
  fi
  
  # Test invalid preset
  ((total_tests++))
  if test_preset_invalid; then
    ((passed_tests++))
  fi
  
  # Summary
  print_message "$BLUE" "📊 Tag Preset Test Results: $passed_tests/$total_tests tests passed"
  
  if [ $passed_tests -eq $total_tests ]; then
    print_message "$GREEN" "🎉 All tag preset tests passed!"
    return 0
  else
    print_message "$RED" "❌ Some tag preset tests failed"
    return 1
  fi
}

# Run tests
main "$@"