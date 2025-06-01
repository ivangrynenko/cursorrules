#!/bin/bash

# Test ignore files installation option

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

# Function to print colored output
print_message() {
  local color=$1
  local message=$2
  echo -e "${color}${message}${NC}"
}

# Function to copy a fresh installer to the target path
get_fresh_installer() {
  local target_path=${1:-"$INSTALLER_PATH"}
  
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

# Function to validate ignore files installation
validate_ignore_files() {
  local test_dir=$1
  local missing_files=0
  local missing_file_list=()
  
  # Check for .cursorignore
  if [ ! -f "$test_dir/.cursorignore" ]; then
    missing_files=$((missing_files + 1))
    missing_file_list+=(".cursorignore")
  fi
  
  # Check for .cursorindexingignore
  if [ ! -f "$test_dir/.cursorindexingignore" ]; then
    missing_files=$((missing_files + 1))
    missing_file_list+=(".cursorindexingignore")
  fi
  
  if [ $missing_files -gt 0 ]; then
    echo "Missing ignore files: $missing_files"
    for file in "${missing_file_list[@]}"; do
      echo "  - $file"
    done
    return 1
  fi
  
  return 0
}

# Test function
test_ignore_files_option() {
  print_message "$BLUE" "\n=== Testing Ignore Files Option ==="
  
  # Test 1: --ignore-files=yes option with core installation
  print_message "$BLUE" "Testing: php install.php --core --ignore-files=yes --yes"
  local test_dir="$TEMP_DIR/test_ignore_files"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer. Exiting."
    return 1
  fi
  
  cd "$test_dir"
  php install.php --core --ignore-files=yes --yes > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "✗ Installation with --ignore-files=yes failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    return 1
  fi
  
  # Validate ignore files were installed
  print_message "$BLUE" "Validating ignore files installation..."
  validation_output=$(validate_ignore_files "$test_dir" 2>&1)
  validation_result=$?
  
  if [ $validation_result -ne 0 ]; then
    print_message "$RED" "✗ Ignore files validation failed:"
    print_message "$YELLOW" "$validation_output"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    return 1
  else
    print_message "$GREEN" "✓ All ignore files are present"
  fi
  
  # Check that files have content
  if [ ! -s "$test_dir/.cursorignore" ]; then
    print_message "$RED" "✗ .cursorignore file is empty"
    return 1
  fi
  
  if [ ! -s "$test_dir/.cursorindexingignore" ]; then
    print_message "$RED" "✗ .cursorindexingignore file is empty"
    return 1
  fi
  
  print_message "$GREEN" "✓ Ignore files have content"
  
  # Test 2: Installation with --ignore-files=no should not install ignore files
  print_message "$BLUE" "Testing: php install.php --core --ignore-files=no --yes"
  local test_dir_no_ignore="$TEMP_DIR/test_no_ignore_files"
  rm -rf "$test_dir_no_ignore"
  mkdir -p "$test_dir_no_ignore"
  
  get_fresh_installer "$test_dir_no_ignore/install.php"
  cd "$test_dir_no_ignore"
  php install.php --core --ignore-files=no --yes > output.log 2>&1
  local exit_code_no_ignore=$?
  cd "$BASE_DIR"
  
  if [ $exit_code_no_ignore -ne 0 ]; then
    print_message "$RED" "✗ Installation with --ignore-files=no failed with exit code $exit_code_no_ignore"
    return 1
  fi
  
  # Validate ignore files were NOT installed
  if [ -f "$test_dir_no_ignore/.cursorignore" ]; then
    print_message "$RED" "✗ .cursorignore should not be installed with --ignore-files=no option"
    return 1
  fi
  
  if [ -f "$test_dir_no_ignore/.cursorindexingignore" ]; then
    print_message "$RED" "✗ .cursorindexingignore should not be installed with --ignore-files=no option"
    return 1
  fi
  
  print_message "$GREEN" "✓ Ignore files correctly not installed with --ignore-files=no option"
  
  # Test 3: Default behavior (--ignore-files=yes is default)
  print_message "$BLUE" "Testing: php install.php --core --yes (default should install ignore files)"
  local test_dir_default="$TEMP_DIR/test_ignore_files_default"
  rm -rf "$test_dir_default"
  mkdir -p "$test_dir_default"
  
  get_fresh_installer "$test_dir_default/install.php"
  cd "$test_dir_default"
  php install.php --core --yes > output.log 2>&1
  local exit_code_default=$?
  cd "$BASE_DIR"
  
  if [ $exit_code_default -ne 0 ]; then
    print_message "$RED" "✗ Installation with default settings failed with exit code $exit_code_default"
    return 1
  fi
  
  # Validate ignore files were installed by default
  validation_output_default=$(validate_ignore_files "$test_dir_default" 2>&1)
  validation_result_default=$?
  
  if [ $validation_result_default -ne 0 ]; then
    print_message "$RED" "✗ Ignore files should be installed by default:"
    print_message "$YELLOW" "$validation_output_default"
    return 1
  else
    print_message "$GREEN" "✓ Ignore files correctly installed by default"
  fi
  
  print_message "$GREEN" "✓ Ignore files option tests passed"
  return 0
}

# Run the test
print_message "$BLUE" "Running ignore files option test..."
test_ignore_files_option

if [ $? -eq 0 ]; then
  print_message "$GREEN" "Ignore files option test completed successfully!"
  exit 0
else
  print_message "$RED" "Ignore files option test failed!"
  exit 1
fi