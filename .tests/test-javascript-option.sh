#!/bin/bash

# Test JavaScript rules installation option

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

# Test function
test_javascript_option() {
  print_message "$BLUE" "\n=== Testing JavaScript Option ==="
  
  # Create a clean test directory
  local test_dir="$TEMP_DIR/test_javascript"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  # Copy fresh installer to test directory
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer. Exiting."
    return 1
  fi
  
  # Test --javascript option
  print_message "$BLUE" "Testing: php install.php --javascript --yes"
  cd "$test_dir"
  php install.php --javascript --yes > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  # Check exit code
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "✗ JavaScript installation failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    return 1
  fi
  
  # Validate installed files
  print_message "$BLUE" "Validating JavaScript installation..."
  validation_output=$(validate_javascript "$test_dir" 2>&1)
  validation_result=$?
  
  if [ $validation_result -ne 0 ]; then
    print_message "$RED" "✗ JavaScript file validation failed:"
    print_message "$YELLOW" "$validation_output"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    return 1
  else
    print_message "$GREEN" "✓ All expected JavaScript files are present"
  fi
  
  # Test short option -j
  print_message "$BLUE" "Testing: php install.php -j -y"
  local test_dir_short="$TEMP_DIR/test_javascript_short"
  rm -rf "$test_dir_short"
  mkdir -p "$test_dir_short"
  
  get_fresh_installer "$test_dir_short/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer for short option test."
    return 1
  fi
  
  cd "$test_dir_short"
  php install.php -j -y > output.log 2>&1
  local exit_code_short=$?
  cd "$BASE_DIR"
  
  if [ $exit_code_short -ne 0 ]; then
    print_message "$RED" "✗ JavaScript installation with -j failed with exit code $exit_code_short"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir_short/output.log"
    return 1
  fi
  
  # Validate short option files
  validation_output_short=$(validate_javascript "$test_dir_short" 2>&1)
  validation_result_short=$?
  
  if [ $validation_result_short -ne 0 ]; then
    print_message "$RED" "✗ JavaScript file validation failed for -j option:"
    print_message "$YELLOW" "$validation_output_short"
    return 1
  else
    print_message "$GREEN" "✓ JavaScript short option (-j) works correctly"
  fi
  
  print_message "$GREEN" "✓ JavaScript option tests passed"
  return 0
}

# Run the test
print_message "$BLUE" "Running JavaScript option test..."
test_javascript_option

if [ $? -eq 0 ]; then
  print_message "$GREEN" "JavaScript option test completed successfully!"
  exit 0
else
  print_message "$RED" "JavaScript option test failed!"
  exit 1
fi