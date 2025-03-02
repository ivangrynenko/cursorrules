---
description: Detect and prevent Server-Side Request Forgery (SSRF) vulnerabilities in JavaScript applications as defined in OWASP Top 10:2021-A10
globs: **/*.js, **/*.jsx, **/*.ts, **/*.tsx, !**/node_modules/**, !**/dist/**, !**/build/**, !**/coverage/**
---
# JavaScript Server-Side Request Forgery (OWASP A10:2021)

<rule>
name: javascript_server_side_request_forgery
description: Detect and prevent Server-Side Request Forgery (SSRF) vulnerabilities in JavaScript applications as defined in OWASP Top 10:2021-A10

actions:
  - type: enforce
    conditions:
      # Pattern 1: URL from User Input
      - pattern: "(fetch|axios\\.get|axios\\.post|axios\\.put|axios\\.delete|axios\\.patch|http\\.get|http\\.request|https\\.get|https\\.request|\\$\\.ajax|XMLHttpRequest|got|request|superagent|needle)\\s*\\([^)]*(?:\\$_GET|\\$_POST|\\$_REQUEST|req\\.(?:body|query|params)|request\\.(?:body|query|params)|event\\.(?:body|queryStringParameters|pathParameters)|params|userInput|data\\["
        message: "Potential SSRF vulnerability: URL constructed from user input. Implement URL validation, allowlisting, or use a URL parser library to validate and sanitize user-provided URLs."
        
      # Pattern 2: Dynamic URL in HTTP Request
      - pattern: "(fetch|axios|http\\.get|http\\.request|https\\.get|https\\.request|\\$\\.ajax|XMLHttpRequest|got|request|superagent|needle)\\s*\\(\\s*['\"`]https?:\\/\\/[^'\"`]*['\"`]\\s*\\+\\s*"
        message: "Potential SSRF vulnerability: Dynamic URL in HTTP request. Use URL parsing and validation before making the request."
        
      # Pattern 3: URL Redirection Without Validation
      - pattern: "(res\\.redirect|res\\.location|window\\.location|location\\.href|location\\.replace|location\\.assign|location\\.port|history\\.pushState|history\\.replaceState)\\s*\\([^)]*(?:req\\.(?:query|body|params)|request\\.(?:query|body|params)|userInput)"
        message: "URL redirection without proper validation may lead to SSRF. Implement strict validation for URLs before redirecting."
        
      # Pattern 4: Direct IP Address Usage
      - pattern: "(fetch|axios\\.get|axios\\.post|axios\\.put|axios\\.delete|axios\\.patch|http\\.get|http\\.request|https\\.get|https\\.request)\\s*\\(\\s*['\"`]https?:\\/\\/\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}"
        message: "Direct use of IP addresses in requests may bypass hostname-based restrictions. Consider using allowlisted hostnames instead."
        
      # Pattern 5: Local Network Access
      - pattern: "(fetch|axios\\.get|axios\\.post|axios\\.put|axios\\.delete|axios\\.patch|http\\.get|http\\.request|https\\.get|https\\.request)\\s*\\(\\s*['\"`]https?:\\/\\/(?:localhost|127\\.0\\.0\\.1|0\\.0\\.0\\.0|192\\.168\\.|10\\.|172\\.(?:1[6-9]|2[0-9]|3[0-1])\\.|::1)"
        message: "Request to internal network address detected. Restrict access to internal resources to prevent SSRF attacks."
        
      # Pattern 6: File Protocol Usage
      - pattern: "(fetch|axios\\.get|axios\\.post|axios\\.put|axios\\.delete|axios\\.patch|http\\.get|http\\.request|https\\.get|https\\.request)\\s*\\(\\s*['\"`]file:\\/\\/"
        message: "Use of file:// protocol may lead to local file access. Block or restrict file:// protocol usage."
        
      # Pattern 7: Missing URL Validation
      - pattern: "(fetch|axios\\.get|axios\\.post|axios\\.put|axios\\.delete|axios\\.patch|http\\.get|http\\.request|https\\.get|https\\.request)\\s*\\([^)]*\\burl\\b[^)]*\\)"
        negative_pattern: "(validat|sanitiz|check|parse).*\\burl\\b|allowlist|whitelist|URL\\.(parse|canParse)|new URL\\(|isValidURL"
        message: "HTTP request without URL validation. Implement URL validation before making external requests."
        
      # Pattern 8: HTTP Request in User-Defined Function
      - pattern: "function\\s+[a-zA-Z0-9_]*(?:request|fetch|get|http|curl)\\s*\\([^)]*\\)\\s*\\{[^}]*(?:fetch|axios|http\\.get|http\\.request|https\\.get|https\\.request)"
        negative_pattern: "(validat|sanitiz|check|parse).*\\burl\\b|allowlist|whitelist|new URL\\(|isValidURL"
        message: "User-defined HTTP request function without URL validation. Implement proper URL validation and sanitization."
        
      # Pattern 9: Proxy Functionality
      - pattern: "(?:proxy|forward|relay).*(?:req\\.(?:url|path)|request\\.(?:url|path))"
        negative_pattern: "(validat|sanitiz|check|parse).*\\burl\\b|allowlist|whitelist"
        message: "Proxy or request forwarding functionality detected. Implement strict URL validation and allowlisting."
        
      # Pattern 10: Alternative HTTP Methods
      - pattern: "(fetch|axios)\\s*\\([^)]*method\\s*:\\s*['\"`](?:GET|POST|PUT|DELETE|PATCH|OPTIONS|HEAD)['\"`]"
        negative_pattern: "(validat|sanitiz|check|parse).*\\burl\\b|allowlist|whitelist|new URL\\(|isValidURL"
        message: "HTTP request with explicit method without URL validation. Implement URL validation for all HTTP methods."
        
      # Pattern 11: URL Building from Parts
      - pattern: "new URL\\s*\\((?:[^,)]+,\\s*){1,}(?:req\\.(?:body|query|params)|request\\.(?:body|query|params)|userinput)"
        message: "Building URL with user input. Validate and sanitize all URL components and use an allowlist for base URLs."
        
      # Pattern 12: Protocol-Relative URLs
      - pattern: "(fetch|axios)\\s*\\(['\"`]\\/\\/[^'\"`]+['\"`]"
        message: "Protocol-relative URL usage may lead to SSRF. Always specify the protocol and validate URLs."
        
      # Pattern 13: Express-like Route with URL Parameter
      - pattern: "app\\.(?:get|post|put|delete|patch)\\s*\\(['\"`][^'\"`]*\\/:[a-zA-Z0-9_]+(?:\\/|['\"`])"
        negative_pattern: "(validat|sanitiz|check|parse).*\\burl\\b|allowlist|whitelist|new URL\\(|isValidURL"
        message: "Route with dynamic parameter that might be used in URL construction. Ensure proper validation before making any HTTP requests within this route handler."
        
      # Pattern 14: URL Parsing without Validation
      - pattern: "URL\\.parse\\s*\\(|new URL\\s*\\("
        negative_pattern: "try\\s*\\{|catch\\s*\\(|validat|sanitiz|check"
        message: "URL parsing without validation or error handling. Implement proper error handling and validation for URL parsing."
        
      # Pattern 15: Service Discovery / Cloud Metadata Access
      - pattern: "(fetch|axios\\.get|http\\.get)\\s*\\(['\"`]https?:\\/\\/(?:169\\.254\\.169\\.254|fd00:ec2|metadata\\.google|metadata\\.azure|169\\.254\\.169\\.254\\/latest\\/meta-data)"
        message: "Access to cloud service metadata endpoints detected. Restrict access to cloud metadata services to prevent server information disclosure."

  - type: suggest
    message: |
      **JavaScript Server-Side Request Forgery (SSRF) Prevention Best Practices:**
      
      1. **Implement URL Validation and Sanitization:**
         - Use built-in URL parsing libraries to validate URLs
         - Validate both the URL format and components
         - Example:
           ```javascript
           function isValidUrl(url) {
             try {
               const parsedUrl = new URL(url);
               // Check protocol is http: or https:
               if (!/^https?:$/.test(parsedUrl.protocol)) {
                 return false;
               }
               // Additional validation logic here
               return true;
             } catch (error) {
               // Invalid URL format
               return false;
             }
           }
           
           // Usage
           const userProvidedUrl = req.body.targetUrl;
           if (!isValidUrl(userProvidedUrl)) {
             return res.status(400).json({ error: 'Invalid URL format or protocol' });
           }
           
           // Now make the request with the validated URL
           ```
      
      2. **Implement Strict Allowlisting:**
         - Define allowlist of permitted domains and endpoints
         - Reject requests to any domains not on the allowlist
         - Example:
           ```javascript
           const ALLOWED_DOMAINS = [
             'api.example.com',
             'cdn.example.com',
             'partner-api.trusted-domain.com'
           ];
           
           function isAllowedDomain(url) {
             try {
               const parsedUrl = new URL(url);
               return ALLOWED_DOMAINS.includes(parsedUrl.hostname);
             } catch (error) {
               return false;
             }
           }
           
           // Usage
           const targetUrl = req.body.webhookUrl;
           if (!isAllowedDomain(targetUrl)) {
             logger.warn({
               message: 'SSRF attempt blocked: domain not in allowlist',
               url: targetUrl,
               ip: req.ip,
               userId: req.user?.id
             });
             return res.status(403).json({ error: 'Domain not allowed' });
           }
           ```
      
      3. **Block Access to Internal Networks:**
         - Prevent requests to private IP ranges
         - Block localhost and internal hostnames
         - Example:
           ```javascript
           function isInternalHostname(hostname) {
             // Check for localhost and common internal hostnames
             if (hostname === 'localhost' || hostname.endsWith('.local') || hostname.endsWith('.internal')) {
               return true;
             }
             return false;
           }
           
           function isPrivateIP(ip) {
             // Check for private IP ranges
             const privateRanges = [
               /^127\./,                     // 127.0.0.0/8
               /^10\./,                      // 10.0.0.0/8
               /^172\.(1[6-9]|2[0-9]|3[0-1])\./, // 172.16.0.0/12
               /^192\.168\./,                // 192.168.0.0/16
               /^169\.254\./,                // 169.254.0.0/16
               /^::1$/,                      // localhost IPv6
               /^f[cd][0-9a-f]{2}:/i,        // fc00::/7 unique local IPv6
               /^fe80:/i                     // fe80::/10 link-local IPv6
             ];
             
             return privateRanges.some(range => range.test(ip));
           }
           
           function isUrlSafe(url) {
             try {
               const parsedUrl = new URL(url);
               
               // Block internal hostnames
               if (isInternalHostname(parsedUrl.hostname)) {
                 return false;
               }
               
               // Resolve hostname to IP (in real implementation, use async DNS resolution)
               // This example is simplified - in production you would use DNS resolution
               let ip;
               try {
                 // Note: This is a pseudo-code example
                 // In real code, you'd use a DNS resolution library
                 ip = dnsResolve(parsedUrl.hostname);
                 
                 // Block private IPs
                 if (isPrivateIP(ip)) {
                   return false;
                 }
               } catch (error) {
                 // If DNS resolution fails, err on the side of caution
                 return false;
               }
               
               return true;
             } catch (error) {
               return false;
             }
           }
           ```
      
      4. **Disable Dangerous URL Protocols:**
         - Restrict allowed URL protocols to HTTP and HTTPS
         - Block file://, ftp://, gopher://, etc.
         - Example:
           ```javascript
           function hasAllowedProtocol(url) {
             try {
               const parsedUrl = new URL(url);
               const allowedProtocols = ['http:', 'https:'];
               return allowedProtocols.includes(parsedUrl.protocol);
             } catch (error) {
               return false;
             }
           }
           
           // Usage
           const targetUrl = req.body.documentUrl;
           if (!hasAllowedProtocol(targetUrl)) {
             logger.warn({
               message: 'SSRF attempt blocked: disallowed protocol',
               url: targetUrl,
               protocol: new URL(targetUrl).protocol,
               ip: req.ip
             });
             return res.status(403).json({ error: 'URL protocol not allowed' });
           }
           ```
      
      5. **Implement Network-Level Protection:**
         - Use firewall rules to block outbound requests to internal networks
         - Configure proxy servers to restrict external requests
         - Example:
           ```javascript
           // Using a proxy for outbound requests
           const axios = require('axios');
           const HttpsProxyAgent = require('https-proxy-agent');
           
           // Configure proxy with appropriate controls
           const httpsAgent = new HttpsProxyAgent({
             host: 'proxy.example.com',
             port: 3128,
             // This proxy should be configured to block access to internal networks
           });
           
           // Make requests through the proxy
           async function secureExternalRequest(url) {
             try {
               const response = await axios.get(url, {
                 httpsAgent,
                 timeout: 5000, // Set reasonable timeout
                 maxRedirects: 2 // Limit redirects
               });
               return response.data;
             } catch (error) {
               logger.error({
                 message: 'External request failed',
                 url,
                 error: error.message
               });
               throw new Error('Failed to fetch external resource');
             }
           }
           ```
      
      6. **Use Service-Specific Endpoints:**
         - Instead of passing full URLs, use service identifiers
         - Map identifiers to URLs on the server side
         - Example:
           ```javascript
           // Client makes request with service identifier, not raw URL
           app.get('/proxy-service/:serviceId', async (req, res) => {
             const { serviceId } = req.params;
             
             // Service mapping defined server-side
             const serviceMap = {
               'weather-api': 'https://api.weather.example.com/current',
               'news-feed': 'https://api.news.example.com/feed',
               'product-info': 'https://api.products.example.com/details'
             };
             
             // Check if service is defined
             if (!serviceMap[serviceId]) {
               return res.status(404).json({ error: 'Service not found' });
             }
             
             try {
               // Make request to mapped URL (not user-controlled)
               const response = await axios.get(serviceMap[serviceId]);
               return res.json(response.data);
             } catch (error) {
               return res.status(500).json({ error: 'Service request failed' });
             }
           });
           ```
      
      7. **Implement Context-Specific Encodings:**
         - Use context-appropriate encoding for URL parameters
         - Don't rely solely on standard URL encoding
         - Example:
           ```javascript
           function safeUrl(baseUrl, params) {
             // Start with a verified base URL
             const url = new URL(baseUrl);
             
             // Add parameters safely
             for (const [key, value] of Object.entries(params)) {
               // Ensure values are strings and properly encoded
               url.searchParams.append(key, String(value));
             }
             
             // Verify the final URL is still valid
             if (!isAllowedDomain(url.toString())) {
               throw new Error('URL creation resulted in disallowed domain');
             }
             
             return url.toString();
           }
           
           // Usage
           try {
             const apiUrl = safeUrl('https://api.example.com/data', {
               id: userId,
               format: 'json'
             });
             const response = await axios.get(apiUrl);
             // Process response
           } catch (error) {
             // Handle error
           }
           ```
      
      8. **Use Defense in Depth:**
         - Combine multiple validation strategies
         - Don't rely on a single protection measure
         - Example:
           ```javascript
           async function secureExternalRequest(url, options = {}) {
             // 1. Validate URL format
             if (!isValidUrl(url)) {
               throw new Error('Invalid URL format');
             }
             
             // 2. Check against allowlist
             if (!isAllowedDomain(url)) {
               throw new Error('Domain not in allowlist');
             }
             
             // 3. Verify not internal network
             const parsedUrl = new URL(url);
             if (await isInternalNetwork(parsedUrl.hostname)) {
               throw new Error('Access to internal networks not allowed');
             }
             
             // 4. Validate protocol
             if (!hasAllowedProtocol(url)) {
               throw new Error('Protocol not allowed');
             }
             
             // 5. Set additional security headers and options
             const secureOptions = {
               ...options,
               timeout: options.timeout || 5000,
               maxRedirects: options.maxRedirects || 2,
               headers: {
                 ...options.headers,
                 'User-Agent': 'SecureApp/1.0'
               }
             };
             
             // 6. Make request with all validations passed
             try {
               return await axios(url, secureOptions);
             } catch (error) {
               logger.error({
                 message: 'Secure external request failed',
                 url,
                 error: error.message
               });
               throw new Error('External request failed');
             }
           }
           ```
      
      9. **Validate and Sanitize Request Parameters:**
         - Don't trust any user-supplied input for URL construction
         - Validate all components used in URL building
         - Example:
           ```javascript
           // API that fetches weather data for a city
           app.get('/api/weather', async (req, res) => {
             const { city } = req.query;
             
             // 1. Validate parameter exists and is valid
             if (!city || typeof city !== 'string' || city.length > 100) {
               return res.status(400).json({ error: 'Invalid city parameter' });
             }
             
             // 2. Sanitize the parameter
             const sanitizedCity = encodeURIComponent(city.trim());
             
             // 3. Construct URL with validated parameter
             const weatherApiUrl = `https://api.weather.example.com/current?city=${sanitizedCity}`;
             
             // 4. Additional validation of the final URL
             if (!isValidUrl(weatherApiUrl)) {
               return res.status(400).json({ error: 'Invalid URL construction' });
             }
             
             try {
               const response = await axios.get(weatherApiUrl);
               return res.json(response.data);
             } catch (error) {
               logger.error({
                 message: 'Weather API request failed',
                 city,
                 error: error.message
               });
               return res.status(500).json({ error: 'Failed to fetch weather data' });
             }
           });
           ```
      
      10. **Implement Request Timeouts:**
          - Set appropriate timeouts for all HTTP requests
          - Prevent long-running SSRF probes
          - Example:
            ```javascript
            async function fetchWithTimeout(url, options = {}) {
              // Default timeout of 5 seconds
              const timeout = options.timeout || 5000;
              
              // Create an abort controller to handle timeout
              const controller = new AbortController();
              const timeoutId = setTimeout(() => controller.abort(), timeout);
              
              try {
                const response = await fetch(url, {
                  ...options,
                  signal: controller.signal
                });
                
                clearTimeout(timeoutId);
                return response;
              } catch (error) {
                clearTimeout(timeoutId);
                if (error.name === 'AbortError') {
                  throw new Error(`Request timed out after ${timeout}ms`);
                }
                throw error;
              }
            }
            
            // Usage
            try {
              const response = await fetchWithTimeout('https://api.example.com/data', {
                timeout: 3000, // 3 seconds timeout
                headers: { 'Content-Type': 'application/json' }
              });
              const data = await response.json();
              // Process data
            } catch (error) {
              console.error('Request failed:', error.message);
            }
            ```
      
      11. **Rate Limit External Requests:**
          - Implement rate limiting for outbound requests
          - Prevent SSRF probing and DoS attacks
          - Example:
            ```javascript
            const { RateLimiter } = require('limiter');
            
            // Create a rate limiter: 100 requests per minute
            const externalRequestLimiter = new RateLimiter({
              tokensPerInterval: 100,
              interval: 'minute'
            });
            
            async function rateLimitedRequest(url, options = {}) {
              // Check if we have tokens available
              const remainingRequests = await externalRequestLimiter.removeTokens(1);
              
              if (remainingRequests < 0) {
                throw new Error('Rate limit exceeded for external requests');
              }
              
              // Proceed with the request
              return axios(url, options);
            }
            
            // Usage
            app.get('/api/external-data', async (req, res) => {
              const { url } = req.query;
              
              if (!isValidUrl(url) || !isAllowedDomain(url)) {
                return res.status(403).json({ error: 'URL not allowed' });
              }
              
              try {
                const response = await rateLimitedRequest(url);
                return res.json(response.data);
              } catch (error) {
                if (error.message === 'Rate limit exceeded for external requests') {
                  return res.status(429).json({ error: 'Too many requests' });
                }
                return res.status(500).json({ error: 'Failed to fetch data' });
              }
            });
            ```
      
      12. **Use Web Application Firewalls (WAF):**
          - Configure WAF rules to detect and block SSRF patterns
          - Implement server-side firewall rules
          - Example:
            ```javascript
            // Middleware to detect SSRF attack patterns
            function ssrfProtectionMiddleware(req, res, next) {
              const url = req.query.url || req.body.url;
              
              if (!url) {
                return next();
              }
              
              // Check for suspicious URL patterns
              const ssrfPatterns = [
                /file:\/\//i,
                /^(ftps?|gopher|data|dict):\/\//i,
                /^\/\/\//,
                /(localhost|127\.0\.0\.1|0\.0\.0\.0|::1)/i,
                /^(10\.|172\.(1[6-9]|2[0-9]|3[0-1])\.|192\.168\.)/
              ];
              
              if (ssrfPatterns.some(pattern => pattern.test(url))) {
                logger.warn({
                  message: 'Potential SSRF attack detected',
                  url,
                  ip: req.ip,
                  path: req.path,
                  method: req.method,
                  userId: req.user?.id
                });
                
                return res.status(403).json({
                  error: 'Access denied - suspicious URL detected'
                });
              }
              
              next();
            }
            
            // Apply middleware to all routes
            app.use(ssrfProtectionMiddleware);
            ```
      
      13. **Implement Centralized Request Services:**
          - Create a dedicated service for external requests
          - Implement all security controls in one place
          - Example:
            ```javascript
            // externalRequestService.js
            const axios = require('axios');
            
            class ExternalRequestService {
              constructor(options = {}) {
                this.allowedDomains = options.allowedDomains || [];
                this.maxRedirects = options.maxRedirects || 2;
                this.timeout = options.timeout || 5000;
                this.logger = options.logger || console;
              }
              
              async request(url, options = {}) {
                // Validate URL
                if (!this._isValidUrl(url)) {
                  throw new Error('Invalid URL format');
                }
                
                // Check allowlist
                if (!this._isAllowedDomain(url)) {
                  throw new Error('Domain not in allowlist');
                }
                
                // Configure request options
                const requestOptions = {
                  ...options,
                  timeout: options.timeout || this.timeout,
                  maxRedirects: options.maxRedirects || this.maxRedirects,
                  validateStatus: status => status >= 200 && status < 300
                };
                
                try {
                  const response = await axios(url, requestOptions);
                  return response.data;
                } catch (error) {
                  this.logger.error({
                    message: 'External request failed',
                    url,
                    error: error.message
                  });
                  throw new Error(`External request failed: ${error.message}`);
                }
              }
              
              _isValidUrl(url) {
                try {
                  const parsedUrl = new URL(url);
                  return parsedUrl.protocol === 'http:' || parsedUrl.protocol === 'https:';
                } catch (error) {
                  return false;
                }
              }
              
              _isAllowedDomain(url) {
                try {
                  const parsedUrl = new URL(url);
                  return this.allowedDomains.includes(parsedUrl.hostname);
                } catch (error) {
                  return false;
                }
              }
            }
            
            module.exports = ExternalRequestService;
            
            // Usage in application
            const ExternalRequestService = require('./externalRequestService');
            
            const requestService = new ExternalRequestService({
              allowedDomains: [
                'api.example.com',
                'cdn.example.com',
                'partner.trusted-domain.com'
              ],
              logger: appLogger,
              timeout: 3000
            });
            
            app.get('/api/external-data', async (req, res) => {
              try {
                // Use the service for all external requests
                const data = await requestService.request('https://api.example.com/data');
                return res.json(data);
              } catch (error) {
                return res.status(500).json({ error: error.message });
              }
            });
            ```
      
      14. **Monitor and Audit External Requests:**
          - Log all external requests for audit purposes
          - Implement anomaly detection
          - Example:
            ```javascript
            // Middleware to log and monitor all external requests
            function requestMonitoringMiddleware(req, res, next) {
              // Only intercept routes that might make external requests
              if (!req.path.startsWith('/api/proxy') && !req.path.startsWith('/api/external')) {
                return next();
              }
              
              // Store original fetch/http.request methods
              const originalFetch = global.fetch;
              const originalHttpRequest = require('http').request;
              const originalHttpsRequest = require('https').request;
              
              // Override fetch
              global.fetch = async function monitoredFetch(url, options) {
                const requestId = uuid.v4();
                const startTime = Date.now();
                
                logger.info({
                  message: 'External request initiated',
                  requestId,
                  url,
                  method: options?.method || 'GET',
                  userContext: {
                    userId: req.user?.id,
                    ip: req.ip,
                    userAgent: req.headers['user-agent']
                  },
                  timestamp: new Date().toISOString()
                });
                
                try {
                  const response = await originalFetch(url, options);
                  
                  // Log successful request
                  logger.info({
                    message: 'External request completed',
                    requestId,
                    url,
                    statusCode: response.status,
                    duration: Date.now() - startTime,
                    timestamp: new Date().toISOString()
                  });
                  
                  return response;
                } catch (error) {
                  // Log failed request
                  logger.error({
                    message: 'External request failed',
                    requestId,
                    url,
                    error: error.message,
                    duration: Date.now() - startTime,
                    timestamp: new Date().toISOString()
                  });
                  
                  throw error;
                }
              };
              
              // Similar overrides for http.request and https.request
              // ...
              
              // Continue with the request
              res.on('finish', () => {
                // Restore original methods after request completes
                global.fetch = originalFetch;
                require('http').request = originalHttpRequest;
                require('https').request = originalHttpsRequest;
              });
              
              next();
            }
            
            // Apply middleware
            app.use(requestMonitoringMiddleware);
            ```
      
      15. **Implement Output Validation:**
          - Validate responses from external services
          - Use schema validation for expected formats
          - Example:
            ```javascript
            const Joi = require('joi');
            
            // Define expected schemas for external APIs
            const apiSchemas = {
              weatherApi: Joi.object({
                location: Joi.string().required(),
                temperature: Joi.number().required(),
                conditions: Joi.string().required(),
                forecast: Joi.array().items(Joi.object())
              }),
              
              userApi: Joi.object({
                id: Joi.string().required(),
                name: Joi.string().required(),
                email: Joi.string().email().required()
              })
            };
            
            async function validateExternalResponse(data, schemaName) {
              const schema = apiSchemas[schemaName];
              
              if (!schema) {
                throw new Error(`Schema not found: ${schemaName}`);
              }
              
              try {
                const result = await schema.validateAsync(data);
                return result;
              } catch (error) {
                logger.error({
                  message: 'External API response validation failed',
                  schemaName,
                  error: error.message,
                  data: JSON.stringify(data).substring(0, 200) // Log partial data for debugging
                });
                
                throw new Error(`Invalid response format from external API: ${error.message}`);
              }
            }
            
            // Usage
            app.get('/api/weather/:city', async (req, res) => {
              const { city } = req.params;
              
              try {
                // Fetch data from external API
                const apiUrl = `https://api.weather.example.com/current?city=${encodeURIComponent(city)}`;
                const response = await axios.get(apiUrl);
                
                // Validate the response against the expected schema
                const validatedData = await validateExternalResponse(response.data, 'weatherApi');
                
                // Return the validated data
                return res.json(validatedData);
              } catch (error) {
                return res.status(500).json({ error: error.message });
              }
            });
            ```

  - type: validate
    conditions:
      # Check 1: URL validation
      - pattern: "function\\s+(?:isValidUrl|validateUrl|checkUrl)\\s*\\([^)]*\\)\\s*\\{[^}]*new URL\\([^)]*\\)"
        message: "Using URL validation function with proper parsing."
      
      # Check 2: Domain allowlisting
      - pattern: "(?:allowlist|whitelist|allowed(?:Domain|Host))\\s*=\\s*\\["
        message: "Implementing domain allowlisting for outbound requests."
      
      # Check 3: Private IP filtering
      - pattern: "(?:isPrivateIP|isInternalNetwork|blockInternalAddresses)"
        message: "Checking for and blocking private IP addresses."
      
      # Check 4: Protocol restriction
      - pattern: "(?:allowedProtocols|validProtocols)\\s*=\\s*\\[\\s*['\"]https?:['\"]"
        message: "Restricting URL protocols to HTTP/HTTPS only."
      
      # Check 5: Request timeout implementation
      - pattern: "timeout:\\s*\\d+"
        message: "Setting timeouts for outbound HTTP requests."

metadata:
  priority: high
  version: 1.0
  tags:
    - security
    - javascript
    - nodejs
    - browser
    - ssrf
    - owasp
    - language:javascript
    - framework:express
    - framework:react
    - framework:vue
    - framework:angular
    - category:security
    - subcategory:ssrf
    - standard:owasp-top10
    - risk:a10-server-side-request-forgery
  references:
    - "https://owasp.org/Top10/A10_2021-Server-Side_Request_Forgery_%28SSRF%29/"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Server_Side_Request_Forgery_Prevention_Cheat_Sheet.html"
    - "https://portswigger.net/web-security/ssrf"
    - "https://github.com/OWASP/CheatSheetSeries/blob/master/cheatsheets/Server_Side_Request_Forgery_Prevention_Cheat_Sheet.md"
    - "https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/07-Input_Validation_Testing/19-Server-Side_Request_Forgery"
    - "https://cheatsheetseries.owasp.org/cheatsheets/REST_Security_Cheat_Sheet.html#ssrf-protection"
</rule> 
