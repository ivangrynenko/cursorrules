# Cursor Rules Test Workflow

[![Cursor Rules Tests](https://github.com/ivangrynenko/cursor-rules/actions/workflows/test.yml/badge.svg)](https://github.com/ivangrynenko/cursor-rules/actions/workflows/test.yml)

This directory contains the GitHub Actions workflow configuration for testing the Cursor Rules installer.

## Workflow Overview

The `test.yml` workflow runs automatically on:
- Push to the `main` branch
- Pull requests targeting the `main` branch

## What the Workflow Tests

The workflow runs a series of tests to ensure the Cursor Rules installer functions correctly:

1. **Basic Tests**
   - `test-copy.sh`: Verifies the installer file can be copied correctly
   - `test-debug.sh`: Runs the installer with the `--help` option to verify basic functionality

2. **Error Handling Tests**
   - `test-invalid-option.sh`: Tests the installer's response to invalid options
   - `test-conflicting-options.sh`: Tests the installer's response to conflicting options
   - `test-missing-files.sh`: Tests file validation with missing files

3. **Full Installation Tests**
   - `run-all-tests.sh`: Runs a comprehensive test suite covering all installation options

## Test Results

The workflow generates a test summary and uploads test logs as artifacts, which can be accessed from the GitHub Actions page.

## Local Testing

You can run the tests locally in two ways:

### Option 1: Direct Script Execution

```bash
# Run all tests
./.tests/run-all-tests.sh

# Run individual tests
./.tests/test-copy.sh
./.tests/test-debug.sh
./.tests/test-invalid-option.sh
./.tests/test-conflicting-options.sh
./.tests/test-missing-files.sh
```

### Option 2: Using GitHub Actions Locally

You can test the GitHub Actions workflow locally using [act](https://github.com/nektos/act):

```bash
# Run the entire workflow
./.github/test-workflow-locally.sh

# Run a specific job
./.github/test-workflow-locally.sh --job test
```

For detailed instructions on local testing, see [TESTING.md](TESTING.md).

## Workflow Configuration

The workflow is configured to:
- Run on PHP 8.1 and 8.2
- Validate PHP syntax
- Generate detailed test reports
- Upload test logs as artifacts

## Best Practices

- Always use the latest versions of GitHub Actions (e.g., `actions/checkout@v4`, `actions/upload-artifact@v4`)
- Test workflow changes locally before pushing to GitHub
- Keep workflow steps modular and well-documented 