#!/bin/bash

# Simplified test script for invalid option handling

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Base directory
BASE_DIR=$(pwd)
TEMP_DIR="$BASE_DIR/.tests/temp"
INSTALLER_PATH="$BASE_DIR/install.php"

# Create temp directory if it doesn't exist
mkdir -p "$TEMP_DIR"

# Function to print colored output
print_message() {
  local color=$1
  local message=$2
  echo -e "${color}${message}${NC}"
}

# Test the invalid option case
print_message "$BLUE" "\n=== Running Test: Invalid Option ==="
echo "Command: php install.php --invalid-option"

# Create a clean test directory
TEST_DIR="$TEMP_DIR/test_invalid_option"
rm -rf "$TEST_DIR"
mkdir -p "$TEST_DIR"
cp "$INSTALLER_PATH" "$TEST_DIR/"

# Run the command
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
fi

# Test the conflicting options case
print_message "$BLUE" "\n=== Running Test: Conflicting Options ==="
echo "Command: php install.php --web-stack --python"

# Create a clean test directory
TEST_DIR="$TEMP_DIR/test_conflicting_options"
rm -rf "$TEST_DIR"
mkdir -p "$TEST_DIR"
cp "$INSTALLER_PATH" "$TEST_DIR/"

# Run the command
cd "$TEST_DIR"
php install.php --web-stack --python > output.log 2>&1
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
  print_message "$GREEN" "✓ Test passed: Conflicting Options"
fi

print_message "$GREEN" "\nAll tests passed!"
exit 0 