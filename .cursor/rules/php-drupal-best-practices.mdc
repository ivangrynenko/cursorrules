---
description: PHP & Drupal Development Standards and Best Practices
globs: *.php, *.module, *.theme, *.inc, *.info, *.install
---
# Enhanced PHP & Drupal Development Standards

Defines comprehensive coding standards and best practices for PHP and Drupal development, with a focus on modern PHP features, Drupal 10+ standards, and modularity.

<rule>
name: enhanced_php_drupal_best_practices
description: Enforce PHP 8.3+ features, Drupal 10+ coding standards, and modularity
filters:
  - type: file_extension
    pattern: "\\.(php|module|inc|install|theme)$"
  - type: file_path
    pattern: "web/modules/custom/|web/themes/custom/"

actions:
  - type: enforce
    conditions:
      - pattern: "^(?!declare\\(strict_types=1\\);)"
        message: "Add 'declare(strict_types=1);' at the beginning of PHP files for type safety."

      - pattern: "(?<!\\bTRUE\\b)\\btrue\\b|(?<!\\bFALSE\\b)\\bfalse\\b|(?<!\\bNULL\\b)\\bnull\\b"
        message: "Use uppercase for TRUE, FALSE, and NULL constants."

      - pattern: "(?i)\\/\\/\\s[a-z]"
        message: "Ensure inline comments begin with a capital letter and end with a period."

      - pattern: "class\\s+\\w+\\s*(?!\\{[^}]*readonly\\s+\\$)"
        message: "Consider using readonly properties where immutability is required."

      - pattern: "public\\s+function\\s+\\w+\\([^)]*\\)\\s*(?!:)"
        message: "Add return type declarations for all methods to ensure type safety."

      - pattern: "extends\\s+\\w+\\s*\\{[^}]*public\\s+function\\s+\\w+\\([^)]*\\)\\s*(?!#\\[Override\\])"
        message: "Add #[Override] attribute for overridden methods for clarity."

      - pattern: "\\$\\w+\\s*(?!:)"
        message: "Use typed properties with proper nullability for better code maintainability."

      - pattern: "function\\s+hook_\\w+\\([^)]*\\)\\s*(?!:)"
        message: "Add type hints and return types for all hooks to leverage PHP's type system."

      - pattern: "new\\s+\\w+\\([^)]*\\)\\s*(?!;\\s*//\\s*@inject)"
        message: "Use proper dependency injection with services for better testability and modularity."

      - pattern: "extends\\s+FormBase\\s*\\{[^}]*validate"
        message: "Implement proper form validation in FormBase classes for security."

      - pattern: "function\\s+\\w+\\s*\\([^)]*\\)\\s*\\{[^}]*\\$this->t\\("
        message: "Use Drupal's t() function for strings that need translation."

      - pattern: "\\$this->config\\('\\w+'\\)"
        message: "Use ConfigFactory for configuration management."
      
      - pattern: "array\\s*\\("
        message: "Use short array syntax ([]) instead of array() for consistent code style."
      
      - pattern: "(?<!\\()\\s+\\(int\\)\\s*\\$"
        message: "Put a space between the (type) and the $variable in a cast: (int) $mynumber."
      
      - pattern: "\\n[\\t ]+\\n"
        message: "Remove whitespace from empty lines."
      
      - pattern: "\\s+$"
        message: "Remove trailing whitespace at the end of lines."
      
      - pattern: "^(?!.*\\n$)"
        message: "Ensure files end with a single newline character."
      
      - pattern: "if\\s*\\([^)]*\\)\\s*\\{[^{]*\\}\\s*else\\s*\\{"
        message: "Place the opening brace on the same line as the statement for control structures."
      
      - pattern: "\\$_GET|\\$_POST|\\$_REQUEST"
        message: "Never use superglobals directly; use Drupal's input methods."
      
      - pattern: "mysql_|mysqli_"
        message: "Use Drupal's database API instead of direct MySQL functions."
      
      - pattern: "\\t+"
        message: "Use 2 spaces for indentation, not tabs."
      
      - pattern: "function\\s+\\w+\\s*\\([^)]*\\)\\s*\\{[^}]*\\becho\\b"
        message: "Don't use echo; use return values or Drupal's messenger service."
      
      - pattern: "(?<!\\/\\*\\*)\\s*\\*\\s+@"
        message: "Use proper DocBlock formatting for documentation."
      
      - pattern: "\\bdie\\b|\\bexit\\b"
        message: "Don't use die() or exit(); throw exceptions instead."
      
      - pattern: "\\$entity->get\\([^)]+\\)->getValue\\(\\)"
        message: "Use $entity->get('field_name')->value instead of getValue() when possible."
      
      - pattern: "\\bvar_dump\\b|\\bprint_r\\b|\\bdump\\b"
        message: "Don't use debug functions in production code; use Drupal's logger instead."
      
      - pattern: "\\bnew\\s+DateTime\\b"
        message: "Use Drupal's DateTimeInterface and DrupalDateTime instead of PHP's DateTime."
      
      - pattern: "\\beval\\b"
        message: "Never use eval() as it poses security risks."
      
      - pattern: "function\\s+\\w+_menu_callback\\("
        message: "Use controller classes with route definitions instead of hook_menu() callbacks."
      
      - pattern: "\\/\\*\\*(?:[^*]|\\*[^/])*?@file(?:[^*]|\\*[^/])*?\\*\\/"
        message: "All PHP files must include proper @file documentation in the docblock."
      
      - pattern: "function\\s+\\w+\\s*\\((?:[^)]|\\([^)]*\\))*\\)\\s*\\{(?:[^}]|\\{[^}]*\\})*\\$_SESSION"
        message: "Use Drupal's user session handling instead of $_SESSION."
      
      - pattern: "function\\s+theme_\\w+\\("
        message: "Theme functions should be replaced with Twig templates in Drupal 8+."
      
      - pattern: "drupal_add_js|drupal_add_css"
        message: "Use #attached in render arrays instead of drupal_add_js() or drupal_add_css()."
      
      - pattern: "function\\s+\\w+_implements_hook_\\w+\\("
        message: "Use proper hook implementation format: module_name_hook_name()."
        
      - pattern: "use\\s+[^;]+,\\s*[^;]+"
        message: "Specify a single class per use statement. Do not specify multiple classes in a single use statement."
        
      - pattern: "use\\s+\\\\[A-Za-z]"
        message: "When importing a class with 'use', do not include a leading backslash (\\)."
        
      - pattern: "\\bnew\\s+\\\\DateTime\\(\\)"
        message: "Non-namespaced global classes (like Exception) must be fully qualified with a leading backslash (\\) when used in a namespaced file."
        
      - pattern: "(?<!namespace )Drupal\\\\(?!\\w+\\\\)"
        message: "Modules should place classes inside a custom namespace: Drupal\\module_name\\..."
        
      - pattern: "class\\s+\\w+\\s*(?:extends|implements)(?:[^{]+)\\{\\s*[^\\s]"
        message: "Leave an empty line between start of class/interface definition and property/method definition."
        
      - pattern: "Drupal\\\\(?!Core|Component)[A-Z]"
        message: "Module namespaces should be Drupal\\module_name, not Drupal\\ModuleName (camelCase not PascalCase)."
        
      - pattern: "\\\\Drupal::request\\(\\)->attributes->set\\('([^_][^']*)',"
        message: "Request attributes added by modules should be prefixed with underscore (e.g., '_context_value')."
        
      - pattern: "\\\\Drupal::request\\(\\)->attributes->get\\('(_(system_path|title|route|route_object|controller|content|account))'\\)"
        message: "Avoid overwriting reserved Symfony or Drupal core request attributes."
        
      - pattern: "(?<!service provider)\\s+class\\s+\\w+Provider(?!Interface)"
        message: "Classes that provide services should use the 'Provider' suffix (e.g., MyServiceProvider)."
        
      - pattern: "\\.services\\.yml[^}]*\\s+class:\\s+[^\\n]+\\s+arguments:"
        message: "Services should use dependency injection through constructor arguments defined in services.yml."

  - type: suggest
    message: |
      **PHP/Drupal Development Best Practices:**
      
      ### General Code Structure
      - **File Structure:** Each PHP file should have the proper structures: <?php tag, namespace declaration (if applicable), use statements, docblock, and implementation.
      - **Line Length:** Keep lines under 80 characters whenever possible.
      - **Indentation:** Use 2 spaces for indentation, never tabs.
      - **Empty Lines:** Use empty lines to separate logical blocks of code, but avoid multiple empty lines.
      - **File Endings:** All files must end with a single newline character.
      
      ### PHP Language Features
      - **PHP Version:** Use PHP 8.3+ features where appropriate.
      - **Strict Types:** Use declare(strict_types=1) at the top of files to enforce type safety.
      - **Type Hints:** Always use parameter and return type hints.
      - **Named Arguments:** Use named arguments for clarity in complex function calls.
      - **Attributes:** Use PHP 8 attributes like #[Override] for better code comprehension.
      - **Match Expressions:** Prefer match over switch for cleaner conditionals.
      - **Null Coalescing:** Use ?? and ??= operators where appropriate.
      
      ### Drupal-Specific Standards
      - **Fields API:** Use hasField(), get(), and value() methods when working with entity fields.
      - **Exception Handling:** Use try/catch for exception handling with proper logging.
      - **Database Layer:** Use Drupal's database abstraction layer for all queries.
      - **Schema Updates:** Implement hook_update_N() for schema changes during updates.
      - **Dependency Injection:** Use services.yml and proper container injection.
      - **Routing:** Define routes in routing.yml with proper access checks.
      - **Forms:** Extend FormBase or ConfigFormBase with proper validation and submission handling.
      - **Entity API:** Follow entity API best practices for loading, creating, and editing entities.
      - **Plugins:** Use plugin system appropriately with proper annotations.
      
      ### Service & Request Standards
      - **Service Naming:** Use descriptive service names and appropriate naming patterns (Provider suffix for service providers).
      - **Service Definition:** Define services in the module's *.services.yml file with appropriate tags and arguments.
      - **Request Attributes:** When adding attributes to the Request object, prefix custom attributes with underscore (e.g., `_context_value`).
      - **Reserved Attributes:** Avoid overwriting core-reserved request attributes like `_system_path`, `_title`, `_account`, `_route`, `_route_object`, `_controller`, `_content`.
      - **Service Container:** Use dependency injection rather than the service container directly.
      - **Factory Services:** Use factory methods for complex service instantiation.
      
      ### Namespace Standards
      - **Module Namespace:** Use Drupal\\module_name\\... for all custom module code.
      - **PSR-4 Autoloading:** Class in folder module/src/SubFolder should use namespace Drupal\\module_name\\SubFolder.
      - **Use Statements:** Each class should have its own use statement; don't combine multiple classes in one use.
      - **No Leading Backslash:** Don't add a leading backslash (\\) in use statements.
      - **Global Classes:** Global classes (like Exception) must be fully qualified with a leading backslash (\\) when used in a namespaced file.
      - **Class Aliasing:** Only alias classes to avoid name collisions, using meaningful names like BarBaz and ThingBaz.
      - **String Class Names:** When specifying a class name in a string, use full name including namespace without leading backslash. Prefer single quotes.
      - **Class Placement:** A class named Drupal\\module_name\\Foo should be in file module_name/src/Foo.php.
      
      ### Security Practices
      - **Input Validation:** Always validate and sanitize user input.
      - **Access Checks:** Implement proper access checks for all routes and content.
      - **CSRF Protection:** Use Form API with proper form tokens for all forms.
      - **SQL Injection:** Use parameterized queries with placeholders.
      - **XSS Prevention:** Use Xss::filter() or t() with appropriate placeholders.
      - **File Security:** Validate uploaded files and restrict access properly.
      
      ### Documentation and Comments
      - **PHPDoc Blocks:** Document all classes, methods, and properties with proper PHPDoc.
      - **Function Comments:** Describe parameters, return values, and exceptions.
      - **Inline Comments:** Use meaningful comments for complex logic.
      - **Comment Format:** Begin comments with a capital letter and end with a period.
      - **API Documentation:** Follow Drupal's API documentation standards.
      
      ### Performance
      - **Caching:** Implement proper cache tags, contexts, and max-age.
      - **Database Queries:** Optimize queries with proper indices and JOINs.
      - **Lazy Loading:** Use lazy loading for expensive operations.
      - **Batch Processing:** Use batch API for long-running operations.
      - **Static Caching:** Implement static caching for repeated operations.
      
      ### Testing
      - **Unit Tests:** Write PHPUnit tests for business logic.
      - **Kernel Tests:** Use kernel tests for integration with Drupal subsystems.
      - **Functional Tests:** Implement functional tests for user interactions.
      - **Mocking:** Use proper mocking techniques for dependencies.
      - **Test Coverage:** Aim for high test coverage of critical functionality.
      
      ### API Documentation Examples
      
      #### File Documentation
      
      **Module Files (.module)**
      ```php
      <?php
      
      /**
       * @file
       * Provides [module functionality description].
       */
      ```
      
      **Install Files (.install)**
      ```php
      <?php
      
      /**
       * @file
       * Install, update and uninstall functions for the [module name] module.
       */
      ```
      
      **Include Files (.inc)**
      ```php
      <?php
      
      /**
       * @file
       * [Specific functionality] for the [module name] module.
       */
      ```
      
      **Class Files (in namespaced directories)**
      ```php
      <?php
      
      namespace Drupal\module_name\ClassName;
      
      use Drupal\Core\SomeClass;
      
      /**
       * Provides [class functionality description].
       *
       * [Extended description if needed]
       */
      class ClassName implements InterfaceName {
      ```
      
      #### Function Documentation
      
      **Standard Function**
      ```php
      /**
       * Returns [what the function returns or does].
       *
       * [Additional explanation if needed]
       *
       * @param string $param1
       *   Description of parameter.
       * @param int $param2
       *   Description of parameter.
       *
       * @return array
       *   Description of returned data.
       *
       * @throws \Exception
       *   Exception thrown when [condition].
       *
       * @see related_function()
       */
      function module_function_name($param1, $param2) {
      ```
      
      **Hook Implementation**
      ```php
      /**
       * Implements hook_form_alter().
       */
      function module_name_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
      ```
      
      **Update Hook**
      ```php
      /**
       * Implements hook_update_N().
       *
       * [Description of what the update does].
       */
      function module_name_update_8001() {
      ```
      
      #### Class Documentation
      
      **Class Properties**
      ```php
      /**
       * The entity type manager.
       *
       * @var \Drupal\Core\Entity\EntityTypeManagerInterface
       */
      protected $entityTypeManager;
      ```
      
      **Method Documentation**
      ```php
      /**
       * Gets entities of a specific type.
       *
       * @param string $entity_type
       *   The entity type ID.
       * @param array $conditions
       *   (optional) An array of conditions to match. Defaults to an empty array.
       *
       * @return \Drupal\Core\Entity\EntityInterface[]
       *   An array of entity objects indexed by their IDs.
       *
       * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
       *   Thrown if the entity type doesn't exist.
       * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
       *   Thrown if the storage handler couldn't be loaded.
       */
      public function getEntities(string $entity_type, array $conditions = []): array {
      ```
      
      **Interface Method**
      ```php
      /**
       * Implements \SomeInterface::methodName().
       */
      public function methodName() {
      ```
      
      #### Namespace Examples
      
      **Using Classes From Other Namespaces**
      ```php
      namespace Drupal\mymodule\Tests\Foo;
      
      use Drupal\simpletest\WebTestBase;
      
      /**
       * Tests that the foo bars.
       */
      class BarTest extends WebTestBase {
      ```
      
      **Class Aliasing for Name Collisions**
      ```php
      use Foo\Bar\Baz as BarBaz;
      use Stuff\Thing\Baz as ThingBaz;
      
      /**
       * Tests stuff for the whichever.
       */
      function test() {
        $a = new BarBaz(); // This will be Foo\Bar\Baz
        $b = new ThingBaz(); // This will be Stuff\Thing\Baz
      }
      ```
      
      **Using Global Classes in Namespaced Files**
      ```php
      namespace Drupal\Subsystem;
      
      // Bar is a class in the Drupal\Subsystem namespace in another file.
      // It is already available without any importing.
      
      /**
       * Defines a Foo.
       */
      class Foo {
      
        /**
         * Constructs a new Foo object.
         */
        public function __construct(Bar $b) {
          // Global classes must be prefixed with a \ character.
          $d = new \DateTime();
        }
      }
      ```
      
      #### Service Definition Example
      
      **services.yml File**
      ```yaml
      services:
        mymodule.my_service:
          class: Drupal\mymodule\MyService
          arguments: ['@entity_type.manager', '@current_user']
          tags:
            - { name: cache.context }
      ```
      
      **Request Attribute Handling**
      ```php
      // Correctly adding a request attribute (with underscore prefix)
      \Drupal::request()->attributes->set('_context_value', $myvalue);
      
      // Correctly retrieving a request attribute
      $contextValue = \Drupal::request()->attributes->get('_context_value');
      ```

  - type: validate
    conditions:
      - pattern: "web/modules/custom/[^/]+/\\.info\\.yml$"
        message: "Ensure each custom module has a required .info.yml file."

      - pattern: "web/modules/custom/[^/]+/\\.module$"
        message: "Ensure module has .module file if hooks are implemented."

      - pattern: "web/modules/custom/[^/]+/src/Form/\\w+Form\\.php$"
        message: "Place form classes in the Form directory for organization."

      - pattern: "try\\s*\\{[^}]*\\}\\s*catch\\s*\\([^)]*\\)\\s*\\{\\s*\\}"
        message: "Implement proper exception handling in catch blocks."
      
      - pattern: "namespace\\s+Drupal\\\\(?!\\w+\\\\)"
        message: "Namespace should be Drupal\\ModuleName\\..."
      
      - pattern: "class\\s+[^\\s]+\\s+implements\\s+[^\\s]+Interface"
        message: "Follow PSR-4 for class naming and organization."
      
      - pattern: "\\*\\s+@return\\s+[a-z]+\\|null"
        message: "Use nullable return types (e.g., ?string) instead of type|null in docblocks."
      
      - pattern: "function\\s+__construct\\([^)]*\\)\\s*\\{[^}]*parent::"
        message: "Call parent::__construct() if extending a class with a constructor."
      
      - pattern: "function\\s+[gs]et[A-Z]\\w+\\("
        message: "Use camelCase for method names (e.g., getId instead of get_id)."
      
      - pattern: "\\/\\*\\*(?:(?!\\@file).)*?\\*\\/"
        message: "Add proper @file docblock for PHP files."
      
      - pattern: "function\\s+hook_[a-z0-9_]+\\("
        message: "Replace 'hook_' prefix with your module name in hook implementations."
      
      - pattern: "(?<!\\s\\*)\\s+@(?:param|return|throws)\\b"
        message: "DocBlock tags should be properly aligned with leading asterisks."
      
      - pattern: "@param\\s+(?!(?:array|bool|callable|float|int|mixed|object|resource|string|void|null|\\\\)[\\s|])"
        message: "Use proper data types in @param tags (array, bool, int, string, etc.)."
      
      - pattern: "@return\\s+(?!(?:array|bool|callable|float|int|mixed|object|resource|string|void|null|\\\\)[\\s|])"
        message: "Use proper data types in @return tags (array, bool, int, string, etc.)."
      
      - pattern: "\\*\\s*@param[^\\n]*?(?:(?!\\s{3,})[^\\n])*$"
        message: "Parameter description should be separated by at least 3 spaces from the param type/name."
      
      - pattern: "function\\s+theme\\w+\\([^)]*\\)\\s*\\{[^}]*?(?!\\@ingroup\\s+themeable)"
        message: "Theme functions should include @ingroup themeable in their docblock."
      
      - pattern: "\\*\\s*@code(?!\\s+[a-z]+\\s+)"
        message: "@code blocks should specify the language (e.g., @code php)."
      
      - pattern: "namespace\\s+(?!Drupal\\\\)"
        message: "Namespaces should start with 'Drupal\\'."
        
      - pattern: "web/modules/custom/[^/]+/\\.services\\.yml$"
        message: "Every module using services should have a services.yml file."
      
      - pattern: "web/modules/custom/[^/]+/src/[^/]+Provider\\.php$"
        message: "Service providers should be in the module's root namespace (src/ directory)."

metadata:
  priority: critical
  version: 1.5
</rule>