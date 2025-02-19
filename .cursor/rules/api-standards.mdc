---
description: RESTful API design and documentation standards
globs: *.php, *.js, *.ts
---
# Enhanced API Standards

Ensures consistent API design, documentation, and implementation best practices across PHP, JavaScript, and TypeScript files.

<rule>
name: enhanced_api_standards
description: Enforce enhanced API design, implementation, and documentation standards
filters:
  - type: file_extension
    pattern: "\\.(php|js|ts)$"

actions:
  - type: enforce
    conditions:
      - pattern: "@api\\s+(?!GET|POST|PUT|DELETE|PATCH|OPTIONS|HEAD)"
        message: "Use standard HTTP methods (GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD) for API endpoints."

      - pattern: "function\\s+[a-zA-Z]+Api\\s*\\([^)]*\\)\\s*\\{[^}]*\\}"
        pattern_negate: "(?s)(throw new \\w+Exception|return\\s+(?:\\d{3}|4\\d\\d|5\\d\\d))"
        message: "Ensure API functions handle or return errors appropriately using exceptions or HTTP status codes."

      - pattern: "(?<!@api\\s+)(?<!\\s+returns\\s+)(?<!\\s+throws\\s+)[A-Z]{3,}(?!\\s+)"
        message: "HTTP methods should be prefixed with '@api' for documentation purposes."

      - pattern: "\\bresponse\\b(?![^;]*\\.json\\()"
        message: "Ensure all API responses are properly formatted, preferably as JSON."

  - type: suggest
    message: |
      **API Best Practices:**
      - **HTTP Methods:** Use proper HTTP methods for operations (GET for retrieval, POST for creation, etc.).
      - **Status Codes:** Use appropriate HTTP status codes to communicate the result of the request.
      - **Versioning:** Implement API versioning to manage changes without breaking existing integrations.
      - **Documentation:** 
        - **Swagger/OpenAPI:** Use tools like Swagger for comprehensive API documentation.
        - **Endpoint Descriptions:** Clearly document all endpoints including path, methods, parameters, and possible responses.
      - **Authentication & Security:**
        - Implement OAuth, JWT, or similar secure authentication methods.
        - Use HTTPS for all API communications.
      - **Rate Limiting:** Implement rate limiting to prevent abuse and ensure fair usage.
      - **Error Handling:** 
        - Provide clear, human-readable error messages with corresponding status codes.
        - Implement error logging for debugging purposes.
      - **Pagination:** For list endpoints, implement pagination to manage large datasets.
      - **Validation:** Validate input data at the API level to ensure data integrity.
      - **CORS:** Configure CORS headers if your API is meant to be consumed by web applications from different domains.
      - **Monitoring:** Set up monitoring for API performance and usage statistics.

metadata:
  priority: high
  version: 1.1
</rule>