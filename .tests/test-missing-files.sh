#!/bin/bash

# Test script for file validation failure

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

# Import file maps
source "$BASE_DIR/file-maps.sh"

# Create a modified validation function that expects a non-existent file
validate_with_missing_file() {
  local test_dir=$1
  local all_files=("${CORE_FILES[@]}" "non-existent-file.mdc")
  validate_files "$test_dir" "${all_files[@]}"
}

# Test with missing file
print_message "$BLUE" "\n=== Running Test: Missing File Detection ==="
echo "Command: php install.php --core --yes"

# Create a clean test directory
TEST_DIR="$TEMP_DIR/test_missing_file"
rm -rf "$TEST_DIR"
mkdir -p "$TEST_DIR"

# Copy fresh installer to test directory
get_fresh_installer "$TEST_DIR/install.php"
if [ $? -ne 0 ]; then
  print_message "$RED" "Failed to copy installer. Skipping test."
  exit 1
fi

# Run the command
cd "$TEST_DIR"
php install.php --core --yes > output.log 2>&1
EXIT_CODE=$?
cd "$BASE_DIR"

# Check exit code
if [ $EXIT_CODE -ne 0 ]; then
  print_message "$RED" "✗ Installation failed with exit code $EXIT_CODE"
  print_message "$YELLOW" "Command output:"
  cat "$TEST_DIR/output.log"
  exit 1
fi

# Validate files - this should fail
print_message "$BLUE" "Validating installed files (expecting failure)..."
validation_output=$(validate_with_missing_file "$TEST_DIR" 2>&1)
validation_result=$?

if [ $validation_result -eq 0 ]; then
  print_message "$RED" "✗ Test failed: Validation should have failed but succeeded"
  exit 1
else
  print_message "$GREEN" "✓ Test passed: Validation correctly detected missing file"
  print_message "$YELLOW" "Validation output:"
  echo "$validation_output"
  exit 0
fi 