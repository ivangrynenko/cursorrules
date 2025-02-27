#!/bin/bash

# Comprehensive diagnostic script for the test suite

set -e  # Exit on error

# Base directory
BASE_DIR=$(pwd)
TEMP_DIR="$BASE_DIR/temp"
INSTALLER_PATH="$BASE_DIR/../install.php"

echo "=== ENVIRONMENT ==="
echo "BASE_DIR: $BASE_DIR"
echo "TEMP_DIR: $TEMP_DIR"
echo "INSTALLER_PATH: $INSTALLER_PATH"

# Create temp directory if it doesn't exist
mkdir -p "$TEMP_DIR/test_debug"
echo "Created temp directory: $TEMP_DIR/test_debug"

# Check if installer exists
if [ ! -f "$INSTALLER_PATH" ]; then
  echo "ERROR: Installer not found at $INSTALLER_PATH!"
  exit 1
else
  echo "Installer found at $INSTALLER_PATH"
  ls -la "$INSTALLER_PATH"
fi

# Copy the installer
echo "Copying installer to $TEMP_DIR/test_debug/install.php..."
cp "$INSTALLER_PATH" "$TEMP_DIR/test_debug/install.php"
if [ $? -ne 0 ]; then
  echo "ERROR: Failed to copy installer!"
  exit 1
else
  echo "Successfully copied installer"
  ls -la "$TEMP_DIR/test_debug/install.php"
fi

echo "=== TESTING PHP EXECUTION ==="
# Change to the test directory
echo "Changing to test directory: $TEMP_DIR/test_debug"
cd "$TEMP_DIR/test_debug"

# Try to run PHP with the help option
echo "Running: php install.php --help"
php install.php --help > help_output.log 2>&1
HELP_EXIT_CODE=$?
echo "Help command exit code: $HELP_EXIT_CODE"
echo "Help command output:"
cat help_output.log

echo "=== TEST COMPLETED ==="
echo "All steps completed successfully"
exit 0 