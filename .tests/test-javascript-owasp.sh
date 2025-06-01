#!/bin/bash

# Test JavaScript OWASP rules installation
source "$(dirname "$0")/file-maps.sh"

echo "Testing JavaScript OWASP rules installation..."

# Create temporary test directory
TEST_DIR=$(mktemp -d)
INSTALL_SCRIPT="$TEST_DIR/install.php"

# Copy installer to test directory
cp "$(dirname "$0")/../install.php" "$INSTALL_SCRIPT"

echo "Test directory: $TEST_DIR"

# Test 1: Install JavaScript rules only
echo "Test 1: Installing JavaScript OWASP rules..."
cd "$TEST_DIR"
php install.php --javascript --yes

if validate_javascript "$TEST_DIR"; then
  echo "✓ JavaScript OWASP rules installation successful"
else
  echo "✗ JavaScript OWASP rules installation failed"
  exit 1
fi

# Test 2: Install using tag filtering
echo "Test 2: Installing using tag filtering..."
rm -rf "$TEST_DIR/.cursor"
php install.php --tags "language:javascript category:security" --yes

if validate_javascript "$TEST_DIR"; then
  echo "✓ Tag filtering installation successful"
else
  echo "✗ Tag filtering installation failed"
  exit 1
fi

# Test 3: Install using tag preset
echo "Test 3: Installing using tag preset..."
rm -rf "$TEST_DIR/.cursor"
php install.php --tag-preset js-owasp --yes

if validate_javascript "$TEST_DIR"; then
  echo "✓ Tag preset installation successful"
else
  echo "✗ Tag preset installation failed"
  exit 1
fi

# Cleanup
rm -rf "$TEST_DIR"

echo "All JavaScript OWASP tests passed!"
exit 0