---
description: Detect and prevent the use of vulnerable and outdated components in JavaScript applications as defined in OWASP Top 10:2021-A06
globs: **/*.js, **/*.jsx, **/*.ts, **/*.tsx, !**/node_modules/**, !**/dist/**, !**/build/**, !**/coverage/**
---
# JavaScript Vulnerable and Outdated Components (OWASP A06:2021)

<rule>
name: javascript_vulnerable_outdated_components
description: Detect and prevent the use of vulnerable and outdated components in JavaScript applications as defined in OWASP Top 10:2021-A06

actions:
  - type: enforce
    conditions:
      # Pattern 1: Outdated Package Versions in package.json
      - pattern: "\"(dependencies|devDependencies)\"\\s*:\\s*\\{[^}]*?\"([^\"]+)\"\\s*:\\s*\"\\^?([0-9]+\\.[0-9]+\\.[0-9]+)\""
        location: "package\\.json$"
        message: "Check for outdated dependencies in package.json. Regularly update dependencies to avoid known vulnerabilities."
        
      # Pattern 2: Direct CDN Links Without Integrity Hashes
      - pattern: "<script\\s+src=['\"]https?://(?:cdn|unpkg|jsdelivr)[^'\"]*['\"][^>]*(?!integrity=)"
        location: "\\.(html|js|jsx|ts|tsx)$"
        message: "CDN resources without integrity hashes. Add integrity and crossorigin attributes to script tags loading external resources."
        
      # Pattern 3: Hardcoded Library Versions in HTML
      - pattern: "<script\\s+src=['\"][^'\"]*(?:jquery|bootstrap|react|vue|angular|lodash|moment)[@-][0-9]+\\.[0-9]+\\.[0-9]+[^'\"]*['\"]"
        location: "\\.html$"
        message: "Hardcoded library versions in HTML. Consider using a package manager to manage dependencies."
        
      # Pattern 4: Deprecated Node.js APIs
      - pattern: "(?:new Buffer\\(|require\\(['\"]crypto['\"]\\)\\.createCipher\\(|require\\(['\"]crypto['\"]\\)\\.randomBytes\\([^,)]+\\)|require\\(['\"]fs['\"]\\)\\.exists\\()"
        message: "Using deprecated Node.js APIs. Replace with modern alternatives to avoid security and maintenance issues."
        
      # Pattern 5: Deprecated Browser APIs
      - pattern: "document\\.write\\(|document\\.execCommand\\(|escape\\(|unescape\\(|showModalDialog\\(|localStorage\\.clear\\(\\)|sessionStorage\\.clear\\(\\)"
        location: "(?:src|components|pages)"
        message: "Using deprecated browser APIs. Replace with modern alternatives to avoid compatibility and security issues."
        
      # Pattern 6: Insecure Dependency Loading
      - pattern: "require\\([^)]*?\\+\\s*[^)]+\\)|import\\([^)]*?\\+\\s*[^)]+\\)"
        message: "Dynamic dependency loading with variable concatenation. This can lead to dependency confusion attacks."
        
      # Pattern 7: Vulnerable Regular Expression Patterns (ReDoS)
      - pattern: "new RegExp\\([^)]*?(?:\\(.*\\)\\*|\\*\\+|\\+\\*|\\{\\d+,\\})"
        message: "Potentially vulnerable regular expression pattern that could lead to ReDoS attacks. Review and optimize the regex pattern."
        
      # Pattern 8: Insecure Package Installation
      - pattern: "npm\\s+install\\s+(?:--no-save|--no-audit|--no-fund|--force)"
        location: "(?:scripts|Dockerfile|docker-compose\\.yml|\\.github/workflows)"
        message: "Insecure package installation flags. Avoid using --no-audit, --no-save, or --force flags when installing packages."
        
      # Pattern 9: Missing Lock Files
      - pattern: "package\\.json"
        location: "package\\.json$"
        negative_pattern: "package-lock\\.json|yarn\\.lock|pnpm-lock\\.yaml"
        message: "Missing lock file. Use package-lock.json, yarn.lock, or pnpm-lock.yaml to ensure dependency consistency."
        
      # Pattern 10: Insecure Webpack Configuration
      - pattern: "webpack\\.config\\.js"
        location: "webpack\\.config\\.js$"
        negative_pattern: "(?:noEmitOnErrors|optimization\\.minimize)"
        message: "Potentially insecure webpack configuration. Consider enabling noEmitOnErrors and optimization.minimize."
        
      # Pattern 11: Outdated TypeScript Configuration
      - pattern: "\"compilerOptions\"\\s*:\\s*\\{[^}]*?\"target\"\\s*:\\s*\"ES5\""
        location: "tsconfig\\.json$"
        message: "Outdated TypeScript target. Consider using a more modern target like ES2020 for better security features."
        
      # Pattern 12: Insecure Package Sources
      - pattern: "registry\\s*=\\s*(?!https://registry\\.npmjs\\.org)"
        location: "\\.npmrc$"
        message: "Using a non-standard npm registry. Ensure you trust the source of your packages."
        
      # Pattern 13: Missing npm audit in CI/CD
      - pattern: "(?:ci|test|build)\\s*:\\s*\"[^\"]*?\""
        location: "package\\.json$"
        negative_pattern: "npm\\s+audit"
        message: "Missing npm audit in CI/CD scripts. Add 'npm audit' to your CI/CD pipeline to detect vulnerabilities."
        
      # Pattern 14: Insecure Import Maps
      - pattern: "<script\\s+type=['\"]importmap['\"][^>]*>[^<]*?\"imports\"\\s*:\\s*\\{[^}]*?\"[^\"]+\"\\s*:\\s*\"https?://[^\"]+\""
        negative_pattern: "integrity="
        message: "Insecure import maps without integrity checks. Add integrity hashes to import map entries."
        
      # Pattern 15: Outdated Polyfills
      - pattern: "(?:core-js|@babel/polyfill|es6-promise|whatwg-fetch)"
        message: "Using potentially outdated polyfills. Consider using modern alternatives or feature detection."

  - type: suggest
    message: |
      **JavaScript Vulnerable and Outdated Components Best Practices:**
      
      1. **Dependency Management:**
         - Regularly update dependencies to their latest secure versions
         - Use tools like npm audit, Snyk, or Dependabot to detect vulnerabilities
         - Example:
           ```javascript
           // Add these scripts to package.json
           {
             "scripts": {
               "audit": "npm audit",
               "audit:fix": "npm audit fix",
               "outdated": "npm outdated",
               "update": "npm update",
               "prestart": "npm audit --production"
             }
           }
           ```
      
      2. **Lock Files:**
         - Always use lock files (package-lock.json, yarn.lock, or pnpm-lock.yaml)
         - Commit lock files to version control
         - Example:
           ```bash
           # Generate a lock file if it doesn't exist
           npm install
           
           # Or for Yarn
           yarn
           
           # Or for pnpm
           pnpm install
           ```
      
      3. **Subresource Integrity:**
         - Use integrity hashes when loading resources from CDNs
         - Example:
           ```html
           <script 
             src="https://cdn.jsdelivr.net/npm/react@18.2.0/umd/react.production.min.js" 
             integrity="sha384-tMH8h3BGESGckSAVGZ82T9n90ztNepwCjSPJ0A7g2vdY8M0oKtDaDGg0G53cysJA" 
             crossorigin="anonymous">
           </script>
           ```
      
      4. **Automated Security Scanning:**
         - Integrate security scanning into your CI/CD pipeline
         - Example GitHub Actions workflow:
           ```yaml
           name: Security Scan
           
           on:
             push:
               branches: [ main ]
             pull_request:
               branches: [ main ]
             schedule:
               - cron: '0 0 * * 0'  # Run weekly
           
           jobs:
             security:
               runs-on: ubuntu-latest
               steps:
                 - uses: actions/checkout@v3
                 - name: Setup Node.js
                   uses: actions/setup-node@v3
                   with:
                     node-version: '18'
                     cache: 'npm'
                 - name: Install dependencies
                   run: npm ci
                 - name: Run security audit
                   run: npm audit --audit-level=high
                 - name: Run Snyk to check for vulnerabilities
                   uses: snyk/actions/node@master
                   env:
                     SNYK_TOKEN: ${{ secrets.SNYK_TOKEN }}
           ```
      
      5. **Dependency Pinning:**
         - Pin dependencies to specific versions to prevent unexpected updates
         - Example:
           ```json
           {
             "dependencies": {
               "express": "4.18.2",
               "react": "18.2.0",
               "lodash": "4.17.21"
             }
           }
           ```
      
      6. **Deprecated API Replacement:**
         - Replace deprecated Node.js APIs with modern alternatives
         - Example:
           ```javascript
           // INSECURE: Using deprecated Buffer constructor
           const buffer = new Buffer(data);
           
           // SECURE: Using Buffer.from()
           const buffer = Buffer.from(data);
           
           // INSECURE: Using deprecated crypto methods
           const crypto = require('crypto');
           const cipher = crypto.createCipher('aes-256-cbc', key);
           
           // SECURE: Using modern crypto methods
           const crypto = require('crypto');
           const iv = crypto.randomBytes(16);
           const cipher = crypto.createCipheriv('aes-256-cbc', key, iv);
           ```
      
      7. **Browser API Modernization:**
         - Replace deprecated browser APIs with modern alternatives
         - Example:
           ```javascript
           // INSECURE: Using document.write
           document.write('<h1>Hello World</h1>');
           
           // SECURE: Using DOM manipulation
           document.getElementById('content').innerHTML = '<h1>Hello World</h1>';
           
           // INSECURE: Using escape/unescape
           const encoded = escape(data);
           
           // SECURE: Using encodeURIComponent
           const encoded = encodeURIComponent(data);
           ```
      
      8. **Safe Dynamic Imports:**
         - Avoid dynamic imports with variable concatenation
         - Example:
           ```javascript
           // INSECURE: Dynamic import with concatenation
           const moduleName = userInput;
           import('./' + moduleName + '.js');
           
           // SECURE: Validate input against a whitelist
           const validModules = ['module1', 'module2', 'module3'];
           if (validModules.includes(moduleName)) {
             import(`./${moduleName}.js`);
           }
           ```
      
      9. **Regular Expression Safety:**
         - Avoid vulnerable regex patterns that could lead to ReDoS attacks
         - Example:
           ```javascript
           // INSECURE: Vulnerable regex pattern
           const regex = /^(a+)+$/;
           
           // SECURE: Optimized regex pattern
           const regex = /^a+$/;
           ```
      
      10. **Vendor Management:**
          - Evaluate the security posture of third-party libraries before use
          - Prefer libraries with active maintenance and security focus
          - Example evaluation criteria:
            - When was the last commit?
            - How quickly are security issues addressed?
            - Does the project have a security policy?
            - Is there a responsible disclosure process?
            - How many open issues and pull requests exist?
            - What is the download count and GitHub stars?
      
      11. **Runtime Dependency Checking:**
          - Implement runtime checks for critical dependencies
          - Example:
            ```javascript
            // Check package version at runtime for critical dependencies
            try {
              const packageJson = require('some-critical-package/package.json');
              const semver = require('semver');
              
              if (semver.lt(packageJson.version, '2.0.0')) {
                console.warn('Warning: Using a potentially vulnerable version of some-critical-package');
              }
            } catch (err) {
              console.error('Error checking package version:', err);
            }
            ```
      
      12. **Minimal Dependencies:**
          - Minimize the number of dependencies to reduce attack surface
          - Regularly audit and remove unused dependencies
          - Example:
            ```bash
            # Find unused dependencies
            npx depcheck
            
            # Analyze your bundle size
            npx webpack-bundle-analyzer
            ```

  - type: validate
    conditions:
      # Check 1: Using npm audit
      - pattern: "\"scripts\"\\s*:\\s*\\{[^}]*?\"audit\"\\s*:\\s*\"npm audit"
        message: "Using npm audit to check for vulnerabilities."
      
      # Check 2: Using lock files
      - pattern: "package-lock\\.json|yarn\\.lock|pnpm-lock\\.yaml"
        message: "Using lock files to ensure dependency consistency."
      
      # Check 3: Using integrity hashes
      - pattern: "integrity=['\"]sha\\d+-[A-Za-z0-9+/=]+['\"]"
        message: "Using subresource integrity hashes for external resources."
      
      # Check 4: Using modern Buffer API
      - pattern: "Buffer\\.(?:from|alloc|allocUnsafe)"
        message: "Using modern Buffer API instead of deprecated constructor."
      
      # Check 5: Using dependency scanning in CI
      - pattern: "npm\\s+audit|snyk\\s+test|yarn\\s+audit"
        location: "(?:\\.github/workflows|\\.gitlab-ci\\.yml|Jenkinsfile|azure-pipelines\\.yml)"
        message: "Integrating dependency scanning in CI/CD pipeline."

metadata:
  priority: high
  version: 1.0
  tags:
    - security
    - javascript
    - nodejs
    - browser
    - dependencies
    - owasp
    - language:javascript
    - framework:express
    - framework:react
    - framework:vue
    - framework:angular
    - category:security
    - subcategory:dependencies
    - standard:owasp-top10
    - risk:a06-vulnerable-outdated-components
  references:
    - "https://owasp.org/Top10/A06_2021-Vulnerable_and_Outdated_Components/"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Nodejs_Security_Cheat_Sheet.html"
    - "https://cheatsheetseries.owasp.org/cheatsheets/NPM_Security_Cheat_Sheet.html"
    - "https://docs.npmjs.com/cli/v8/commands/npm-audit"
    - "https://snyk.io/learn/npm-security/"
    - "https://developer.mozilla.org/en-US/docs/Web/Security/Subresource_Integrity"
    - "https://github.com/OWASP/NodeGoat"
    - "https://owasp.org/www-project-dependency-check/"
</rule> 
