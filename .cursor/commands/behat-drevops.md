# Custom Command: Behat DrevOps

## Command Usage
`/behat-drevops <task>`

Treat `<task>` as the description of the Behat scenario the user wants. The remainder of this guide explains how to fulfil that request.

## Role definition

You are behat test writer, implement the test requested as {$ARGUMENT}

### DrevOps Behat Steps Integration
For Drupal projects using the `drevops/behat-steps` library, which provides comprehensive Behat step definitions. When available in `vendor/drevops/behat-steps/`, use these pre-built steps.

### Available Behat Traits from DrevOps
When writing custom Behat tests, check for these available traits:

#### Common Traits
- `ContentTrait` - Content management steps
- `FieldTrait` - Field interaction steps
- `FileTrait` - File handling steps
- `PathTrait` - Path navigation steps
- `SearchApiTrait` - Search API testing steps
- `TaxonomyTrait` - Taxonomy term steps
- `WaitTrait` - Wait conditions steps
- `WatchdogTrait` - Watchdog/logging steps

#### Additional Available Traits
- `BigPipeTrait` - BigPipe functionality testing
- `BlockContentTrait` - Block content management
- `BlockTrait` - Block placement and configuration
- `CookieTrait` - Cookie manipulation
- `DateTrait` - Date field handling
- `DraggableViewsTrait` - Draggable views testing
- `EckTrait` - Entity Construction Kit support
- `ElementTrait` - DOM element interactions
- `EmailTrait` - Email testing capabilities
- `FileDownloadTrait` - File download verification
- `JsTrait` - JavaScript execution
- `KeyboardTrait` - Keyboard interaction
- `LinkTrait` - Link verification
- `MediaTrait` - Media entity handling
- `MenuTrait` - Menu system testing
- `MetaTagTrait` - Meta tag verification
- `OverrideTrait` - Override functionality
- `ParagraphsTrait` - Paragraphs field testing
- `ResponseTrait` - HTTP response assertions
- `RoleTrait` - User role management
- `SelectTrait` - Select field interactions
- `TestmodeTrait` - Test mode utilities
- `UserTrait` - User management
- `VisibilityTrait` - Element visibility checks
- `WysiwygTrait` - WYSIWYG editor testing

### Writing Behat Tests - Best Practices

#### 1. Step Format Guidelines
```gherkin
# Use descriptive placeholder names
Given I am viewing the "About Us" page content
When I fill in "Title" with "New Page Title"
Then I should see the text "Successfully created"

# Use "the following" for table data
When I create nodes with the following details:
  | title           | type    | status |
  | About Page      | page    | 1      |
  | Contact Page    | page    | 1      |

# Use "with" for properties
Given I am logged in as a user with the "administrator" role
```

#### User Authentication in Behat Tests

**Important**: When creating users in Behat tests, follow these guidelines:

1. **Always include password field** when creating users:
   ```gherkin
   Given users:
     | name         | mail               | pass     | roles                    |
     | admin_user   | admin@example.com  | password | administrator            |
     | editor_user  | editor@example.com | password | content_editor           |
     | basic_user   | user@example.com   | password |                          |
   ```

2. **Never manually assign "authenticated" role**:
   - ❌ Wrong: `| basic_user | user@example.com | password | authenticated |`
   - ✅ Correct: `| basic_user | user@example.com | password | |`
   - The "authenticated" role is automatically assigned by Drupal

3. **Common user creation patterns**:
   ```gherkin
   # Background section for multiple scenarios
   Background:
     Given users:
       | name                  | mail                       | pass     | roles                         |
       | site_admin_user       | site_admin@example.com     | password | civictheme_site_administrator |
       | content_editor_user   | editor@example.com         | password | civictheme_content_author     |
       | no_role_user          | basic@example.com          | password |                               |
   
   # Using the created users
   Scenario: Admin can access restricted pages
     Given I am logged in as "site_admin_user"
     When I go to "/admin/structure"
     Then I should not see "Access denied"
   ```

4. **Login methods**:
   ```gherkin
   # Login as created user
   Given I am logged in as "username_from_table"
   
   # Login with role
   Given I am logged in as a user with the "administrator" role
   
   # Anonymous user
   Given I am an anonymous user
   ```

#### 2. Step Type Conventions

**Given Steps** (Prerequisites):
```gherkin
Given I am logged in as a user with the "administrator" role
Given "page" content exists with the title "Home Page"
Given I have a "article" content type
```

**When Steps** (Actions):
```gherkin
When I visit "node/add/page"
When I fill in "Title" with "Test Page"
When I press "Save"
When I click "Add content"
```

**Then Steps** (Assertions):
```gherkin
Then I should see the text "Page created"
Then I should not see "Access denied"
Then the response status code should be 200
Then the "Title" field should contain "Test Page"
```

### Running Behat Tests

```bash
# Run all Behat tests
ahoy test-behat

# Run specific feature
ahoy test-behat tests/behat/features/content.feature

# Run tests with specific tag
ahoy test-behat --tags=@api

# Run tests excluding a tag
ahoy test-behat --tags='~@skipped'

# Run with specific profile
ahoy test-behat -p p0
```

### Debugging Behat Tests

1. **Add Screenshots**:
   ```gherkin
   Then save screenshot
   # Screenshots saved to .logs/screenshots/
   ```

2. **Pause Execution**:
   ```gherkin
   Then I break
   # Pauses test execution for debugging
   ```

3. **Check Element Visibility**:
   ```gherkin
   Then I wait for the "#edit-title" element to appear
   Then I wait 5 seconds for the ".banner" element to appear
   ```

4. **Debug JavaScript**:
   ```gherkin
   Then I execute javascript "console.log(jQuery('.tabs').length)"
   ```

### Behat Configuration Notes

Common `behat.yml` configuration includes:
- Screenshot capture on failure
- JUnit output for CI integration
- Parallel testing profiles
- Chrome/Selenium integration for JavaScript tests

### Adding Custom Behat Steps

When you need custom steps not provided by DrevOps Behat Steps:

1. Add to `tests/behat/bootstrap/FeatureContext.php`
2. Follow existing patterns in the file
3. Use proper PHPDoc annotations
4. Include proper error handling

Example:
```php
/**
 * Verifies custom element is displayed.
 *
 * @Then I should see the custom element
 */
public function iShouldSeeTheCustomElement(): void {
  $element = $this->getSession()->getPage()->find('css', '.custom-element');
  if (!$element || !$element->isVisible()) {
    throw new \Exception('Custom element is not visible');
  }
}
```

### Common Behat Issues and Solutions

#### 1. WYSIWYG/CKEditor Fields
When testing forms with WYSIWYG editors (like CKEditor):

**Problem**: Standard field filling doesn't work with CKEditor fields
```gherkin
# This may fail:
And I fill in "Body" with "Content text"
```

**Solution**: Use the WysiwygTrait from DrevOps
```php
// In FeatureContext.php, add:
use DrevOps\BehatSteps\WysiwygTrait;

class FeatureContext extends DrupalContext {
  use WysiwygTrait;
  // ... other traits
}
```

Then use the WYSIWYG-specific step:
```gherkin
And I fill in WYSIWYG "Body" with "This content will be properly filled in CKEditor"
```

#### 2. Multi-Domain Sites
For sites with multiple domains (like WorkSafe/Consumer Protection):

**Problem**: Domain selection uses radio buttons, not checkboxes
```gherkin
# Wrong:
And I check "WorkSafe"

# Correct:
And I select the radio button "WorkSafe"
```

#### 3. Media Bundle Names
When creating media entities, use the correct bundle names:

**Problem**: Generic bundle names may not exist
```gherkin
# This may fail:
Given media:
  | name            | bundle   |
  | test-doc.pdf    | document |
```

**Solution**: Use the actual bundle name from your site
```gherkin
Given media:
  | name            | bundle              |
  | test-doc.pdf    | civictheme_document |
```

#### 4. File System Configuration
For sites with private file system:

**Problem**: Creating files with public:// when system uses private://
```gherkin
# May fail if system is configured for private files:
Given files:
  | uri                    |
  | public://test-doc.pdf  |
```

**Solution**: Use private:// URI scheme
```gherkin
Given files:
  | uri                     |
  | private://test-doc.pdf  |
```

#### 5. Testing Without Form Submission
When form submission fails, break down the test:

```gherkin
# Instead of one large scenario, split into:
Scenario: Verify form fields exist
  Then I should see the field "Title"
  And I should see the field "Body"

Scenario: Test form submission
  When I fill in "Title" with "Test"
  And I fill in WYSIWYG "Body" with "Content"
  And I press "Save"
  Then I should see "has been created"
```

#### 6. Conditional Steps for Flexible Tests
Add conditional steps in FeatureContext.php for more resilient tests:

```php
/**
 * Click on the first matching element if it exists.
 *
 * @When I click on the first :selector element if it exists
 */
public function iClickOnTheFirstElementIfItExists($selector): void {
  $elements = $this->getSession()->getPage()->findAll('css', $selector);
  
  // If no elements exist, that's okay - just skip
  if (empty($elements)) {
    return;
  }
  
  // Click the first element
  $elements[0]->click();
}
```

Use in tests:
```gherkin
# Won't fail if no publications exist yet
When I click on the first ".ct-list__content a" element if it exists
```

#### 7. URL Patterns and Path Aliases
Be aware that Drupal may use path aliases:

```gherkin
# Instead of assuming /node/123 format:
And the url should match "\/node\/\d+"

# Check for the actual alias pattern:
And the url should match "\/publications\/[\w-]+"
```

#### 8. Status Code Checks with JavaScript Drivers
Status code assertions don't work with Selenium/JavaScript drivers:

```gherkin
# This will fail with Selenium:
Then the response status code should be 200

# Use content-based verification instead:
Then I should see "Expected page content"
And I should not see "Access denied"
```

#### 9. Running Specific Scenarios
To run a single scenario during development:
```bash
# Run scenario starting at line 33
docker compose exec cli vendor/bin/behat tests/behat/features/file.feature:33
```

#### 10. Debugging Failed Tests
Always check screenshots when tests fail:
```bash
# Check latest screenshots
ls -la .logs/screenshots/ | tail -5

# Use Playwright to view screenshots
mcp__playwright__browser_navigate with file:// URL
