#!/bin/bash

# Simple test script to diagnose copying issues

# Base directory
BASE_DIR=$(pwd)
TEMP_DIR="$BASE_DIR/temp"
INSTALLER_PATH="$BASE_DIR/../install.php"

echo "BASE_DIR: $BASE_DIR"
echo "TEMP_DIR: $TEMP_DIR"
echo "INSTALLER_PATH: $INSTALLER_PATH"

# Create temp directory if it doesn't exist
mkdir -p "$TEMP_DIR/test_copy"
echo "Created temp directory: $TEMP_DIR/test_copy"

# Check if installer exists
if [ ! -f "$INSTALLER_PATH" ]; then
  echo "ERROR: Installer not found at $INSTALLER_PATH!"
  exit 1
else
  echo "Installer found at $INSTALLER_PATH"
fi

# Copy the installer
echo "Copying installer to $TEMP_DIR/test_copy/install.php..."
cp "$INSTALLER_PATH" "$TEMP_DIR/test_copy/install.php"
if [ $? -ne 0 ]; then
  echo "ERROR: Failed to copy installer!"
  exit 1
else
  echo "Successfully copied installer"
fi

echo "Test completed successfully"
exit 0 