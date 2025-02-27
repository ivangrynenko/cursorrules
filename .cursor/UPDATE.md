# Updating Cursor Rules

This document provides brief instructions on how to update the cursor rules in your project.

## Automatic Update (Recommended)

Run this command in your project root to automatically update all cursor rules:

```sh
curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php
```

This will:
1. Download and run the installer script
2. Create the `.cursor/rules` directory if it doesn't exist
3. Install/update all Cursor rules
4. Remove the installer script automatically

## Manual Update

If you prefer to update the rules manually:

1. **Clone the repository**:
   ```sh
   git clone https://github.com/ivangrynenko/cursor-rules.git
   cd cursor-rules
   ```

2. **Copy the rules into your project's .cursor/rules/ directory**:
   ```sh
   mkdir -p .cursor/rules
   cp .cursor/rules/*.mdc .cursor/rules/
   ```

## Selective Update

If you only want to update specific rules:

1. Visit the [GitHub repository](https://github.com/ivangrynenko/cursor-rules)
2. Navigate to the `.cursor/rules` directory
3. Download only the specific rule files you need
4. Place them in your project's `.cursor/rules` directory

## Verification

After updating, you can verify that the rules are properly installed by checking the contents of your `.cursor/rules` directory:

```sh
ls -la .cursor/rules
```

The rules will automatically be used by Cursor AI in your workflow once they are updated. 