#!/bin/bash

# Test tag-based filtering and tag preset options

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

# Function to count files in .cursor/rules directory
count_installed_files() {
  local test_dir=$1
  if [ -d "$test_dir/.cursor/rules" ]; then
    find "$test_dir/.cursor/rules" -name "*.mdc" | wc -l
  else
    echo "0"
  fi
}

# Test function for tag expressions
test_tags_option() {
  print_message "$BLUE" "\n=== Testing Tags Option ==="
  
  # Test 1: JavaScript security rules using tags
  print_message "$BLUE" "Testing: --tags \"language:javascript category:security\""
  local test_dir="$TEMP_DIR/test_tags_js_security"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer. Exiting."
    return 1
  fi
  
  cd "$test_dir"
  php install.php --tags "language:javascript category:security" --yes > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "✗ Tag-based installation failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    return 1
  fi
  
  # Check that some JavaScript security files were installed
  local file_count=$(count_installed_files "$test_dir")
  if [ "$file_count" -lt 5 ]; then
    print_message "$RED" "✗ Expected more JavaScript security files, got $file_count"
    print_message "$YELLOW" "Files found:"
    find "$test_dir/.cursor/rules" -name "*.mdc" | head -10
    return 1
  fi
  
  print_message "$GREEN" "✓ Tag-based filtering installed $file_count JavaScript security files"
  
  # Test 2: Core category using tags
  print_message "$BLUE" "Testing: --tags \"category:core\""
  local test_dir_core="$TEMP_DIR/test_tags_core"
  rm -rf "$test_dir_core"
  mkdir -p "$test_dir_core"
  
  get_fresh_installer "$test_dir_core/install.php"
  cd "$test_dir_core"
  php install.php --tags "category:core" --yes > output.log 2>&1
  local exit_code_core=$?
  cd "$BASE_DIR"
  
  if [ $exit_code_core -ne 0 ]; then
    print_message "$RED" "✗ Core tag filtering failed with exit code $exit_code_core"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir_core/output.log"
    return 1
  fi
  
  local core_file_count=$(count_installed_files "$test_dir_core")
  if [ "$core_file_count" -lt 3 ]; then
    print_message "$RED" "✗ Expected more core files, got $core_file_count"
    return 1
  fi
  
  print_message "$GREEN" "✓ Core tag filtering installed $core_file_count files"
  
  print_message "$GREEN" "✓ Tags option tests passed"
  return 0
}

# Test function for tag presets
test_tag_preset_option() {
  print_message "$BLUE" "\n=== Testing Tag Preset Option ==="
  
  # Test js-owasp preset
  print_message "$BLUE" "Testing: --tag-preset js-owasp"
  local test_dir="$TEMP_DIR/test_preset_js_owasp"
  rm -rf "$test_dir"
  mkdir -p "$test_dir"
  
  get_fresh_installer "$test_dir/install.php"
  if [ $? -ne 0 ]; then
    print_message "$RED" "Failed to copy installer. Exiting."
    return 1
  fi
  
  cd "$test_dir"
  php install.php --tag-preset js-owasp --yes > output.log 2>&1
  local exit_code=$?
  cd "$BASE_DIR"
  
  if [ $exit_code -ne 0 ]; then
    print_message "$RED" "✗ js-owasp preset failed with exit code $exit_code"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir/output.log"
    return 1
  fi
  
  # Check that JavaScript OWASP files were installed
  local file_count=$(count_installed_files "$test_dir")
  if [ "$file_count" -lt 8 ]; then
    print_message "$RED" "✗ Expected more JavaScript OWASP files, got $file_count"
    print_message "$YELLOW" "Files found:"
    find "$test_dir/.cursor/rules" -name "*.mdc" | head -15
    return 1
  fi
  
  print_message "$GREEN" "✓ js-owasp preset installed $file_count files"
  
  # Test security preset
  print_message "$BLUE" "Testing: --tag-preset security"
  local test_dir_security="$TEMP_DIR/test_preset_security"
  rm -rf "$test_dir_security"
  mkdir -p "$test_dir_security"
  
  get_fresh_installer "$test_dir_security/install.php"
  cd "$test_dir_security"
  php install.php --tag-preset security --yes > output.log 2>&1
  local exit_code_security=$?
  cd "$BASE_DIR"
  
  if [ $exit_code_security -ne 0 ]; then
    print_message "$RED" "✗ Security preset failed with exit code $exit_code_security"
    print_message "$YELLOW" "Command output:"
    cat "$test_dir_security/output.log"
    return 1
  fi
  
  local security_file_count=$(count_installed_files "$test_dir_security")
  if [ "$security_file_count" -lt 15 ]; then
    print_message "$RED" "✗ Expected more security files, got $security_file_count"
    return 1
  fi
  
  print_message "$GREEN" "✓ Security preset installed $security_file_count files"
  
  # Test invalid preset
  print_message "$BLUE" "Testing: --tag-preset invalid-preset (should fail)"
  local test_dir_invalid="$TEMP_DIR/test_preset_invalid"
  rm -rf "$test_dir_invalid"
  mkdir -p "$test_dir_invalid"
  
  get_fresh_installer "$test_dir_invalid/install.php"
  cd "$test_dir_invalid"
  php install.php --tag-preset invalid-preset --yes > output.log 2>&1
  local exit_code_invalid=$?
  cd "$BASE_DIR"
  
  if [ $exit_code_invalid -eq 0 ]; then
    print_message "$RED" "✗ Invalid preset should have failed but succeeded"
    return 1
  fi
  
  print_message "$GREEN" "✓ Invalid preset correctly failed with exit code $exit_code_invalid"
  
  print_message "$GREEN" "✓ Tag preset option tests passed"
  return 0
}

# Run the tests
print_message "$BLUE" "Running tag-based installation tests..."

test_tags_option
if [ $? -ne 0 ]; then
  print_message "$RED" "Tag option test failed!"
  exit 1
fi

test_tag_preset_option
if [ $? -ne 0 ]; then
  print_message "$RED" "Tag preset option test failed!"
  exit 1
fi

print_message "$GREEN" "Tag-based installation tests completed successfully!"
exit 0