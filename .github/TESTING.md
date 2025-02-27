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

# Testing GitHub Actions Workflows Locally

This guide explains how to test GitHub Actions workflows locally before pushing changes to GitHub.

## Prerequisites

You need to install [act](https://github.com/nektos/act), a tool for running GitHub Actions locally:

- **macOS**:
  ```bash
  brew install act
  ```

- **Linux**:
  ```bash
  curl -s https://raw.githubusercontent.com/nektos/act/master/install.sh | sudo bash
  ```

- **Windows**:
  ```bash
  # Using Chocolatey
  choco install act-cli
  
  # Or download from GitHub releases
  # https://github.com/nektos/act/releases
  ```

## Using the Test Script

We've provided a convenient script to run workflows locally:

```bash
./.github/test-workflow-locally.sh
```

### Options

- `-w, --workflow FILE`: Specify the workflow file to test (default: `.github/workflows/test.yml`)
- `-e, --event EVENT`: Specify the event type to trigger (default: `push`)
- `-j, --job JOB`: Run a specific job from the workflow
- `-h, --help`: Show help message

### Examples

```bash
# Run the default workflow with push event
./.github/test-workflow-locally.sh

# Run a specific workflow file
./.github/test-workflow-locally.sh --workflow .github/workflows/custom.yml

# Run with pull_request event
./.github/test-workflow-locally.sh --event pull_request

# Run only a specific job
./.github/test-workflow-locally.sh --job test
```

## Manual Usage

You can also use `act` directly:

```bash
# Run the default workflow
act

# Run a specific workflow
act -W .github/workflows/test.yml

# Run a specific job
act -j test

# Run with pull_request event
act pull_request
```

## Docker Images

By default, `act` uses minimal Docker images that might not include all the tools needed for your workflow. You can specify different images:

```bash
# Use full Ubuntu image (larger but more complete)
act -P ubuntu-latest=ghcr.io/catthehacker/ubuntu:full-latest

# Use medium-sized image
act -P ubuntu-latest=ghcr.io/catthehacker/ubuntu:act-latest
```

## Secrets and Environment Variables

To use secrets or environment variables:

```bash
# Using a .env file
act --env-file .env

# Passing secrets directly
act -s MY_SECRET=value
```

## Limitations

- Some GitHub-specific features might not work locally
- Complex workflows with many dependencies might require additional configuration
- GitHub-hosted runners might have different environments than your local Docker containers

## Troubleshooting

If you encounter issues:

1. Make sure Docker is running
2. Try using a more complete Docker image with `-P ubuntu-latest=ghcr.io/catthehacker/ubuntu:full-latest`
3. Check if your workflow requires specific secrets or environment variables
4. For complex setups, consider creating a `.actrc` file with your configuration

For more information, visit the [act GitHub repository](https://github.com/nektos/act). 