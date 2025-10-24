# Custom Command: PR Resolve

## Command Usage
`/pr-resolve <pr-url-or-number> [context]`

Require the PR URL/number as the first argument. Treat any following text as remediation instructions from the reviewer.

Please address review comments for Pull Request: Use the user-provided arguments (if any) as contextual input.
If no artument was provided or you can't read it, stop and ask the user for the prompt, pull request URL and any instructions. Any user input becomes the Use the user-provided arguments (if any) as contextual input. Use those instructions from the Use the user-provided arguments (if any) as contextual input and pull request URL in further steps.

This command uses AI coding agent to efficiently resolve PR feedback while maintaining code quality.

## 0. VALIDATION PHASE
If no PR link provided in Use the user-provided arguments (if any) as contextual input, ask user:
"Please provide the PR link (e.g., https://github.com/org/repo/pull/123 or just the PR number if in the current repo)"

## 1. ANALYSIS PHASE
Launch initial analysis agent:
```
Task: "Analyze PR #Use the user-provided arguments (if any) as contextual input comprehensively:
- Use 'gh pr view Use the user-provided arguments (if any) as contextual input' to get PR details
- Use 'gh pr reviews Use the user-provided arguments (if any) as contextual input' to get all review comments
- Use 'gh api repos/{owner}/{repo}/pulls/{number}/comments' for inline file comments
- Check current PR status and CI/CD results
- Categorize feedback into: code changes, test additions, documentation updates
- Check project's AGENTS.md for available testing and linting commands"
```

## 2. MULTI-STEP RESOLUTION PHASE

### Step 1 - Code Changes & Review Comments
```
Task: "Address all code review feedback for PR #Use the user-provided arguments (if any) as contextual input:
- For each review comment:
  * Understand the requested change
  * Implement the fix following reviewer suggestions
  * Search codebase for similar patterns to ensure consistency
- For inline file comments:
  * Navigate to exact file and line
  * Implement suggested changes
  * Consider impact on surrounding code
- Make logical commits grouping related changes"
```

### Step 2 - Testing & Validation
```
Task: "Ensure all tests pass for PR #Use the user-provided arguments (if any) as contextual input:
- Check AGENTS.md for project-specific test commands
- Detect available testing frameworks:
  * Look for: composer.json, package.json, Makefile, ahoy.yml
  * For Drupal: check for phpunit.xml, behat.yml
  * Check for Playwright/Puppeteer configs or MCP servers
- Run the full test suite:
  * Use commands from AGENTS.md first
  * Fallback to standard commands (composer test, npm test)
  * For Drupal: try `ahoy test`, `ahoy test-bdd`, `ahoy test-unit`, `ddev test`, `lando test`
- If tests fail:
  * Analyze failure reasons
  * Fix failing tests or implementation
  * Add new tests if requested in reviews"
```

### Step 3 - Linting & Code Quality
```
Task: "Fix all linting and style issues for PR #Use the user-provided arguments (if any) as contextual input:
- Check AGENTS.md for project-specific linting commands
- Detect available linters:
  * For PHP: phpcs, phpstan, psalm
  * For JS: eslint, prettier
  * For Python: flake8, black, pylint
- Run all applicable linters:
  * Use commands from AGENTS.md first
  * Fix all warnings and errors
  * For Drupal: ensure coding standards compliance
- Run formatters if available
- Ensure blank empty line at the end of every file in your PR review
- Verify no new linting issues introduced"
```

## 3. DOCUMENTATION PHASE
After code changes complete, if needed:
```
Task: "Update documentation for PR #Use the user-provided arguments (if any) as contextual input:
- Review all code changes from other agents
- Check if any of these require documentation updates:
  * API changes
  * New functionality
  * Changed methodology or approach
  * Configuration changes
- Update relevant documentation:
  * Inline code comments
  * README.md (only if necessary)
  * For Drupal: update .module file docs, hook_help()
  * API documentation if applicable
- Do NOT create new documentation files unless critical"
```

## 4. FINALIZATION PHASE
After all agents complete successfully:
```
Task: "Finalize and push changes for PR #Use the user-provided arguments (if any) as contextual input:
- Run final test suite to ensure nothing broken
- Run final linting pass
- Create clear commit messages explaining changes
- Group related changes into logical commits
- Push all commits to update the PR
- Post a comment on PR summarizing addressed feedback:
  * List all resolved comments
  * Mention any remaining concerns
  * Thank reviewers for feedback"
```

## 5. VERIFICATION
Final check:
- Use 'gh pr checks Use the user-provided arguments (if any) as contextual input' to verify CI/CD status
- Ensure all automated checks are passing

## Key Principles:
1. **Systematic Approach**: Every review comment is tracked and addressed
2. **Quality Gates**: Changes only pushed after tests and linting pass
3. **Project Awareness**: Always check AGENTS.md for project-specific commands
4. **Documentation**: Update docs only when functionality changes

## Error Handling:
- If PR not found: Ask user for correct PR link
- If tests fail: Fix before proceeding
- If linting fails: Fix before pushing
- If push fails: Check branch permissions and conflicts
