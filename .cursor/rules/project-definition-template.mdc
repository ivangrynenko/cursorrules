---
description: Template for defining project context
globs: README.md, /docs/*
---
# Comprehensive Project Definition Template

This rule enforces best practices for documenting project context, ensuring clarity and maintainability through well-documented README files and documentation.

<rule>
name: comprehensive_project_definition
description: Enforce comprehensive project context definition for CursorAI
filters:
  - type: file_extension
    pattern: "\\.md$"
  - type: file_path
    pattern: "README.md|/docs/"

actions:
  - type: enforce
    conditions:
      - pattern: "## Project Purpose"
        message: "Define the purpose of the project in the README file, including its goals and objectives."

      - pattern: "## Technical Stack"
        message: "List the technical stack used in the project in the README file, including language versions and frameworks."

      - pattern: "## Folder Structure"
        message: "Document the folder structure in the README file with a brief explanation for each significant directory."

      - pattern: "## Customizations"
        message: "Include any custom themes, modules, or libraries in the README file, explaining their functionality."

      - pattern: "## Libraries"
        message: "List any third-party libraries used in the project in the README file, including versions for reproducibility."

      - pattern: "## Setup Instructions"
        message: "Provide clear setup instructions in the README to help new contributors or users get started."

      - pattern: "## Contribution Guidelines"
        message: "Document contribution guidelines if the project is open-source or team-based."

  - type: suggest
    message: |
      **Project Definition Best Practices:**
      - **README and Docs:** Use both README.md for an overview and /docs/ for detailed documentation.
      - **Project Purpose:** Clearly articulate why the project exists, its objectives, and who it serves.
      - **Technical Stack:** Include all technologies, versions, and possibly why each was chosen.
      - **Folder Structure:** Use tree diagrams or simple bullet points to describe the project's layout.
      - **Customizations:** Explain any custom code, including its purpose and how it integrates with the project.
      - **Libraries:** Detail external dependencies, why they're used, and how to manage them (e.g., npm, composer).
      - **Setup Instructions:** Provide step-by-step guidance for setting up the project environment.
      - **Contribution Guidelines:** Outline how to contribute, including coding standards, branch management, and pull request process.
      - **License:** Include information about the project's licensing for legal clarity.
      - **Roadmap:** Optionally, add a roadmap section to discuss future plans or features.

  - type: validate
    conditions:
      - pattern: "## Project Purpose"
        message: "Ensure the project purpose is clearly defined for understanding the project's intent."

      - pattern: "## Technical Stack"
        message: "Ensure the technical stack is documented to aid in tech stack comprehension."

      - pattern: "## Folder Structure"
        message: "Ensure the folder structure is outlined for navigation ease."

      - pattern: "## Customizations"
        message: "Ensure customizations are documented for understanding unique project elements."

      - pattern: "## Libraries"
        message: "Ensure libraries are listed for dependency management."

      - pattern: "## Setup Instructions"
        message: "Ensure setup instructions are included to facilitate onboarding."

metadata:
  priority: medium
  version: 1.1
</rule>