# Custom Command: GitHub Issue Create

## Command Usage
`/gh-issue-create <description>`

Everything after `/gh-issue-create` is treated as a single argument containing the user's description of what they want to achieve.

## Instructions

You are implementing a command that intelligently creates GitHub issues based on user descriptions. This task must avoid any code changes.

 Think harder and follow these steps thoroughly:

### 1. Parse and Understand Context
- **Extract Requirements**: Identify core functionality from the original request, accept the full text after the command as the user's description, analyse the current working directory to understand the project context; Identify the Git repository and its remote origin.
- **Define Test Cases**: Create specific, measurable test scenarios
- **Specify Expected Outcomes**: Clear success and failure criteria
- **Structure for Implementation**: Organize prompt for red-green-refactor cycle
- **Include Edge Cases**: Don't forget boundary conditions and error scenarios

### 2. Codebase Analysis
- Explore the relevant parts of the codebase mentioned in the description
- Look for:
  - Related existing code
  - Configuration files
  - Documentation (README, docs/, wiki references)
  - Similar patterns or implementations
  - Dependencies that might be affected

### 3. Issue Classification
Determine the issue type based on the description:
- **Bug**: Something is broken or not working as expected
- **Feature**: New functionality that doesn't exist
- **Enhancement**: Improvement to existing functionality
- **Task**: Technical work, refactoring, or maintenance

### 4. TDD Prompt Structure

#### 1. Objective Statement
Clear, concise description of what needs to be built

#### 2. Test Specifications
```
GIVEN: [Initial state/context]
WHEN: [Action performed]
THEN: [Expected outcome]
```

### 5. Break Down Into Tasks
Decompose the description into specific, actionable tasks:
- Each task should be atomic and testable
- Think to consider technical dependencies
- Include both implementation and testing tasks
- Think about documentation updates needed

### 6. Define Acceptance Criteria
For each major component, think hard to establish clear acceptance criteria:
- What specific behaviour should be implemented?
- What are the success conditions? Define specific, measurable outcomes.
- What edge cases need handling?
- What are the error handling expectations?
- What tests would validate the implementation?
- What are performance requirements?

#### 6.1 Test Cases Format
```markdown
Test Case 1: [Descriptive name]
- Input: [Specific input data]
- Expected Output: [Exact expected result]
- Validation: [How to verify success]

Test Case 2: [Edge case name]
- Input: [Boundary/error condition]
- Expected Output: [Error handling result]
- Validation: [Error verification method]
```

#### 6.2 Conversion Examples

##### Original Request:
"Add user login functionality"

##### TDD Conversion:
```markdown
## Objective
Implement secure user login with email/password authentication

## Test Specifications

### Test 1: Successful Login
GIVEN: Valid user credentials exist in database
WHEN: User submits correct email and password
THEN: User receives auth token and is redirected to dashboard

### Test 2: Invalid Password
GIVEN: Valid email but incorrect password
WHEN: User submits login form
THEN: Return error "Invalid credentials" without revealing which field is wrong

### Test 3: Non-existent User
GIVEN: Email not in database
WHEN: User attempts login
THEN: Return same "Invalid credentials" error (prevent user enumeration)

### Test 4: Rate Limiting
GIVEN: User has failed 5 login attempts
WHEN: User attempts 6th login within 15 minutes
THEN: Block attempt and show "Too many attempts" error

## Success Criteria
- All tests pass
- Password is hashed using bcrypt
- Auth tokens expire after 24 hours
- Login attempts are logged
- Response time < 200ms
```

#### 6.3 Output Format

Generate TDD prompt as:

```markdown
## TDD Prompt: [Feature Name]

### Objective
[Clear description of the feature to implement]

### Test Suite

#### Happy Path Tests
[List of successful scenario tests]

#### Error Handling Tests
[List of failure scenario tests]

#### Edge Case Tests
[List of boundary condition tests]

### Implementation Requirements
- [ ] All tests must pass
- [ ] Code coverage > 80%
- [ ] Performance criteria met
- [ ] Security requirements satisfied

### Test-First Development Steps
1. Write failing test for [first requirement]
2. Implement minimal code to pass
3. Refactor while keeping tests green
4. Repeat for next requirement

### Example Test Implementation
```language
// Example test code structure
```
```

#### Remember to:
- Focus on behavior, not implementation details
- Make tests specific and measurable
- Include both positive and negative test cases
- Structure for iterative TDD workflow

### 7. Generate Issue Content
Structure the issue with:
- **Title**: Concise, descriptive summary
- **Type**: Bug/Feature/Enhancement/Task label
- **Description**: Clear explanation of the need
- **Tasks**: Bulleted list of implementation steps
- **Acceptance Criteria**: Testable success conditions
- **Testing scenarios**: Numbered list of testing scenarios in the requested format
- **Technical Notes**: Any implementation considerations
- **Related Files**: Key files that will be affected

### 8. Present for Confirmation
Before creating the issue, present the formatted content to the user:
```
=== GitHub Issue Preview ===
Repository: [detected repo]
Title: [generated title]
Type: [classification]

Description:
[formatted description]

Tasks:
- [ ] Task 1
- [ ] Task 2
...

Acceptance Criteria:
- [ ] Criteria 1
- [ ] Criteria 2
...

Technical Notes:
[any relevant notes]

Related Files:
- file1.js
- file2.php
...
===========================

Would you like to create this issue? (yes/no)
```

### 9. Create the Issue
If confirmed:
- Detect the Git remote origin URL
- Extract the GitHub repository owner and name
- Use the GitHub API to create the issue
- Return the created issue URL

## Example Behaviour

User input: `/gh-issue-create Add user authentication with email verification and password reset functionality`

Your process:
1. Scan for existing auth implementation
2. Check for auth-related dependencies
3. Classify as "Feature"
4. Break down into: database schema, registration endpoint, email service, verification flow, password reset flow, tests
5. Define criteria for each component
6. Identify test cases
7. Present formatted issue for review
8. Create upon confirmation using github mcp or github cli

## Error Handling
- If no Git repository found: Inform user and exit
- If no remote origin: Ask user to specify repository
- If GitHub API fails: Provide issue content for manual creation
- If description too vague: Ask clarifying questions

## Important Notes
- Always think step-by-step through the entire process
- Be thorough in codebase exploration
- Make reasonable assumptions but note them
- Focus on creating actionable, well-structured issues
- Consider the project's conventions and patterns
```
