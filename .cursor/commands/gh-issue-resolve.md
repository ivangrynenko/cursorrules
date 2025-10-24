# Custom Command: GitHub Issue Resolve

## Command Usage
`/gh-issue-resolve <issue-url> [context]`

Treat the first argument as the GitHub issue URL (or number). Everything after that is optional analyst context to guide the resolution. If the URL is missing, pause and ask the user to provide it before continuing.

Please analyse and fix the GitHub issue referenced in the user input. The problem description provided after `/gh-issue-resolve` becomes your working context. If you cannot access the issue or the instructions are incomplete, stop and request clarification from the user before proceeding.

Follow these steps:

## 1. PLAN
1. Use 'gh issue view' to get the issue details  
2. Think and understand the problem described in the issue  
3. Ask clarifying questions if necessary  
4. Understand the prior art for this issue
   - Search the codebase for relevant files
5. Think harder about how to break the issue down into a series of small, manageable tasks.  
6. Prepare your plan  
   - include the issue name  
   - include a link to the issue.

## 2. WRITE TEST
- Create a new Git branch for the issue.
- Identify the testing framework within the project.
- Begin by writing tests in the identified framework that will satisfy the ticket acceptance criteria and overall task.
- Write behat and (or) Unit and (or) Postman tests to describe the expected behavior of your code. Tests will fail which is okay.
- Aim at minimum 80% of test coverage


## 3. WRITE CODE
- Think and solve the issue in small, manageable steps, according to your plan.
- Commit your changes after each step.
- When coding FrontEnd, use Playwright MCP to validate your work.
- Document your changes in project documentation (README.md and /docs/ folder)
- Update CHANGELOG.md file with listing the changes you're making, keep this file up to date and always validate to remove information that does not apply any longer.
- Check for the linting tools available in the project's AGENTS.md file.
- Use either playwright via MCP, or Unit, or behat to test the changes if you have made changes to the UI. If you are in a Drupal project, login via playwright browser, first execute `ahoy login` command and grab the one-time login URL as Drupal user #1. Then visit that URL to instantly login.
- Run the full test suite to ensure you haven't broken anything
- If the tests are failing, fix them, or the functionality.
- Ensure that all tests are passing before moving on to the next step
- If testing automation is present as a GitHub Actions workflow, test it locally using local Docker. Example: `act --container-architecture linux/amd64 -j test --verbose`

## 4. LINT
- Execute code linting, using tools specific to the project and resolve any errors and warnings.

## 5. DEPLOY
- Open a PR and request a review.
- Create a cross-reference links between the PR and GH issue.
- Validate PR for passing Github Actions workflow tests, resolve any test failures in GHA.

Remember to use the GitHub CLI (`gh`) for all GitHub-related tasks.
