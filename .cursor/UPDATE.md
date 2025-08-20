# Cursor Rules Updates

## Version 1.0.6 - 2025-08-20

### AGENTS.md Documentation Added

**New Documentation:**
- Added comprehensive AGENTS.md guide for using Cursor Rules with Cursor AI
- Links to all rule bundles (Core, Web Stack, Python, JavaScript Security)
- Tag-based selection documentation and examples
- Installation options reference guide

**Installer Improvements:**
- Fixed hanging issue when piping installer through curl
- Added proper STDIN handling for piped execution
- Improved argument parsing for curl-based installation
- Added fclose(STDIN) to prevent PHP from waiting for input after completion

**Bug Fixes:**
- Resolved script hanging when using `curl ... | php` commands
- Fixed argument parsing when using `--` separator with piped input
- Corrected PHP_SELF detection for piped execution

**File:** `install.php`, `AGENTS.md`
**Impact:** Major improvement to installation experience and documentation
**Breaking Changes:** None - backward compatible

---

## Version 1.0.5 - 2025-01-03

### Major Updates to Pull Request Review Instructions

**Enhanced Multi-Language Support:**
- Added comprehensive support for all languages in cursor rules (PHP, Python, JavaScript, TypeScript, CSS, HTML)
- Implemented language-specific coding standards and security practices
- Added framework-specific guidelines (Drupal, Django, React, Vue.js, Express.js)

**Large File Detection and Skipping:**
- Added logic to skip compiled/minified files (>1MB, *.min.*, *-bundle.*, etc.)
- Implemented vendor directory filtering (node_modules/, vendor/, dist/, build/)
- Added auto-generated file detection to focus on source code only

**Improved Security Assessment:**
- Language-specific security checks (SQL injection, XSS, command injection)
- Framework-aware security considerations
- OWASP compliance across all supported languages

**Enhanced Label Management:**
- Added language-specific labels (lang/php, lang/python, lang/javascript, etc.)
- Automatic language detection based on file extensions
- Technology-specific colour coding using official language colours

**Technology Detection Process:**
- File extension analysis for automatic language identification
- Framework detection through config files (package.json, composer.json, etc.)
- Project structure analysis for framework patterns
- Dependency analysis and build tool detection

**Updated Review Checklist:**
- File analysis requirements with mandatory large file skipping
- Language-specific sections for targeted reviews
- Enhanced security focus across all technologies
- Performance considerations for each language

**File:** `new-pull-request.mdc`
**Impact:** Major enhancement to code review capabilities across all supported languages
**Breaking Changes:** None - backward compatible

---

## Previous Versions

### Version 1.0.4
- Previous version (details to be added)

### Version 1.0.3
- Previous version (details to be added)

### Version 1.0.2
- Previous version (details to be added)

### Version 1.0.1
- Previous version (details to be added)

### Version 1.0.0
- Initial release