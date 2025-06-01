---
description: Detect and prevent security logging and monitoring failures in JavaScript applications as defined in OWASP Top 10:2021-A09
globs: **/*.js, **/*.jsx, **/*.ts, **/*.tsx, !**/node_modules/**, !**/dist/**, !**/build/**, !**/coverage/**
---
# JavaScript Security Logging and Monitoring Failures (OWASP A09:2021)

<rule>
name: javascript_security_logging_monitoring_failures
description: Detect and prevent security logging and monitoring failures in JavaScript applications as defined in OWASP Top 10:2021-A09

actions:
  - type: enforce
    conditions:
      # Pattern 1: Missing Error Logging
      - pattern: "(?:try\\s*{[^}]*}\\s*catch\\s*\\([^)]*\\)\\s*{[^}]*})(?![^;{]*(?:console\\.(?:error|warn|log)|logger?\\.(?:error|warn|log)|captureException))"
        message: "Error caught without proper logging. Implement structured error logging for security events."
        
      # Pattern 2: Sensitive Data in Logs
      - pattern: "console\\.(?:log|warn|error|info|debug)\\s*\\([^)]*(?:password|token|secret|key|credential|auth|jwt|session|cookie)"
        negative_pattern: "\\*\\*\\*|redact|mask|sanitize"
        message: "Potential sensitive data in logs. Ensure sensitive information is redacted before logging."
        
      # Pattern 3: Missing Authentication Logging
      - pattern: "(?:login|signin|authenticate|auth)\\s*\\([^)]*\\)\\s*{[^}]*}"
        negative_pattern: "(?:log|audit|record|track)\\s*\\("
        message: "Authentication function without logging. Log authentication attempts, successes, and failures."
        
      # Pattern 4: Missing Authorization Logging
      - pattern: "(?:authorize|checkPermission|hasAccess|isAuthorized|can)\\s*\\([^)]*\\)\\s*{[^}]*}"
        negative_pattern: "(?:log|audit|record|track)\\s*\\("
        message: "Authorization check without logging. Log access control decisions, especially denials."
        
      # Pattern 5: Insufficient Error Detail
      - pattern: "(?:console\\.error|logger?\\.error)\\s*\\([^)]*(?:error|err|exception)\\s*\\)"
        negative_pattern: "(?:error\\.(?:message|stack|code|name)|JSON\\.stringify\\(error\\)|serialize)"
        message: "Error logging with insufficient detail. Include error type, message, stack trace, and context."
        
      # Pattern 6: Missing Security Event Logging
      - pattern: "(?:bruteForce|rateLimit|block|blacklist|suspicious|anomaly|threat|attack|intrusion|malicious)"
        negative_pattern: "(?:log|audit|record|track|monitor|alert|notify)"
        message: "Security event detection without logging. Implement logging for all security-relevant events."
        
      # Pattern 7: Inconsistent Log Formats
      - pattern: "console\\.(?:log|warn|error|info|debug)\\s*\\("
        negative_pattern: "JSON\\.stringify|structured|format"
        message: "Inconsistent log format. Use structured logging with consistent formats for easier analysis."
        
      # Pattern 8: Missing Log Correlation ID
      - pattern: "(?:api|http|fetch|axios|request)\\s*\\([^)]*\\)"
        negative_pattern: "(?:correlationId|requestId|traceId|spanId|context)"
        message: "API request without correlation ID. Include correlation IDs in logs for request tracing."
        
      # Pattern 9: Missing High-Value Transaction Logging
      - pattern: "(?:payment|transaction|order|purchase|transfer|withdraw|deposit)\\s*\\([^)]*\\)"
        negative_pattern: "(?:log|audit|record|track)"
        message: "High-value transaction without audit logging. Implement comprehensive logging for all transactions."
        
      # Pattern 10: Client-Side Logging Issues
      - pattern: "(?:window\\.onerror|window\\.addEventListener\\s*\\(\\s*['\"]error['\"])"
        negative_pattern: "(?:send|report|log|capture|track)"
        message: "Client-side error handler without reporting. Implement error reporting to backend services."
        
      # Pattern 11: Missing Log Levels
      - pattern: "console\\.log\\s*\\("
        negative_pattern: "logger?\\.(?:error|warn|info|debug|trace)"
        message: "Using console.log without proper log levels. Implement a logging library with appropriate log levels."
        
      # Pattern 12: Missing Monitoring Integration
      - pattern: "package\\.json"
        negative_pattern: "(?:sentry|newrelic|datadog|appinsights|loggly|splunk|elasticsearch|winston|bunyan|pino|loglevel)"
        file_pattern: "package\\.json$"
        message: "No logging or monitoring dependencies detected. Consider adding a proper logging library and monitoring integration."
        
      # Pattern 13: Missing Log Aggregation
      - pattern: "(?:docker-compose\\.ya?ml|\\.env|\\.env\\.example|Dockerfile)"
        negative_pattern: "(?:sentry|newrelic|datadog|appinsights|loggly|splunk|elasticsearch|logstash|fluentd|kibana)"
        file_pattern: "(?:docker-compose\\.ya?ml|\\.env|\\.env\\.example|Dockerfile)$"
        message: "No log aggregation service configured. Implement centralized log collection and analysis."
        
      # Pattern 14: Missing Health Checks
      - pattern: "(?:express|koa|fastify|hapi|http\\.createServer)"
        negative_pattern: "(?:health|status|heartbeat|alive|ready)"
        message: "Server without health check endpoint. Implement health checks for monitoring service status."
        
      # Pattern 15: Missing Rate Limiting Logs
      - pattern: "(?:rateLimit|throttle|limiter)"
        negative_pattern: "(?:log|record|track|monitor|alert|notify)"
        message: "Rate limiting without logging. Log rate limit events to detect potential attacks."

  - type: suggest
    message: |
      **JavaScript Security Logging and Monitoring Best Practices:**
      
      1. **Structured Error Logging:**
         - Use structured logging formats (JSON)
         - Include contextual information with errors
         - Example:
           ```javascript
           try {
             // Operation that might fail
             processUserData(userData);
           } catch (error) {
             logger.error({
               message: 'Failed to process user data',
               error: {
                 name: error.name,
                 message: error.message,
                 stack: error.stack
               },
               userId: userData.id,
               context: 'user-processing',
               timestamp: new Date().toISOString()
             });
             // Handle the error appropriately
           }
           ```
      
      2. **Sensitive Data Redaction:**
         - Redact sensitive information before logging
         - Use dedicated functions for sanitization
         - Example:
           ```javascript
           function redactSensitiveData(obj) {
             const sensitiveFields = ['password', 'token', 'secret', 'creditCard', 'ssn'];
             const redacted = { ...obj };
             
             for (const field of sensitiveFields) {
               if (field in redacted) {
                 redacted[field] = '***REDACTED***';
               }
             }
             
             return redacted;
           }
           
           // Usage
           logger.info({
             message: 'User login attempt',
             user: redactSensitiveData(userData),
             timestamp: new Date().toISOString()
           });
           ```
      
      3. **Authentication Logging:**
         - Log all authentication events
         - Include success/failure status
         - Example:
           ```javascript
           async function authenticateUser(username, password) {
             try {
               const user = await User.findOne({ username });
               
               if (!user) {
                 logger.warn({
                   message: 'Authentication failed: user not found',
                   username,
                   ipAddress: req.ip,
                   userAgent: req.headers['user-agent'],
                   timestamp: new Date().toISOString()
                 });
                 return { success: false, reason: 'invalid_credentials' };
               }
               
               const isValid = await bcrypt.compare(password, user.passwordHash);
               
               if (!isValid) {
                 logger.warn({
                   message: 'Authentication failed: invalid password',
                   username,
                   userId: user.id,
                   ipAddress: req.ip,
                   userAgent: req.headers['user-agent'],
                   timestamp: new Date().toISOString()
                 });
                 return { success: false, reason: 'invalid_credentials' };
               }
               
               logger.info({
                 message: 'User authenticated successfully',
                 username,
                 userId: user.id,
                 ipAddress: req.ip,
                 userAgent: req.headers['user-agent'],
                 timestamp: new Date().toISOString()
               });
               
               return { success: true, user };
             } catch (error) {
               logger.error({
                 message: 'Authentication error',
                 username,
                 error: {
                   name: error.name,
                   message: error.message,
                   stack: error.stack
                 },
                 timestamp: new Date().toISOString()
               });
               return { success: false, reason: 'system_error' };
             }
           }
           ```
      
      4. **Authorization Logging:**
         - Log access control decisions
         - Include user, resource, and action
         - Example:
           ```javascript
           function checkPermission(user, resource, action) {
             const hasPermission = user.permissions.some(p => 
               p.resource === resource && p.actions.includes(action)
             );
             
             logger.info({
               message: `Authorization ${hasPermission ? 'granted' : 'denied'}`,
               userId: user.id,
               username: user.username,
               resource,
               action,
               decision: hasPermission ? 'allow' : 'deny',
               timestamp: new Date().toISOString()
             });
             
             return hasPermission;
           }
           ```
      
      5. **Comprehensive Error Logging:**
         - Include detailed error information
         - Add context for troubleshooting
         - Example:
           ```javascript
           // Using a logging library like Winston
           const winston = require('winston');
           
           const logger = winston.createLogger({
             level: process.env.LOG_LEVEL || 'info',
             format: winston.format.combine(
               winston.format.timestamp(),
               winston.format.json()
             ),
             defaultMeta: { service: 'user-service' },
             transports: [
               new winston.transports.Console(),
               new winston.transports.File({ filename: 'error.log', level: 'error' }),
               new winston.transports.File({ filename: 'combined.log' })
             ]
           });
           
           // Usage
           try {
             // Operation that might fail
           } catch (error) {
             logger.error({
               message: 'Operation failed',
               operationName: 'processData',
               error: {
                 name: error.name,
                 message: error.message,
                 code: error.code,
                 stack: error.stack
               },
               context: {
                 userId: req.user?.id,
                 requestId: req.id,
                 path: req.path,
                 method: req.method
               }
             });
           }
           ```
      
      6. **Security Event Logging:**
         - Log all security-relevant events
         - Include detailed context
         - Example:
           ```javascript
           function detectBruteForce(username, ipAddress) {
             const attempts = getLoginAttempts(username, ipAddress);
             
             if (attempts > MAX_ATTEMPTS) {
               logger.warn({
                 message: 'Possible brute force attack detected',
                 username,
                 ipAddress,
                 attempts,
                 threshold: MAX_ATTEMPTS,
                 action: 'account_temporarily_locked',
                 timestamp: new Date().toISOString()
               });
               
               // Implement account lockout or IP blocking
               lockAccount(username, LOCKOUT_DURATION);
               return true;
             }
             
             return false;
           }
           ```
      
      7. **Structured Logging Format:**
         - Use JSON for machine-readable logs
         - Maintain consistent field names
         - Example:
           ```javascript
           // Using a structured logging library like Pino
           const pino = require('pino');
           
           const logger = pino({
             level: process.env.LOG_LEVEL || 'info',
             base: { pid: process.pid, hostname: os.hostname() },
             timestamp: pino.stdTimeFunctions.isoTime,
             formatters: {
               level: (label) => {
                 return { level: label };
               }
             }
           });
           
           // Usage
           logger.info({
             msg: 'User profile updated',
             userId: user.id,
             changes: ['email', 'preferences'],
             source: 'api'
           });
           ```
      
      8. **Request Correlation:**
         - Use correlation IDs across services
         - Track request flow through the system
         - Example:
           ```javascript
           // Express middleware for adding correlation IDs
           const { v4: uuidv4 } = require('uuid');
           
           function correlationMiddleware(req, res, next) {
             // Use existing correlation ID from headers or generate a new one
             const correlationId = req.headers['x-correlation-id'] || uuidv4();
             req.correlationId = correlationId;
             
             // Add to response headers
             res.setHeader('x-correlation-id', correlationId);
             
             // Add to logger context for this request
             req.logger = logger.child({ correlationId });
             
             next();
           }
           
           // Usage in route handlers
           app.get('/api/users/:id', (req, res) => {
             req.logger.info({
               msg: 'User profile requested',
               userId: req.params.id,
               path: req.path,
               method: req.method
             });
             
             // Process request...
           });
           ```
      
      9. **Transaction Logging:**
         - Log all high-value transactions
         - Include before/after states
         - Example:
           ```javascript
           async function processPayment(userId, amount, paymentMethod) {
             logger.info({
               message: 'Payment processing started',
               userId,
               amount,
               paymentMethod: {
                 type: paymentMethod.type,
                 lastFour: paymentMethod.lastFour
               },
               transactionId: generateTransactionId(),
               timestamp: new Date().toISOString()
             });
             
             try {
               const result = await paymentGateway.charge({
                 amount,
                 source: paymentMethod.token
               });
               
               logger.info({
                 message: 'Payment processed successfully',
                 userId,
                 amount,
                 transactionId: result.transactionId,
                 gatewayReference: result.reference,
                 status: 'success',
                 timestamp: new Date().toISOString()
               });
               
               return { success: true, transactionId: result.transactionId };
             } catch (error) {
               logger.error({
                 message: 'Payment processing failed',
                 userId,
                 amount,
                 error: {
                   name: error.name,
                   message: error.message,
                   code: error.code
                 },
                 status: 'failed',
                 timestamp: new Date().toISOString()
               });
               
               return { success: false, error: error.message };
             }
           }
           ```
      
      10. **Client-Side Error Reporting:**
          - Send client errors to the backend
          - Include browser and user context
          - Example:
            ```javascript
            // Client-side error tracking
            window.addEventListener('error', function(event) {
              const errorDetails = {
                message: event.message,
                source: event.filename,
                lineno: event.lineno,
                colno: event.colno,
                error: {
                  stack: event.error?.stack
                },
                url: window.location.href,
                userAgent: navigator.userAgent,
                timestamp: new Date().toISOString(),
                // Add user context if available
                userId: window.currentUser?.id
              };
              
              // Send to backend logging endpoint
              fetch('/api/log/client-error', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(errorDetails),
                // Use keepalive to ensure the request completes even if the page is unloading
                keepalive: true
              }).catch(err => {
                // Fallback if the logging endpoint fails
                console.error('Failed to send error report:', err);
              });
            });
            ```
      
      11. **Proper Log Levels:**
          - Use appropriate log levels
          - Configure based on environment
          - Example:
            ```javascript
            // Using Winston with proper log levels
            const winston = require('winston');
            
            const logger = winston.createLogger({
              level: process.env.NODE_ENV === 'production' ? 'info' : 'debug',
              levels: winston.config.npm.levels,
              format: winston.format.combine(
                winston.format.timestamp(),
                winston.format.json()
              ),
              transports: [
                new winston.transports.Console({
                  format: winston.format.combine(
                    winston.format.colorize(),
                    winston.format.simple()
                  )
                })
              ]
            });
            
            // Usage with appropriate levels
            logger.error('Critical application error'); // Always logged
            logger.warn('Potential issue detected'); // Warning conditions
            logger.info('Normal operational message'); // Normal but significant
            logger.http('HTTP request received'); // HTTP request logging
            logger.verbose('Detailed information'); // Detailed debug information
            logger.debug('Debugging information'); // For developers
            logger.silly('Extremely detailed tracing'); // Most granular
            ```
      
      12. **Monitoring Integration:**
          - Integrate with monitoring services
          - Set up alerts for critical issues
          - Example:
            ```javascript
            // Using Sentry for error monitoring
            const Sentry = require('@sentry/node');
            const Tracing = require('@sentry/tracing');
            const express = require('express');
            
            const app = express();
            
            Sentry.init({
              dsn: process.env.SENTRY_DSN,
              integrations: [
                new Sentry.Integrations.Http({ tracing: true }),
                new Tracing.Integrations.Express({ app })
              ],
              tracesSampleRate: 1.0
            });
            
            // Use Sentry middleware
            app.use(Sentry.Handlers.requestHandler());
            app.use(Sentry.Handlers.tracingHandler());
            
            // Your routes here
            
            // Error handler
            app.use(Sentry.Handlers.errorHandler());
            app.use((err, req, res, next) => {
              // Custom error handling
              logger.error({
                message: 'Express error',
                error: {
                  name: err.name,
                  message: err.message,
                  stack: err.stack
                },
                request: {
                  path: req.path,
                  method: req.method,
                  correlationId: req.correlationId
                }
              });
              
              res.status(500).json({ error: 'Internal server error' });
            });
            ```
      
      13. **Log Aggregation:**
          - Set up centralized log collection
          - Configure log shipping
          - Example:
            ```javascript
            // Using Winston with Elasticsearch transport
            const winston = require('winston');
            const { ElasticsearchTransport } = require('winston-elasticsearch');
            
            const esTransportOpts = {
              level: 'info',
              clientOpts: {
                node: process.env.ELASTICSEARCH_URL,
                auth: {
                  username: process.env.ELASTICSEARCH_USERNAME,
                  password: process.env.ELASTICSEARCH_PASSWORD
                }
              },
              indexPrefix: 'app-logs'
            };
            
            const logger = winston.createLogger({
              transports: [
                new winston.transports.Console(),
                new ElasticsearchTransport(esTransportOpts)
              ]
            });
            ```
            
            ```yaml
            # docker-compose.yml example with ELK stack
            version: '3'
            services:
              app:
                build: .
                environment:
                  - NODE_ENV=production
                  - ELASTICSEARCH_URL=http://elasticsearch:9200
                depends_on:
                  - elasticsearch
              
              elasticsearch:
                image: docker.elastic.co/elasticsearch/elasticsearch:7.14.0
                environment:
                  - discovery.type=single-node
                  - ES_JAVA_OPTS=-Xms512m -Xmx512m
                volumes:
                  - es_data:/usr/share/elasticsearch/data
              
              kibana:
                image: docker.elastic.co/kibana/kibana:7.14.0
                ports:
                  - "5601:5601"
                depends_on:
                  - elasticsearch
              
              logstash:
                image: docker.elastic.co/logstash/logstash:7.14.0
                volumes:
                  - ./logstash/pipeline:/usr/share/logstash/pipeline
                depends_on:
                  - elasticsearch
            
            volumes:
              es_data:
            ```
      
      14. **Health Checks and Monitoring:**
          - Implement health check endpoints
          - Monitor application status
          - Example:
            ```javascript
            const express = require('express');
            const app = express();
            
            // Basic health check endpoint
            app.get('/health', (req, res) => {
              const status = {
                status: 'UP',
                timestamp: new Date().toISOString(),
                uptime: process.uptime(),
                memoryUsage: process.memoryUsage(),
                version: process.env.npm_package_version
              };
              
              // Add database health check
              try {
                // Check database connection
                status.database = { status: 'UP' };
              } catch (error) {
                status.database = { status: 'DOWN', error: error.message };
                status.status = 'DEGRADED';
              }
              
              // Add external service health checks
              // ...
              
              // Log health check results
              logger.debug({
                message: 'Health check performed',
                result: status
              });
              
              const statusCode = status.status === 'UP' ? 200 : 
                                status.status === 'DEGRADED' ? 200 : 503;
              
              res.status(statusCode).json(status);
            });
            
            // Detailed readiness probe
            app.get('/ready', async (req, res) => {
              const checks = [];
              let isReady = true;
              
              // Check database
              try {
                await db.ping();
                checks.push({ component: 'database', status: 'ready' });
              } catch (error) {
                isReady = false;
                checks.push({ 
                  component: 'database', 
                  status: 'not ready',
                  error: error.message
                });
              }
              
              // Check cache
              try {
                await cache.ping();
                checks.push({ component: 'cache', status: 'ready' });
              } catch (error) {
                isReady = false;
                checks.push({ 
                  component: 'cache', 
                  status: 'not ready',
                  error: error.message
                });
              }
              
              // Log readiness check
              logger.debug({
                message: 'Readiness check performed',
                isReady,
                checks
              });
              
              res.status(isReady ? 200 : 503).json({
                status: isReady ? 'ready' : 'not ready',
                checks,
                timestamp: new Date().toISOString()
              });
            });
            ```
      
      15. **Rate Limiting with Logging:**
          - Log rate limit events
          - Track potential abuse
          - Example:
            ```javascript
            const rateLimit = require('express-rate-limit');
            
            // Create rate limiter with logging
            const apiLimiter = rateLimit({
              windowMs: 15 * 60 * 1000, // 15 minutes
              max: 100, // limit each IP to 100 requests per windowMs
              standardHeaders: true,
              legacyHeaders: false,
              handler: (req, res, next, options) => {
                // Log rate limit exceeded
                logger.warn({
                  message: 'Rate limit exceeded',
                  ip: req.ip,
                  path: req.path,
                  method: req.method,
                  userAgent: req.headers['user-agent'],
                  currentLimit: options.max,
                  windowMs: options.windowMs,
                  correlationId: req.correlationId,
                  userId: req.user?.id,
                  timestamp: new Date().toISOString()
                });
                
                res.status(options.statusCode).json({
                  status: 'error',
                  message: options.message
                });
              },
              // Called on all requests to track usage
              onLimitReached: (req, res, options) => {
                // This is called when a client hits the rate limit
                logger.warn({
                  message: 'Client reached rate limit',
                  ip: req.ip,
                  path: req.path,
                  method: req.method,
                  userAgent: req.headers['user-agent'],
                  correlationId: req.correlationId,
                  userId: req.user?.id,
                  timestamp: new Date().toISOString()
                });
                
                // Consider additional actions like temporary IP ban
                // or sending alerts for potential attacks
              }
            });
            
            // Apply to all API routes
            app.use('/api/', apiLimiter);
            ```

  - type: validate
    conditions:
      # Check 1: Structured Logging
      - pattern: "(?:winston|pino|bunyan|loglevel|morgan|log4js)"
        message: "Using a structured logging library."
      
      # Check 2: Error Logging
      - pattern: "try\\s*{[^}]*}\\s*catch\\s*\\([^)]*\\)\\s*{[^}]*(?:logger?\\.error|captureException)\\s*\\([^)]*\\)"
        message: "Implementing proper error logging in catch blocks."
      
      # Check 3: Sensitive Data Handling
      - pattern: "(?:redact|mask|sanitize|filter)\\s*\\([^)]*(?:password|token|secret|key|credential)"
        message: "Implementing sensitive data redaction in logs."
      
      # Check 4: Correlation IDs
      - pattern: "(?:correlationId|requestId|traceId)"
        message: "Using correlation IDs for request tracing."
      
      # Check 5: Monitoring Integration
      - pattern: "(?:sentry|newrelic|datadog|appinsights|loggly|splunk|elasticsearch)"
        message: "Integrating with monitoring or log aggregation services."

metadata:
  priority: high
  version: 1.0
  tags:
    - security
    - javascript
    - nodejs
    - browser
    - logging
    - monitoring
    - owasp
    - language:javascript
    - framework:express
    - framework:react
    - framework:vue
    - framework:angular
    - category:security
    - subcategory:logging
    - standard:owasp-top10
    - risk:a09-security-logging-monitoring-failures
  references:
    - "https://owasp.org/Top10/A09_2021-Security_Logging_and_Monitoring_Failures/"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Logging_Cheat_Sheet.html"
    - "https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/10-Business_Logic_Testing/08-Test_for_Process_Timing"
    - "https://github.com/OWASP/CheatSheetSeries/blob/master/cheatsheets/Logging_Vocabulary_Cheat_Sheet.md"
    - "https://cheatsheetseries.owasp.org/cheatsheets/REST_Security_Cheat_Sheet.html#security-logging-monitoring"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Application_Logging_Vocabulary_Cheat_Sheet.html"
    - "https://cheatsheetseries.owasp.org/cheatsheets/Transaction_Authorization_Cheat_Sheet.html#monitor-activity"
</rule> 
