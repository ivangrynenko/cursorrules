---
description: Webpack/Vite configuration and build process optimization
globs: webpack.config.js, vite.config.js, *.config.js
---
# Enhanced Build Process Optimization

Ensures optimal build configuration and process for better performance and maintainability.

<rule>
name: enhanced_build_optimization
description: Enforce standards for optimizing build processes
filters:
  - type: file_extension
    pattern: "\\.(js|ts|json)$"  # Expanded to cover more config file types

actions:
  - type: enforce
    conditions:
      - pattern: "mode:\\s*['\"]development['\"]"
        pattern_negate: "process\\.env\\.NODE_ENV === 'development'"
        message: "Set 'mode' to 'production' for production builds unless dynamically set by NODE_ENV."

      - pattern: "devtool:\\s*['\"]eval"
        message: "Use 'source-map' or 'hidden-source-map' for production builds to balance performance and debugging."

      - pattern: "optimization:\\s*{[^}]*?splitChunks:\\s*{[^}]*?chunks:\\s*(?!'all')"
        message: "Enable code splitting for all chunks in optimization settings."

      - pattern: "optimization:\\s*{[^}]*?usedExports:\\s*(?!true)"
        message: "Enable tree shaking by setting 'usedExports' to true."

      - pattern: "output\\s*:\\s*{[^}]*?filename:\\s*['\"][^\\[]+['\"]"
        message: "Use content hashing in filenames for better caching (e.g., '[name].[contenthash].js')."

  - type: suggest
    message: |
      **Build Optimization Best Practices:**
      - **Code Splitting:** Implement code splitting to load only what's necessary for each page or component.
      - **Tree Shaking:** Enable tree shaking to eliminate dead code, which reduces bundle size.
      - **Asset Optimization:**
        - Compress images and use modern formats like WebP where supported.
        - Use lazy loading for images and other media.
      - **Caching:**
        - Configure proper caching strategies (e.g., HTTP headers, service workers for PWA).
        - Use long-term caching for static assets with content hashing in filenames.
      - **Modern JavaScript:** 
        - Use ES6+ features but ensure polyfills for older browsers if needed.
        - Consider using features like module/nomodule for graceful degradation.
      - **Minification & Compression:** Ensure all JavaScript and CSS are minified and consider enabling gzip compression on the server.
      - **Performance Budgets:** Set performance budgets to keep bundle sizes in check.
      - **Environment Variables:** Use environment variables for configuration differentiation between development and production.
      - **CI/CD:** Integrate with CI/CD pipelines for automated builds and testing, ensuring only optimized code goes to production.

metadata:
  priority: high
  version: 1.1
</rule>