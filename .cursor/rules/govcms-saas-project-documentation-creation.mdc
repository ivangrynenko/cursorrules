---
description: GovCMS SaaS Documentation Generator. This rule helps generate comprehensive technical documentation for GovCMS SaaS projects, automatically detecting frameworks and dependencies, and providing structured documentation that aligns with government standards.
globs: 
alwaysApply: false
---
name: govcms_documentation_generator
description: Generate comprehensive documentation for GovCMS SaaS projects
version: 1.0.0
filters:
  - type: file_extension
    pattern: "(php|yml|js|css|twig|md)$"
  - type: file_path
    pattern: "(themes/custom|modules/custom|templates|docs)"
actions:
  - type: suggest
    message: |
      # GovCMS SaaS Documentation Generator
      
      ## Framework Detection
      1. Scan codebase for CSS frameworks (Tailwind, Bootstrap, Foundation, etc.)
      2. Identify JS libraries (Alpine.js, Vue, React, etc.)
      3. Confirm Drupal 10+ compatibility
      4. Check for GovCMS SaaS constraints compliance
      
      ## Documentation Structure
      Generate these core documentation files:
      
      ### 1. Project Documentation (project-documentation.md)
      - Project Overview
      - Platform Architecture (GovCMS SaaS)
      - Components & Features
      - Development Workflow
      - Deployment Process
      - Maintenance Guidelines
      - SaaS Constraints & Workarounds
      
      ### 2. Theme Documentation (theme-documentation.md)
      - Technical Specifications
      - Theme Structure & Regions
      - CSS Framework Implementation
      - JavaScript Functionality
      - Responsive Design Approach
      - Accessibility Compliance
      - Customization Guidelines
      
      ### 3. Content Management (content-management-guidelines.md)
      - Content Types & Fields
      - Media Management
      - Editorial Guidelines
      - Content Workflow
      - SEO Best Practices
      - Accessibility Requirements
      
      ### 4. Testing Guidelines (testing-guidelines.md)
      - Theme Compilation Testing
      - Responsive Testing
      - Functional Testing
      - Accessibility Testing
      - Performance Testing
      - Browser Compatibility
      
      ## Output Format
      - Use Markdown with proper heading hierarchy
      - Include code examples
      - Add relevant screenshots
      - Link between documentation sections
      - Include version information and dates
      
      ## GovCMS SaaS Constraints
      - Emphasize theme-only customizations (no custom modules)
      - Focus on configuration-based solutions
      - Document admin UI customizations
      - Include Lagoon/platform-specific details