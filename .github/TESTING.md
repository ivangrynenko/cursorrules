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