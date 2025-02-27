#!/bin/bash

# Test script for invalid option handling

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

# Test the invalid option case
print_message "$BLUE" "\n=== Running Test: Invalid Option ==="
echo "Command: php install.php --invalid-option"

# Create a clean test directory
TEST_DIR="$TEMP_DIR/test_invalid_option"
rm -rf "$TEST_DIR"
mkdir -p "$TEST_DIR"

# Copy fresh installer to test directory
get_fresh_installer "$TEST_DIR/install.php"
if [ $? -ne 0 ]; then
  print_message "$RED" "Failed to copy installer. Skipping test."
  exit 1
fi

# Run the command with an invalid option
cd "$TEST_DIR"
php install.php --invalid-option > output.log 2>&1
EXIT_CODE=$?
cd "$BASE_DIR"

# Display output
print_message "$YELLOW" "Command output:"
cat "$TEST_DIR/output.log"
print_message "$YELLOW" "Exit code: $EXIT_CODE"

# Check exit code
if [ $EXIT_CODE -ne 1 ]; then
  print_message "$RED" "✗ Test failed: Expected exit code 1, got $EXIT_CODE"
  exit 1
else
  print_message "$GREEN" "✓ Test passed: Invalid Option"
  exit 0
fi 