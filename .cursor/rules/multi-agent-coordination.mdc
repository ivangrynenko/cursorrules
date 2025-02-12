---
description: Multi-agent coordination and workflow standards
globs: *.php, *.js, *.ts, *.vue, *.jsx, *.tsx
---
# Multi-Agent Coordination Standards

Ensures consistent coordination between different AI agents and roles.

<rule>
name: multi_agent_coordination
description: Enforce standards for multi-agent coordination and workflow
filters:
  - type: file_extension
    pattern: "\\.(php|js|ts|vue|jsx|tsx)$"

actions:
  - type: enforce
    conditions:
      - pattern: "// TODO:|#\\s*TODO:"
        message: "Convert TODO comments into structured task breakdowns for multi-agent coordination"

      - pattern: "function\\s+[a-zA-Z]+Agent\\s*\\([^)]*\\)"
        message: "Implement proper agent role separation and communication"

      - pattern: "// FIXME:|#\\s*FIXME:"
        message: "Convert FIXME into specific tasks with acceptance criteria"

  - type: suggest
    message: |
      Multi-Agent Coordination Best Practices:
      - Separate Planner and Executor roles
      - Document task breakdowns and success criteria
      - Track progress in structured format
      - Use proper inter-agent communication
      - Maintain clear role boundaries
      - Focus on immediate, actionable solutions
      - Provide context for complex tasks
      - Use natural language for requirements
      - Break down complex workflows
      - Document dependencies between tasks

metadata:
  priority: high
  version: 1.0
</rule> 