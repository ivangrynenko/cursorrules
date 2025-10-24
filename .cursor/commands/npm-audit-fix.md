# Custom Command: NPM Audit Fix

## Command Usage
`/npm-audit-fix [path]`

Provide an optional project `path` (defaults to the repository root). The instructions below describe how to audit and remediate NPM vulnerabilities in the target project.

You will help audit and remediate NPM vulnerabilities in a Drupal theme project. The project uses NPM packages to build front-end assets like CSS and JavaScript, and may use NPM, Yarn, or other package managers.

Here is the project path you'll be working with:

<project_path>
the project root path
</project_path>

Your goal is to investigate the project setup, fix security vulnerabilities, ensure assets build properly in both host and Docker environments, and update documentation to guide developers on front-end asset rendering.

Before executing the remediation steps, wrap your analysis in <project_analysis> tags to systematically document your findings. It's OK for this section to be quite long. Include:

- **File Structure**: List the key files found in the project (package.json, lock files, Docker files, .nvmrc, etc.)
- **Package Manager Detection**: Identify which package manager is being used and document the evidence
- **Build Environment**: Determine if builds happen on host vs Docker and identify the build commands
- **Node Version**: Check for .nvmrc or other version specifications
- **Git Baseline**: Record the current git status to establish a baseline
- **Vulnerability Assessment**: Run and document the results of npm/yarn audit, listing each vulnerability with its severity
- **Remediation Strategy**: Plan your approach for fixing vulnerabilities while minimizing breaking changes

Before proceeding, make sure the PHP runtime has access to the same project files as the CLI container. The PHP image in this stack does not mount the module code by default, so you must manually sync the files before attempting any audits or Drupal commands:

**Mandatory Container Sync (must be performed manually by the assistant)**
- Identify the running PHP pod/container for the target environment. For Lagoon-based stacks use `kubectl get pods -l lagoon.sh/project=the project name,lagoon.sh/service=php` (or the equivalent `kubectl get pod` command provided by the platform). For local Docker Compose environments use `docker compose ps php` to confirm the container name.
- Determine the CLI container name (typically `the project name` locally or the Lagoon CLI pod). This container has the authoritative Drupal codebase.
- Copy the missing module directories from the CLI container to the PHP container so PHP can load them. Example (Docker): `docker cp $(docker compose ps -q cli):/app/web/modules/. $(docker compose ps -q php):/app/web/modules/` and repeat for any other required paths (e.g. `/app/vendor`, `/app/web/profiles`). Example (Lagoon/Kubernetes): `kubectl cp <cli-pod>:/app/web/modules <php-pod>:/app/web/modules -c php`.
- Verify inside the PHP container that the expected module (e.g. `upgrade_status`) now exists under `/app/web/modules/contrib`. Do not restart or recreate containers; only manual copying is permitted.

Then follow these systematic steps:

**Step 1: Initial Project Investigation**
- Navigate to the project path and examine the file structure
- Look for package.json, yarn.lock, package-lock.json to determine which package manager is in use
- Check for Dockerfile or docker-compose.yml files that contain asset building instructions
- Examine .nvmrc file for Node version requirements; if missing, create one with a reasonable LTS version

**Step 2: Environment Detection**
- Determine whether asset building happens on the host machine (typically macOS) or in Docker
- If Docker is used, identify the specific commands used for asset building
- Note any build scripts defined in package.json

**Step 3: Git Status Baseline**
- Run `git status` and document the current state
- This baseline will help identify if any distributed assets are incorrectly committed

**Step 4: NPM Security Audit**
- Run `npm audit` (or `yarn audit` if Yarn is detected) to identify vulnerabilities
- Document all vulnerabilities found, including their severity levels and affected packages

**Step 5: Vulnerability Remediation**
- Start with `npm audit fix` or the equivalent command for your detected package manager
- For vulnerabilities that can't be auto-fixed, research each one individually:
  - Check if newer versions of packages resolve the issues
  - Look for alternative packages if necessary
  - Prioritize fixes that don't break compatibility
- Update packages incrementally, testing after each major change

**Step 6: Asset Building and Testing**
- Build assets using the identified build process
- Test building on the host machine first
- If Docker is used, test building in the Docker environment as well
- Ensure all assets compile without errors

**Step 7: Git Status Validation**
- Run `git status` again after building assets
- Compare with the baseline from Step 3
- If any files in distribution/build folders were removed:
  - Move these files to a separate backup folder
  - Update build scripts to copy these files back to their proper location
  - Document this process for future reference

**Step 8: Documentation Review and Updates**
- Review the README file inside the theme directory
- Update the project-level README file to include clear instructions for front-end asset rendering
- Ensure the README provides step-by-step guidance for developers on how to execute front-end asset compilation

**Step 9: Ahoy Command Verification**
- Verify that the `ahoy fe` command exists and successfully compiles assets
- Verify that the `ahoy fei` command exists and successfully installs dependencies
- Ensure these commands work when executed from the root level
- Confirm that the commands pass the necessary arguments to NPM, Yarn, or whatever compiler is being used
- If these commands don't exist or don't work properly, create or fix them

**Step 10: Cross-Environment Validation**
- Test the complete build process in both host and Docker environments
- Verify that all assets are generated correctly in both contexts
- Confirm that any manually managed assets are properly handled

**Important Guidelines:**
- Minimize changes to avoid breaking existing functionality
- Test thoroughly after each significant change
- Preserve any assets that were manually placed in distribution folders
- Ensure Node version consistency across environments
- Document any workarounds or special handling required

Provide your analysis and remediation work in the following format:

<remediation_report>
**Vulnerability Summary:** [List vulnerabilities found and how they were addressed]

**Package Changes:** [Detail any package replacements or major updates made]

**Build Environment Setup:** [Describe whether builds happen on host vs Docker, and any special configuration]

**Asset Handling:** [Explain any special handling required for manually managed assets]

**Ahoy Command Status:** [Confirm that 'ahoy fe' and 'ahoy fei' commands exist and work properly]

**Documentation Updates:** [Summarize changes made to theme and project README files]

**Cross-Environment Testing:** [Confirm that builds work in both host and Docker environments]

**Future Recommendations:** [Provide recommendations for preventing similar issues]
</remediation_report>
