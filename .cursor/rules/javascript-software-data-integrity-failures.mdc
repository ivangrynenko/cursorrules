---
description: Detect and prevent software and data integrity failures in JavaScript applications as defined in OWASP Top 10:2021-A08
globs: **/*.js, **/*.jsx, **/*.ts, **/*.tsx, !**/node_modules/**, !**/dist/**, !**/build/**, !**/coverage/**
---
# JavaScript Software and Data Integrity Failures (OWASP A08:2021)

<rule>
name: javascript_software_data_integrity_failures
description: Detect and prevent software and data integrity failures in JavaScript applications as defined in OWASP Top 10:2021-A08

actions:
  - type: enforce
    conditions:
      # Pattern 1: Insecure Deserialization
      - pattern: "(?:JSON\\.parse|eval)\\s*\\((?:[^)]|\\n)*(?:localStorage|sessionStorage|document\\.cookie|location|window\\.name|fetch|axios|\\$\\.(?:get|post)|XMLHttpRequest)"
        message: "Insecure deserialization of user-controlled data detected. Validate and sanitize data before parsing JSON or using eval."
        
      # Pattern 2: Missing Subresource Integrity
      - pattern: "<script\\s+src=['\"][^'\"]+['\"]\\s*>"
        negative_pattern: "integrity=['\"]sha(?:256|384|512)-[a-zA-Z0-9+/=]+"
        message: "Script tag without Subresource Integrity (SRI) hash. Add integrity and crossorigin attributes for third-party scripts."
        
      # Pattern 3: Insecure Package Installation
      - pattern: "(?:npm|yarn)\\s+(?:install|add)\\s+(?:[\\w@\\-\\.\\/:]+\\s+)*--no-(?:verify|integrity|signature)"
        message: "Package installation with integrity checks disabled. Always verify package integrity during installation."
        
      # Pattern 4: Insecure Object Deserialization
      - pattern: "(?:require|import)\\s+['\"](?:serialize-javascript|node-serialize|serialize|unserialize|deserialize)['\"]"
        message: "Using potentially unsafe serialization/deserialization libraries. Ensure proper validation and sanitization of serialized data."
        
      # Pattern 5: Missing Dependency Verification
      - pattern: "package\\.json"
        negative_pattern: "\"(?:scripts|devDependencies)\":\\s*{[^}]*\"(?:audit|verify|check)\":\\s*\"(?:npm|yarn)\\s+audit"
        file_pattern: "package\\.json$"
        message: "Missing dependency verification in package.json. Add npm/yarn audit to your scripts section."
        
      # Pattern 6: Insecure Dynamic Imports
      - pattern: "(?:import|require)\\s*\\(\\s*(?:variable|[a-zA-Z_$][a-zA-Z0-9_$]*|`[^`]*`|'[^']*'|\"[^\"]*\")\\s*\\)"
        negative_pattern: "(?:allowlist|whitelist|validate)"
        message: "Potentially insecure dynamic imports. Validate or restrict the modules that can be dynamically imported."
        
      # Pattern 7: Prototype Pollution
      - pattern: "Object\\.assign\\(\\s*(?:[^,]+)\\s*,\\s*(?:JSON\\.parse|req\\.body|req\\.query|req\\.params|formData\\.get)"
        message: "Potential prototype pollution vulnerability. Use Object.create(null) or sanitize objects before merging."
        
      # Pattern 8: Missing CI/CD Pipeline Integrity Checks
      - pattern: "(?:\\.github\\/workflows\\/|\\.gitlab-ci\\.yml|azure-pipelines\\.yml|Jenkinsfile)"
        negative_pattern: "(?:npm\\s+audit|yarn\\s+audit|checksum|integrity|verify|signature)"
        file_pattern: "(?:\\.github\\/workflows\\/.*\\.ya?ml|\\.gitlab-ci\\.yml|azure-pipelines\\.yml|Jenkinsfile)$"
        message: "Missing security checks in CI/CD pipeline. Add dependency scanning, integrity verification, and signature validation."
        
      # Pattern 9: Insecure Update Mechanism
      - pattern: "(?:update|upgrade|install)\\s*\\([^)]*\\)\\s*\\{[^}]*?\\}"
        negative_pattern: "(?:verify|checksum|hash|signature|integrity)"
        message: "Potentially insecure update mechanism. Implement integrity verification for all updates."
        
      # Pattern 10: Insecure Plugin Loading
      - pattern: "(?:plugin|addon|extension)\\.(?:load|register|install|add)\\s*\\([^)]*\\)"
        negative_pattern: "(?:verify|validate|checksum|hash|signature|integrity)"
        message: "Insecure plugin loading mechanism. Implement integrity verification for all plugins."
        
      # Pattern 11: Insecure Data Binding
      - pattern: "(?:eval|new\\s+Function|setTimeout|setInterval)\\s*\\(\\s*(?:[^,)]+\\.(?:value|innerHTML|innerText|textContent)|[^,)]+\\[[^\\]]+\\])"
        message: "Insecure data binding using eval or Function constructor. Use safer alternatives like JSON.parse or template literals."
        
      # Pattern 12: Insecure Object Property Assignment
      - pattern: "(?:Object\\.assign|\\{\\s*\\.\\.\\.)"
        negative_pattern: "Object\\.create\\(null\\)"
        message: "Potential prototype pollution in object assignment. Use Object.create(null) as the target object or sanitize inputs."
        
      # Pattern 13: Missing Lock File
      - pattern: "package\\.json"
        negative_pattern: "package-lock\\.json|yarn\\.lock"
        file_pattern: "package\\.json$"
        message: "Missing lock file for dependency management. Include package-lock.json or yarn.lock in version control."
        
      # Pattern 14: Insecure Webpack Configuration
      - pattern: "webpack\\.config\\.js"
        negative_pattern: "(?:integrity|sri|subresource|hash|checksum)"
        file_pattern: "webpack\\.config\\.js$"
        message: "Webpack configuration without integrity checks. Consider enabling SRI for generated assets."
        
      # Pattern 15: Insecure npm/yarn Configuration
      - pattern: "\\.npmrc|\\.yarnrc"
        negative_pattern: "(?:verify-store|integrity|signature)"
        file_pattern: "(?:\\.npmrc|\\.yarnrc)$"
        message: "npm/yarn configuration with potentially disabled security features. Ensure integrity checks are enabled."

  - type: suggest
    message: |
      **JavaScript Software and Data Integrity Failures Best Practices:**
      
      1. **Secure Deserialization:**
         - Validate and sanitize data before deserialization
         - Use schema validation for JSON data
         - Example:
           ```javascript
           import Ajv from 'ajv';
           
           // Define a schema for expected data
           const schema = {
             type: 'object',
             properties: {
               id: { type: 'integer' },
               name: { type: 'string' },
               role: { type: 'string', enum: ['user', 'admin'] }
             },
             required: ['id', 'name', 'role'],
             additionalProperties: false
           };
           
           // Validate data before parsing
           function safelyParseJSON(data) {
             try {
               const parsed = JSON.parse(data);
               const ajv = new Ajv();
               const validate = ajv.compile(schema);
               
               if (validate(parsed)) {
                 return { valid: true, data: parsed };
               } else {
                 return { valid: false, errors: validate.errors };
               }
             } catch (error) {
               return { valid: false, errors: [error.message] };
             }
           }
           ```
      
      2. **Subresource Integrity (SRI):**
         - Add integrity hashes to external scripts and stylesheets
         - Example:
           ```html
           <script 
             src="https://cdn.example.com/library.js" 
             integrity="sha384-oqVuAfXRKap7fdgcCY5uykM6+R9GqQ8K/uxy9rx7HNQlGYl1kPzQho1wx4JwY8wC" 
             crossorigin="anonymous">
           </script>
           ```
           
           ```javascript
           // Programmatically adding a script with SRI
           function addScriptWithIntegrity(url, integrity) {
             const script = document.createElement('script');
             script.src = url;
             script.integrity = integrity;
             script.crossOrigin = 'anonymous';
             document.head.appendChild(script);
           }
           ```
      
      3. **Dependency Verification:**
         - Use npm/yarn audit regularly
         - Implement lockfiles and version pinning
         - Example:
           ```json
           // package.json
           {
             "scripts": {
               "audit": "npm audit --production",
               "preinstall": "npm audit",
               "verify": "npm audit && npm outdated"
             }
           }
           ```
           
           ```javascript
           // Automated dependency verification in CI/CD
           // .github/workflows/security.yml
           // name: Security Checks
           // on: [push, pull_request]
           // jobs:
           //   security:
           //     runs-on: ubuntu-latest
           //     steps:
           //       - uses: actions/checkout@v3
           //       - uses: actions/setup-node@v3
           //         with:
           //           node-version: '16'
           //       - run: npm audit
           ```
      
      4. **Secure Object Handling:**
         - Prevent prototype pollution
         - Use Object.create(null) for empty objects
         - Example:
           ```javascript
           // Prevent prototype pollution
           function safeObjectMerge(target, source) {
             // Start with a null prototype object
             const result = Object.create(null);
             
             // Copy properties from target
             for (const key in target) {
               if (Object.prototype.hasOwnProperty.call(target, key) && 
                   key !== '__proto__' && 
                   key !== 'constructor' && 
                   key !== 'prototype') {
                 result[key] = target[key];
               }
             }
             
             // Copy properties from source
             for (const key in source) {
               if (Object.prototype.hasOwnProperty.call(source, key) && 
                   key !== '__proto__' && 
                   key !== 'constructor' && 
                   key !== 'prototype') {
                 result[key] = source[key];
               }
             }
             
             return result;
           }
           ```
      
      5. **Secure Dynamic Imports:**
         - Validate module paths before importing
         - Use allowlists for dynamic imports
         - Example:
           ```javascript
           // Allowlist-based dynamic imports
           const ALLOWED_MODULES = [
             './components/header',
             './components/footer',
             './components/sidebar'
           ];
           
           async function safeImport(modulePath) {
             if (!ALLOWED_MODULES.includes(modulePath)) {
               throw new Error(`Module ${modulePath} is not in the allowlist`);
             }
             
             try {
               return await import(modulePath);
             } catch (error) {
               console.error(`Failed to import ${modulePath}:`, error);
               throw error;
             }
           }
           ```
      
      6. **CI/CD Pipeline Security:**
         - Implement integrity checks in build pipelines
         - Verify dependencies and artifacts
         - Example:
           ```yaml
           # .github/workflows/build.yml
           name: Build and Verify
           on: [push, pull_request]
           jobs:
             build:
               runs-on: ubuntu-latest
               steps:
                 - uses: actions/checkout@v3
                 - uses: actions/setup-node@v3
                   with:
                     node-version: '16'
                 - name: Install dependencies
                   run: npm ci
                 - name: Security audit
                   run: npm audit
                 - name: Build
                   run: npm run build
                 - name: Generate integrity hashes
                   run: |
                     cd dist
                     find . -type f -name "*.js" -exec sh -c 'echo "{}" $(sha384sum "{}" | cut -d " " -f 1)' \; > integrity.txt
                 - name: Upload artifacts with integrity manifest
                   uses: actions/upload-artifact@v3
                   with:
                     name: build-artifacts
                     path: |
                       dist
                       dist/integrity.txt
           ```
      
      7. **Secure Update Mechanisms:**
         - Verify integrity of updates before applying
         - Use digital signatures when possible
         - Example:
           ```javascript
           import crypto from 'crypto';
           import fs from 'fs';
           
           async function verifyUpdate(updateFile, signatureFile, publicKeyFile) {
             try {
               const updateData = fs.readFileSync(updateFile);
               const signature = fs.readFileSync(signatureFile);
               const publicKey = fs.readFileSync(publicKeyFile);
               
               const verify = crypto.createVerify('SHA256');
               verify.update(updateData);
               
               const isValid = verify.verify(publicKey, signature);
               
               if (!isValid) {
                 throw new Error('Update signature verification failed');
               }
               
               return { valid: true, data: updateData };
             } catch (error) {
               console.error('Update verification failed:', error);
               return { valid: false, error: error.message };
             }
           }
           ```
      
      8. **Plugin/Extension Security:**
         - Implement allowlists for plugins
         - Verify plugin integrity before loading
         - Example:
           ```javascript
           class PluginManager {
             constructor() {
               this.plugins = new Map();
               this.allowedPlugins = new Set(['logger', 'analytics', 'theme']);
             }
             
             async registerPlugin(name, pluginPath, expectedHash) {
               if (!this.allowedPlugins.has(name)) {
                 throw new Error(`Plugin ${name} is not in the allowlist`);
               }
               
               // Verify plugin integrity
               const pluginCode = await fetch(pluginPath).then(r => r.text());
               const hash = crypto.createHash('sha256').update(pluginCode).digest('hex');
               
               if (hash !== expectedHash) {
                 throw new Error(`Plugin integrity check failed for ${name}`);
               }
               
               // Safe loading using Function constructor instead of eval
               // Still has security implications but better than direct eval
               const sandboxedPlugin = new Function('exports', 'require', pluginCode);
               const exports = {};
               const safeRequire = (module) => {
                 // Implement a restricted require function
                 const allowedModules = ['lodash', 'dayjs'];
                 if (!allowedModules.includes(module)) {
                   throw new Error(`Module ${module} is not allowed in plugins`);
                 }
                 return require(module);
               };
               
               sandboxedPlugin(exports, safeRequire);
               this.plugins.set(name, exports);
               return exports;
             }
           }
           ```
      
      9. **Secure Data Binding:**
         - Avoid eval() and new Function()
         - Use template literals or frameworks with safe binding
         - Example:
           ```javascript
           // Unsafe:
           // function updateElement(id, data) {
           //   const element = document.getElementById(id);
           //   element.innerHTML = eval('`' + template + '`'); // DANGEROUS!
           // }
           
           // Safe alternative:
           function updateElement(id, data) {
             const element = document.getElementById(id);
             
             // Use a template literal with explicit interpolation
             const template = `<div class="user-card">
               <h2>${escapeHTML(data.name)}</h2>
               <p>${escapeHTML(data.bio)}</p>
             </div>`;
             
             element.innerHTML = template;
           }
           
           function escapeHTML(str) {
             return str
               .replace(/&/g, '&amp;')
               .replace(/</g, '&lt;')
               .replace(/>/g, '&gt;')
               .replace(/"/g, '&quot;')
               .replace(/'/g, '&#039;');
           }
           ```
      
      10. **Secure Configuration Management:**
          - Validate configurations before use
          - Use schema validation for config files
          - Example:
            ```javascript
            import Ajv from 'ajv';
            import fs from 'fs';
            
            function loadAndValidateConfig(configPath) {
              // Define schema for configuration
              const configSchema = {
                type: 'object',
                properties: {
                  server: {
                    type: 'object',
                    properties: {
                      port: { type: 'integer', minimum: 1024, maximum: 65535 },
                      host: { type: 'string', format: 'hostname' }
                    },
                    required: ['port', 'host']
                  },
                  database: {
                    type: 'object',
                    properties: {
                      url: { type: 'string' },
                      maxConnections: { type: 'integer', minimum: 1 }
                    },
                    required: ['url']
                  }
                },
                required: ['server', 'database'],
                additionalProperties: false
              };
              
              try {
                const configData = fs.readFileSync(configPath, 'utf8');
                const config = JSON.parse(configData);
                
                const ajv = new Ajv({ allErrors: true });
                const validate = ajv.compile(configSchema);
                
                if (validate(config)) {
                  return { valid: true, config };
                } else {
                  return { valid: false, errors: validate.errors };
                }
              } catch (error) {
                return { valid: false, errors: [error.message] };
              }
            }
            ```
      
      11. **Secure Webpack Configuration:**
          - Enable SRI in webpack
          - Use content hashing for cache busting
          - Example:
            ```javascript
            // webpack.config.js
            const SubresourceIntegrityPlugin = require('webpack-subresource-integrity');
            
            module.exports = {
              output: {
                filename: '[name].[contenthash].js',
                crossOriginLoading: 'anonymous' // Required for SRI
              },
              plugins: [
                new SubresourceIntegrityPlugin({
                  hashFuncNames: ['sha384'],
                  enabled: process.env.NODE_ENV === 'production'
                })
              ]
            };
            ```
      
      12. **Secure npm/yarn Configuration:**
          - Enable integrity checks
          - Use lockfiles and exact versions
          - Example:
            ```
            # .npmrc
            audit=true
            audit-level=moderate
            save-exact=true
            verify-store=true
            
            # .yarnrc.yml
            enableStrictSsl: true
            enableImmutableInstalls: true
            checksumBehavior: "throw"
            ```
      
      13. **Secure JSON Parsing:**
          - Use reviver functions with JSON.parse
          - Example:
            ```javascript
            function parseUserData(data) {
              return JSON.parse(data, (key, value) => {
                // Sanitize specific fields
                if (key === 'role' && !['user', 'admin', 'editor'].includes(value)) {
                  return 'user'; // Default to safe value
                }
                
                // Prevent Date objects from being reconstructed from strings
                if (typeof value === 'string' && 
                    /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z$/.test(value)) {
                  // Return as string, not Date object
                  return value;
                }
                
                return value;
              });
            }
            ```
      
      14. **Content Security Policy (CSP):**
          - Implement strict CSP headers
          - Use nonce-based CSP for inline scripts
          - Example:
            ```javascript
            // Express.js example
            import crypto from 'crypto';
            import helmet from 'helmet';
            
            app.use((req, res, next) => {
              // Generate a new nonce for each request
              res.locals.cspNonce = crypto.randomBytes(16).toString('base64');
              next();
            });
            
            app.use(helmet.contentSecurityPolicy({
              directives: {
                defaultSrc: ["'self'"],
                scriptSrc: [
                  "'self'",
                  (req, res) => `'nonce-${res.locals.cspNonce}'`,
                  'https://cdn.jsdelivr.net'
                ],
                styleSrc: ["'self'", 'https://cdn.jsdelivr.net'],
                // Add other directives as needed
              }
            }));
            
            // In your template engine, use the nonce:
            // <script nonce="<%= cspNonce %>">
            //   // Inline JavaScript
            // </script>
            ```
      
      15. **Secure Local Storage:**
          - Validate data before storing and after retrieving
          - Consider encryption for sensitive data
          - Example:
            ```javascript
            // Simple encryption/decryption for localStorage
            // Note: This is still client-side and not fully secure
            class SecureStorage {
              constructor(secret) {
                this.secret = secret;
              }
              
              // Set item with validation and encryption
              setItem(key, value, schema) {
                // Validate with schema if provided
                if (schema) {
                  const ajv = new Ajv();
                  const validate = ajv.compile(schema);
                  if (!validate(value)) {
                    throw new Error(`Invalid data for ${key}: ${ajv.errorsText(validate.errors)}`);
                  }
                }
                
                // Simple encryption (not for truly sensitive data)
                const valueStr = JSON.stringify(value);
                const encrypted = this.encrypt(valueStr);
                localStorage.setItem(key, encrypted);
              }
              
              // Get item with decryption and validation
              getItem(key, schema) {
                const encrypted = localStorage.getItem(key);
                if (!encrypted) return null;
                
                try {
                  const decrypted = this.decrypt(encrypted);
                  const value = JSON.parse(decrypted);
                  
                  // Validate with schema if provided
                  if (schema) {
                    const ajv = new Ajv();
                    const validate = ajv.compile(schema);
                    if (!validate(value)) {
                      console.error(`Retrieved invalid data for ${key}`);
                      return null;
                    }
                  }
                  
                  return value;
                } catch (error) {
                  console.error(`Failed to retrieve ${key}:`, error);
                  return null;
                }
              }
              
              // Simple XOR encryption (not for production use with sensitive data)
              encrypt(text) {
                let result = '';
                for (let i = 0; i < text.length; i++) {
                  result += String.fromCharCode(text.charCodeAt(i) ^ this.secret.charCodeAt(i % this.secret.length));
                }
                return btoa(result);
              }
              
              decrypt(encoded) {
                const text = atob(encoded);
                let result = '';
                for (let i = 0; i < text.length; i++) {
                  result += String.fromCharCode(text.charCodeAt(i) ^ this.secret.charCodeAt(i % this.secret.length));
                }
                return result;
              }
            }
            ```

  - type: validate
    conditions:
      # Check 1: Subresource Integrity
      - pattern: "<script\\s+[^>]*?integrity=['\"]sha(?:256|384|512)-[a-zA-Z0-9+/=]+['\"][^>]*?>"
        message: "Using Subresource Integrity (SRI) for external scripts."
      
      # Check 2: Dependency Verification
      - pattern: "\"scripts\":\\s*{[^}]*\"(?:audit|verify|check)\":\\s*\"(?:npm|yarn)\\s+audit"
        message: "Implementing dependency verification in package.json scripts."
      
      # Check 3: Lock File Usage
      - pattern: "(?:package-lock\\.json|yarn\\.lock)"
        file_pattern: "(?:package-lock\\.json|yarn\\.lock)$"
        message: "Using lock files for dependency management."
      
      # Check 4: Safe Object Creation
      - pattern: "Object\\.create\\(null\\)"
        message: "Using Object.create(null) to prevent prototype pollution."
      
      # Check 5: Schema Validation
      - pattern: "(?:ajv|joi|yup|zod|jsonschema|validate)"
        message: "Implementing schema validation for data integrity."

metadata:
  priority: high
  version: 1.0
  tags:
    - security
    - javascript
    - nodejs
    - browser
    - integrity
    - owasp
    - language:javascript
    - framework:express
    - framework:react
    - framework:vue
    - framework:angular
    - category:security
    - subcategory:integrity
    - standard:owasp-top10
    - risk:a08-software-data-integrity-failures
  references:
    - "https://owasp.org/Top10/A08_2021-Software_and_Data_Integrity_Failures/"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Deserialization_Cheat_Sheet.html"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Third_Party_Javascript_Management_Cheat_Sheet.html"
    - "https://developer.mozilla.org/en-US/docs/Web/Security/Subresource_Integrity"
    - "https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/11-Client-side_Testing/13-Testing_for_Subresource_Integrity"
    - "https://snyk.io/blog/prototype-pollution-javascript/"
    - "https://github.com/OWASP/CheatSheetSeries/blob/master/cheatsheets/NPM_Security_Cheat_Sheet.md"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Content_Security_Policy_Cheat_Sheet.html"
    - "https://owasp.org/www-community/attacks/Prototype_pollution"
</rule> 
