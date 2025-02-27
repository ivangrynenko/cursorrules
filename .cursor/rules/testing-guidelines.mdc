---
description: Testing Guidelines
globs: 
alwaysApply: false
---
# Revised Cursor Rule File - Testing Guidelines (preserving functionality)
# This file outlines testing policies that maintain existing functionality while incorporating best software testing practices.
# It enforces separation of production and test code, allows controlled use of test hooks, and defines processes for exceptions and documentation alignment.
rules:
  - name: Test-Production Separation
    description: "Test code must remain strictly separated from production code."
    guidelines:
      - "Place test code in dedicated test directories or modules, separate from production code."
      - "Allow test-specific helpers or hooks only in a controlled manner (e.g., via clearly isolated interfaces or configurations)."
      - "Production code should remain unchanged for testing, unless using approved test extension points."
  - name: Testability (Mocks and Stubs)
    description: "Enable testability by using mocks and stubs for external dependencies."
    guidelines:
      - "Prefer dependency injection or interfaces to swap real components with mocks or stubs in tests."
      - "Avoid duplicating production logic in test code; tests should call into production code or use simplified mocks rather than reimplementing logic."
  - name: Exception Handling
    description: "Any necessary modification to production code for testing is an exception and requires review."
    guidelines:
      - "Document and justify any change made to production code solely for testing purposes."
      - "Obtain approval through a formal review process (e.g., code review by senior developers or architects) for such changes."
      - "Ensure that any approved change does not alter the intended functionality of the production code."
  - name: Documentation Alignment
    description: "Align test expectations with existing documentation without modifying production documentation."
    guidelines:
      - "Write tests to validate behaviors as documented in product or code documentation."
      - "If a test reveals a discrepancy between actual behavior and documentation, address it by updating the documentation via the normal process, not by changing production code to fit tests."
      - "Keep production code comments and descriptions unchanged during testing; refine tests or documentation instead to resolve mismatches."
  - name: Industry Best Practices
    description: "Follow industry best practices for software testing with clear boundaries."
    guidelines:
      - "Clearly delineate test types (unit, integration, end-to-end) and ensure each is executed in appropriate environments."
      - "Isolate tests to avoid side effects, and clean up any test data or state after execution."
      - "Integrate tests into continuous integration workflows to run automatically without requiring changes to production code."