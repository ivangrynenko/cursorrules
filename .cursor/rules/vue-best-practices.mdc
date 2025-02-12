---
description: Vue 3 and NuxtJS specific standards and optimizations
globs: *.vue, *.js, *.ts
---
# Vue 3 and NuxtJS Best Practices

Ensures Vue 3 and NuxtJS code follows recommended patterns and optimizations.

<rule>
name: vue_nuxt_best_practices
description: Enforce Vue 3 and NuxtJS coding standards and optimizations
filters:
  - type: file_extension
    pattern: "\\.(vue|js|ts)$"

actions:
  - type: enforce
    conditions:
      - pattern: "(?<!defineProps|interface|type)\\{\\s*[a-zA-Z]+\\s*:\\s*[a-zA-Z]+\\s*\\}"
        message: "Use TypeScript interfaces for prop definitions"

      - pattern: "watch\\(.*,.*\\{\\s*immediate:\\s*true\\s*\\}"
        message: "Consider using computed property instead of immediate watch"

      - pattern: "v-if.*v-for"
        message: "Avoid using v-if with v-for on the same element"

  - type: suggest
    message: |
      Vue 3 Best Practices:
      - Use Composition API for complex components
      - Implement proper prop validation
      - Use TypeScript for better type safety
      - Leverage Vue 3's reactivity system effectively
      - Consider using <script setup> syntax

metadata:
  priority: high
  version: 1.0
</rule> 