# Cursor Rules - Tag Standards

This document defines the standardised tagging system used across all Cursor rules. These tags provide a structured, hierarchical way to categorise rules and enable selective installation based on project requirements.

## Tag Hierarchy

Tags follow a hierarchical structure with the following levels:

1. **Language** - The primary programming language the rule applies to
2. **Framework** - The specific framework or CMS the rule targets
3. **Category** - The primary functional category of the rule
4. **Subcategory** - More granular categorisation within the category
5. **Standard** - The formal standard or guideline the rule implements
6. **Risk** - The specific risk identifier (when applicable)

## Tag Format

Tags use lowercase with hyphens separating multiple words, and colons separating the tag type from its value:

```
type:value
```

For example: `language:javascript`, `framework:react`, `category:security`

## Standard Tag Types

### Language Tags

Language tags identify the programming language the rule applies to:

- `language:php`
- `language:javascript` 
- `language:typescript`
- `language:python`
- `language:ruby`
- `language:java`
- `language:go`
- `language:rust`
- `language:csharp`
- `language:bash`
- `language:html`
- `language:css`
- `language:scss`

### Framework Tags

Framework tags specify the framework or CMS the rule targets:

- `framework:angular`
- `framework:astro`
- `framework:bootstrap`
- `framework:express`
- `framework:jquery`
- `framework:nextjs`
- `framework:nuxtjs`
- `framework:react`
- `framework:tailwind`
- `framework:vue`
- `framework:drupal`
- `framework:laravel`
- `framework:symfony`
- `framework:wordpress`
- `framework:django`
- `framework:fastapi`
- `framework:flask`

### Category Tags

Category tags define the primary functional focus of the rule:

- `category:a11y` (for accessibility)
- `category:best-practice`
- `category:ci-cd`
- `category:configuration`
- `category:deployment`
- `category:documentation`
- `category:performance`
- `category:security`
- `category:style`
- `category:testing`

### Subcategory Tags

Subcategory tags provide more granular categorisation within the primary category:

For `category:security`:
- `subcategory:injection`
- `subcategory:authentication`
- `subcategory:authorisation`
- `subcategory:xss`
- `subcategory:csrf`
- `subcategory:cryptography`
- `subcategory:configuration`
- `subcategory:data-protection`
- `subcategory:api-security`
- `subcategory:design`
- `subcategory:input-validation`

For `category:performance`:
- `subcategory:caching`
- `subcategory:rendering`
- `subcategory:database`
- `subcategory:assets`
- `subcategory:memory-management`

For `category:accessibility`:
- `subcategory:screen-readers`
- `subcategory:keyboard-navigation`
- `subcategory:color-contrast`
- `subcategory:form-accessibility`

### Standard Tags

Standard tags identify formal standards or guidelines the rule implements:

- `standard:owasp-top10` - OWASP Top 10 web application security risks
- `standard:wcag` - Web Content Accessibility Guidelines
- `standard:pci-dss` - Payment Card Industry Data Security Standard
- `standard:gdpr` - General Data Protection Regulation
- `standard:hipaa` - Health Insurance Portability and Accountability Act
- `standard:psr` - PHP Standards Recommendations
- `standard:eslint` - ESLint recommended rules
- `standard:a11y` - Accessibility standards
- `standard:soc2` - Service Organisation Control 2

### Risk Tags

Risk tags specify the exact risk identifier, particularly for security standards:

For `standard:owasp-top10`:
- `risk:a01-broken-access-control`
- `risk:a02-cryptographic-failures`
- `risk:a03-injection`
- `risk:a04-insecure-design`
- `risk:a05-security-misconfiguration`
- `risk:a06-vulnerable-outdated-components`
- `risk:a07-identification-authentication-failures`
- `risk:a08-software-data-integrity-failures`
- `risk:a09-security-logging-monitoring-failures`
- `risk:a10-server-side-request-forgery`

## Multiple Tag Values

Some rules may apply to multiple languages, frameworks, or categories. In these cases, multiple tags of the same type can be specified:

```
language:javascript
language:typescript
framework:react
framework:next
category:security
subcategory:authentication
```

## Tag Combinations

Tag combinations enable precise rule selection. For example:

- All security rules: `category:security`
- PHP Drupal security rules: `language:php framework:drupal category:security`
- OWASP injection rules for JavaScript: `language:javascript category:security standard:owasp-top10 subcategory:injection`
- Accessibility rules for React: `framework:react category:accessibility`

## Using Tags in Rule Files

Tags should be included in the metadata section of each rule file (.mdc):

```yaml
metadata:
  tags:
    - language:php
    - framework:drupal
    - category:security
    - subcategory:injection
    - standard:owasp-top10
    - risk:a03-injection
```

## Best Practices for Tagging

1. **Consistency**: Always use the standard format and vocabulary
2. **Specificity**: Be as specific as possible with tags
3. **Completeness**: Include all relevant tag types
4. **Hierarchy**: Maintain the hierarchical relationship between tags
5. **Relevance**: Only include tags that are directly applicable to the rule

## Tag-Based Selection

The tag system enables selective installation of rules based on project requirements:

- Installation scripts can filter rules based on language, framework, or specific security concerns
- Multiple tag criteria can be combined using logical operations (AND/OR)
- Predefined rule sets can be created for common use cases (e.g., "drupal-security", "react-accessibility")

## Extending the Tag System

The tag system is designed to be extensible. New tag types or values can be added as needed:

1. Document the new tag type or value in this standard
2. Ensure consistency with existing tag formats
3. Update rule selection tools to recognise the new tags
4. Consider backward compatibility with existing rules 