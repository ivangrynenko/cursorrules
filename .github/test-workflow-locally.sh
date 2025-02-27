#!/bin/bash
# Script to test GitHub Actions workflows locally using act
# https://github.com/nektos/act

set -e

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Print header
echo -e "${BLUE}=========================================${NC}"
echo -e "${BLUE}   Testing GitHub Actions Workflows      ${NC}"
echo -e "${BLUE}=========================================${NC}"

# Check if act is installed
if ! command -v act &> /dev/null; then
    echo -e "${RED}Error: 'act' is not installed.${NC}"
    echo -e "${YELLOW}Please install it using one of the following methods:${NC}"
    echo -e "  - macOS: ${GREEN}brew install act${NC}"
    echo -e "  - Linux: ${GREEN}curl -s https://raw.githubusercontent.com/nektos/act/master/install.sh | sudo bash${NC}"
    echo -e "  - Manual: Visit ${GREEN}https://github.com/nektos/act#installation${NC}"
    exit 1
fi

# Default workflow file
WORKFLOW_FILE=".github/workflows/test.yml"

# Parse command line arguments
while [[ $# -gt 0 ]]; do
    key="$1"
    case $key in
        -w|--workflow)
            WORKFLOW_FILE="$2"
            shift
            shift
            ;;
        -e|--event)
            EVENT_TYPE="$2"
            shift
            shift
            ;;
        -j|--job)
            JOB_NAME="$2"
            shift
            shift
            ;;
        -h|--help)
            echo -e "${GREEN}Usage:${NC}"
            echo -e "  $0 [options]"
            echo -e ""
            echo -e "${GREEN}Options:${NC}"
            echo -e "  -w, --workflow FILE    Workflow file to test (default: .github/workflows/test.yml)"
            echo -e "  -e, --event EVENT      Event type to trigger (default: push)"
            echo -e "  -j, --job JOB          Run specific job"
            echo -e "  -h, --help             Show this help message"
            echo -e ""
            echo -e "${GREEN}Examples:${NC}"
            echo -e "  $0"
            echo -e "  $0 --workflow .github/workflows/custom.yml"
            echo -e "  $0 --event pull_request"
            echo -e "  $0 --job build"
            exit 0
            ;;
        *)
            echo -e "${RED}Unknown option: $key${NC}"
            echo -e "Use ${GREEN}$0 --help${NC} for usage information."
            exit 1
            ;;
    esac
done

# Set default event type if not specified
if [ -z "$EVENT_TYPE" ]; then
    EVENT_TYPE="push"
fi

echo -e "${YELLOW}Workflow file:${NC} $WORKFLOW_FILE"
echo -e "${YELLOW}Event type:${NC} $EVENT_TYPE"
if [ ! -z "$JOB_NAME" ]; then
    echo -e "${YELLOW}Job name:${NC} $JOB_NAME"
fi

# Check if workflow file exists
if [ ! -f "$WORKFLOW_FILE" ]; then
    echo -e "${RED}Error: Workflow file '$WORKFLOW_FILE' not found.${NC}"
    exit 1
fi

echo -e "${BLUE}----------------------------------------${NC}"
echo -e "${GREEN}Starting local workflow execution...${NC}"
echo -e "${BLUE}----------------------------------------${NC}"

# Build the act command
ACT_CMD="act $EVENT_TYPE -W $WORKFLOW_FILE"

# Add job name if specified
if [ ! -z "$JOB_NAME" ]; then
    ACT_CMD="$ACT_CMD -j $JOB_NAME"
fi

# Run the act command
echo -e "${YELLOW}Executing:${NC} $ACT_CMD"
echo -e "${BLUE}----------------------------------------${NC}"
eval $ACT_CMD

# Check exit status
if [ $? -eq 0 ]; then
    echo -e "${BLUE}----------------------------------------${NC}"
    echo -e "${GREEN}Workflow execution completed successfully!${NC}"
    echo -e "${BLUE}=========================================${NC}"
else
    echo -e "${BLUE}----------------------------------------${NC}"
    echo -e "${RED}Workflow execution failed!${NC}"
    echo -e "${BLUE}=========================================${NC}"
    exit 1
fi 