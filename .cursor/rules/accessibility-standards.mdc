---
description: WCAG compliance and accessibility best practices
globs: *.vue, *.jsx, *.tsx, *.html, *.php
---
# Accessibility Standards

Ensures WCAG compliance and accessibility best practices.

<rule>
name: accessibility_standards
description: Enforce accessibility standards and WCAG compliance
filters:
  - type: file_extension
    pattern: "\\.(vue|jsx|tsx|html|php|css|scss|sass)$" # Expanded to include CSS files

actions:
  - type: enforce
    conditions:
      - pattern: "<img[^>]+(?!alt=)[^>]*>"
        message: "Images must have alt attributes for screen readers."
      
      - pattern: "aria-[a-z]+=\"\""
        message: "ARIA attributes should not be empty; provide meaningful values."

      - pattern: "<button[^>]*>(?![^<]*[^\\s])[^<]*</button>"
        message: "Buttons should have meaningful, descriptive content."

      - pattern: "<a[^>]*href=\"#[^\"]*\"[^>]*>(?![^<]*<svg)[^<]*</a>"
        message: "Links with href='#' should either be removed or have an aria-label for context."

      - pattern: "<input[^>]+type=\"(text|email|password|search|tel|url)\"[^>]*>"
        pattern_negate: "aria-label|aria-labelledby|title"
        message: "Form inputs should include an aria-label or aria-labelledby attribute for better screen reader support."

      - pattern: "<video[^>]*>(?!<track)[^<]*</video>"
        message: "Videos should include captions for accessibility."

  - type: suggest
    message: |
      **Accessibility Best Practices:**
      - **Heading Hierarchy:** Use headings (h1 to h6) in a logical order to structure content.
      - **Keyboard Navigation:** Ensure all interactive elements are accessible via keyboard.
      - **Semantic HTML:** Favor semantic elements like <nav>, <article>, <section>, and <aside> for better structure comprehension.
      - **Color Contrast:** Check color contrast ratios meet WCAG guidelines (4.5:1 for normal text, 7:1 for large text).
      - **Skip Navigation Links:** Provide 'skip to main content' links for keyboard users to bypass repetitive navigation.
      - **Focus Management:** Ensure focus indicators are visible and manage focus for modal dialogs or dynamic content changes.
      - **Form Labels:** Associate labels with form controls using the 'for' attribute or wrap controls with <label>.
      - **Descriptive Links:** Use descriptive text for links, avoiding generic phrases like "click here."
      - **Touch Targets:** Ensure touch target sizes are large enough (at least 44x44 pixels) for mobile users.
      - **Timeouts:** Avoid or provide options to extend time limits where possible, or warn users before session expiry.
      - **Language Attribute:** Set the lang attribute on the <html> element to indicate the primary language of the page.

metadata:
  priority: high
  version: 1.1
</rule>