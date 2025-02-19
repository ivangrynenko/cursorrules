---
description: Enforce general Bash scripting standards with enhanced logging
globs: 
---
# Enhanced Bash Scripting Standard with Colorized Logging

This rule enforces best practices for writing Bash scripts, with an emphasis on using colorized logging for better output readability.

<rule>
name: enhanced_bash_style
description: Enforce Bash scripting standards with colorized logging
filters:
  - type: file_extension
    pattern: "\\.sh$"

actions:
  - type: enforce
    conditions:
      - pattern: "^#!/usr/bin/env bash$"
        message: "All scripts should start with the shebang '#!/usr/bin/env bash'."

      - pattern: "^set -eu$"
        message: "Enable 'set -eu' for script robustness."

      - pattern: "^set -x$"
        pattern_negate: "^\\[ \"\\${DEBUG-}\" = \"1\" ] && set -x$"
        message: "Use conditional 'set -x' based on debug flag."

      - pattern: "^# @formatter:off$"
        message: "Start of formatting block for log functions."

      - pattern: "note\\(\\) { printf \"       %s\\n\" \"\\${1}\"; }$"
        message: "Include 'note' function for plain messages."

      - pattern: "info\\(\\) { \\[ \"\\${TERM:-}\" != \"dumb\" ] && tput colors >/dev/null 2>&1 && printf \"\\\\033\\[34m\\[INFO] %s\\\\033\\[0m\\n\" \"\\${1}\" || printf \"\\[INFO] %s\\n\" \"\\${1}\"; }$"
        message: "Include 'info' function for blue informational messages."

      - pattern: "pass\\(\\) { \\[ \"\\${TERM:-}\" != \"dumb\" ] && tput colors >/dev/null 2>&1 && printf \"\\\\033\\[32m\\[ OK ] %s\\\\033\\[0m\\n\" \"\\${1}\" || printf \"\\[ OK ] %s\\n\" \"\\${1}\"; }$"
        message: "Include 'pass' function for green success messages."

      - pattern: "fail\\(\\) { \\[ \"\\${TERM:-}\" != \"dumb\" ] && tput colors >/dev/null 2>&1 && printf \"\\\\033\\[31m\\[FAIL] %s\\\\033\\[0m\\n\" \"\\${1}\" || printf \"\\[FAIL] %s\\n\" \"\\${1}\"; }$"
        message: "Include 'fail' function for red error messages."

      - pattern: "warn\\(\\) { \\[ \"\\${TERM:-}\" != \"dumb\" ] && tput colors >/dev/null 2>&1 && printf \"\\\\033\\[33m\\[WARN] %s\\\\033\\[0m\\n\" \"\\${1}\" || printf \"\\[WARN] %s\\n\" \"\\${1}\"; }$"
        message: "Include 'warn' function for yellow warning messages."

      - pattern: "^# @formatter:on$"
        message: "End of formatting block for log functions."

  - type: suggest
    message: |
      **Bash Scripting Best Practices:**
      - **Error Handling:** Use `set -eu` to catch errors and undefined variables early.
      - **Debugging:** Implement conditional debugging with `set -x` using a DEBUG variable.
      - **Logging Functions:** Use colorized logging for better script output readability:
        - `note()` for plain notes
        - `info()` for blue informational messages
        - `pass()` for green success messages
        - `fail()` for red error messages
        - `warn()` for yellow warnings, ensuring users can distinguish different types of messages easily
      - **Security:** Avoid using `eval` or similar constructs; use safe alternatives.
      - **Documentation:** Include descriptive comments, especially for complex logic.
      - **Portability:** Use `/usr/bin/env bash` for the shebang to ensure script runs with bash on any system.
      - **Variable Checks:** Ensure necessary variables are set, enhancing script reliability.
      - **Exit Codes:** Use explicit exit codes for different failure scenarios.
      - **Color Support:** Ensure logging functions check for terminal color support before applying colors.

metadata:
  priority: medium
  version: 1.1
</rule>