<?php
/**
 * Cursor Rules Installer Script.
 * 
 * This script downloads and installs Cursor rules into your project's .cursor/rules directory.
 * It provides interactive prompts to select which rule sets to install based on project type.
 * 
 * CLI Options:
 * --web-stack, -w: Install core, web, and Drupal rules
 * --python, -p: Install core and Python rules
 * --all, -a: Install all rule sets
 * --core, -c: Install only core rules
 * --custom: Enable selective installation (interactive)
 * --tags: Filter rules by tag expression (e.g., "language:php category:security")
 * --tags: Filter rules by tag expression (e.g., "language:php category:security")
 * --help, -h: Display help information
 * --quiet, -q: Suppress verbose output
 * --yes, -y: Automatically confirm all prompts
 */

declare(strict_types=1);

// Define constants.
define('CURSOR_RULES_VERSION', '1.0.2');
define('CURSOR_RULES_DIR', '.cursor/rules');
define('CURSOR_DIR', '.cursor');

const COLORS = [
    'red' => "\033[0;31m",
    'green' => "\033[0;32m",
    'yellow' => "\033[1;33m",
    'blue' => "\033[0;34m",
    'magenta' => "\033[0;35m",
    'cyan' => "\033[0;36m",
    'white' => "\033[1;37m",
    'reset' => "\033[0m",
];

// Define tag presets for common use cases
const TAG_PRESETS = [
    'web' => 'language:javascript OR language:html OR language:css OR language:php',
    'frontend' => 'language:javascript OR language:html OR language:css',
    'drupal' => 'framework:drupal',
    'react' => 'framework:react',
    'vue' => 'framework:vue',
    'python' => 'language:python',
    'security' => 'category:security',
    'owasp' => 'standard:owasp-top10',
    'a11y' => 'category:accessibility',
    // New language-specific security presets
    'php-security' => 'language:php category:security',
    'js-security' => 'language:javascript category:security',
    'python-security' => 'language:python category:security',
    'drupal-security' => 'framework:drupal category:security',
    'php-owasp' => 'language:php standard:owasp-top10',
    'js-owasp' => 'language:javascript standard:owasp-top10',
    'python-owasp' => 'language:python standard:owasp-top10',
    'drupal-owasp' => 'framework:drupal standard:owasp-top10',
];

// Define tag presets for common use cases
const TAG_PRESETS = [
    'web' => 'language:javascript OR language:html OR language:css OR language:php',
    'frontend' => 'language:javascript OR language:html OR language:css',
    'drupal' => 'framework:drupal',
    'react' => 'framework:react',
    'vue' => 'framework:vue',
    'python' => 'language:python',
    'security' => 'category:security',
    'owasp' => 'standard:owasp-top10',
    'a11y' => 'category:accessibility',
    // New language-specific security presets
    'php-security' => 'language:php category:security',
    'js-security' => 'language:javascript category:security',
    'python-security' => 'language:python category:security',
    'drupal-security' => 'framework:drupal category:security',
    'php-owasp' => 'language:php standard:owasp-top10',
    'js-owasp' => 'language:javascript standard:owasp-top10',
    'python-owasp' => 'language:python standard:owasp-top10',
    'drupal-owasp' => 'framework:drupal standard:owasp-top10',
];

// Main function to install cursor rules.
function install_cursor_rules(array $options = []): bool {
  // Default options.
  $default_options = [
    'debug' => false,
    'copy_only' => false,
    'destination' => CURSOR_RULES_DIR,
    'web_stack' => false,
    'python' => false,
    'javascript' => false,
    'tags' => false,
    'tag-preset' => false,
    'ignore-files' => 'yes',
    'all' => false,
    'core' => false,
    'yes' => false,
    'help' => false,
  ];

  // Merge options.
  $options = array_merge($default_options, $options);
  
  // Show help if requested.
  if ($options['help']) {
    show_help();
    return true;
  }
  
  // Check for conflicting options.
  $option_count = 0;
  if ($options['web_stack']) $option_count++;
  if ($options['python']) $option_count++;
  if ($options['javascript']) $option_count++;
  if ($options['all']) $option_count++;
  if ($options['core']) $option_count++;
  if ($options['tags']) $option_count++;
  if ($options['tag-preset']) $option_count++;
  
  if ($option_count > 1) {
    echo "Error: Conflicting options. Please choose only one installation type.\n";
    echo "Run with --help for usage information.\n";
    return false;
  }
  
  // Debug mode.
  if ($options['debug']) {
    echo "Debug mode enabled\n";
    echo "Options: " . print_r($options, true) . "\n";
  }
  
  // Create destination directory if it doesn't exist.
  if (!is_dir($options['destination'])) {
    if (!mkdir($options['destination'], 0755, true)) {
      echo "Error: Failed to create directory: {$options['destination']}\n";
      return false;
    }
    
    if ($options['debug']) {
      echo "Created directory: {$options['destination']}\n";
    }
  }
  
  // Create .cursor directory if it doesn't exist.
  if (!is_dir(CURSOR_DIR)) {
    if (!mkdir(CURSOR_DIR, 0755, true)) {
      echo "Error: Failed to create directory: " . CURSOR_DIR . "\n";
      return false;
    }
    
    if ($options['debug']) {
      echo "Created directory: " . CURSOR_DIR . "\n";
    }
  }
  
  // Create UPDATE.md file in .cursor directory.
  $update_file = CURSOR_DIR . '/UPDATE.md';
  if (!file_exists($update_file)) {
    file_put_contents($update_file, "Version " . CURSOR_RULES_VERSION);
    if ($options['debug']) {
      echo "Created file: $update_file\n";
    }
  }
  
  // Define rule files by category.
  $core_rules = [
    'cursor-rules.mdc',
    'improve-cursorrules-efficiency.mdc',
    'git-commit-standards.mdc',
    'readme-maintenance-standards.mdc',
    'github-actions-standards.mdc',
    'testing-guidelines.mdc',
  ];
  
  $web_stack_rules = [
    'accessibility-standards.mdc',
    'api-standards.mdc',
    'build-optimization.mdc',
    'javascript-performance.mdc',
    'javascript-standards.mdc',
    'node-dependencies.mdc',
    'react-patterns.mdc',
    'tailwind-standards.mdc',
    'third-party-integration.mdc',
    'vue-best-practices.mdc',
    'security-practices.mdc',
    'php-drupal-best-practices.mdc',
    'drupal-database-standards.mdc',
    'govcms-saas.mdc',
    'drupal-broken-access-control.mdc',
    'drupal-cryptographic-failures.mdc',
    'drupal-injection.mdc',
    'drupal-insecure-design.mdc',
    'drupal-security-misconfiguration.mdc',
    'drupal-vulnerable-components.mdc',
    'drupal-authentication-failures.mdc',
    'drupal-integrity-failures.mdc',
    'drupal-logging-failures.mdc',
    'drupal-ssrf.mdc',
  ];
  
  $python_rules = [
    'python-broken-access-control.mdc',
    'python-cryptographic-failures.mdc',
    'python-injection.mdc',
    'python-insecure-design.mdc',
    'python-security-misconfiguration.mdc',
    'python-vulnerable-outdated-components.mdc',
    'python-authentication-failures.mdc',
    'python-integrity-failures.mdc',
    'python-logging-monitoring-failures.mdc',
    'python-ssrf.mdc',
  ];
  
  $javascript_rules = [
    'javascript-broken-access-control.mdc',
    'javascript-cryptographic-failures.mdc',
    'javascript-injection.mdc',
    'javascript-insecure-design.mdc',
    'javascript-security-misconfiguration.mdc',
    'javascript-vulnerable-outdated-components.mdc',
    'javascript-identification-authentication-failures.mdc',
    'javascript-software-data-integrity-failures.mdc',
    'javascript-security-logging-monitoring-failures.mdc',
    'javascript-server-side-request-forgery.mdc',
  ];
  
  // Determine which rules to install.
  $rules_to_install = [];
  
  // Check if STDIN is available for interactive input
  $stdin_available = function_exists('stream_isatty') ? stream_isatty(STDIN) : false;
  
  // Interactive mode if no specific option is selected and not in auto-yes mode and STDIN is available
  if ($option_count === 0 && !$options['yes'] && $stdin_available) {
    echo "Welcome to Cursor Rules Installer v" . CURSOR_RULES_VERSION . "\n\n";
    echo "Please select which rules to install:\n";
    echo "1) Core rules only\n";
    echo "2) Web stack rules (PHP, Drupal, JavaScript, etc.)\n";
    echo "3) Python rules\n";
    echo "4) JavaScript rules\n";
    echo "5) All rules\n";
    echo "6) Exit\n";
    
    $valid_choice = false;
    while (!$valid_choice) {
      echo "\nEnter your choice (1-5): ";
      $choice = trim(fgets(STDIN));
      
      switch ($choice) {
        case '1':
          $rules_to_install = $core_rules;
          $valid_choice = true;
          echo "Installing core rules...\n";
          break;
        case '2':
          $rules_to_install = array_merge($core_rules, $web_stack_rules, $javascript_rules);
          $valid_choice = true;
          echo "Installing web stack rules...\n";
          if ($options['debug']) {
            echo "Selected " . count($rules_to_install) . " rules to install (" . count($core_rules) . " core + " . count($web_stack_rules) . " web stack + " . count($javascript_rules) . " JavaScript OWASP)\n";
          }
          break;
        case '3':
          $rules_to_install = array_merge($core_rules, $python_rules);
          $valid_choice = true;
          echo "Installing Python rules...\n";
          if ($options['debug']) {
            echo "Selected " . count($rules_to_install) . " rules to install (" . count($core_rules) . " core + " . count($python_rules) . " python)\n";
          }
          break;
        case '4':
          $rules_to_install = array_merge($core_rules, $javascript_rules);
          $valid_choice = true;
          echo "Installing JavaScript rules...\n";
          if ($options['debug']) {
            echo "Selected " . count($rules_to_install) . " rules to install (" . count($core_rules) . " core + " . count($javascript_rules) . " JavaScript)\n";
          }
          break;
        case '5':
          $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules, $javascript_rules);
          $valid_choice = true;
          echo "Installing all rules...\n";
          if ($options['debug']) {
            echo "Selected " . count($rules_to_install) . " rules to install (" . count($core_rules) . " core + " . count($web_stack_rules) . " web stack + " . count($python_rules) . " python + " . count($javascript_rules) . " JavaScript)\n";
          }
          break;
        case '6':
          echo "Installation cancelled.\n";
          return true;
        default:
          echo "Invalid choice. Please enter a number between 1 and 5.\n";
      }
    }
  } else if ($option_count === 0 && !$stdin_available) {
    // If STDIN is not available (e.g., when piped through curl), default to core rules
    echo "⚠️ Interactive mode not available when using curl piping (STDIN is already in use).\n";
    echo "Defaulting to core rules installation.\n\n";
    echo "For interactive installation with prompts, use the two-step process instead:\n";
    echo "1. curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php -o install.php\n";
    echo "2. php install.php\n\n";
    echo "For specific options without interactive mode, use:\n";
    echo "curl -s https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/install.php | php -- --help\n\n";
    $rules_to_install = $core_rules;
  } else if ($options['tags'] || $options['tag-preset']) {
    // Tags-based filtering will be handled during rule installation
    $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules, $javascript_rules);
    
    // Display which tag filter is being applied
    $tag_expression = '';
    if ($options['tag-preset'] && isset(TAG_PRESETS[$options['tag-preset']])) {
      $tag_expression = TAG_PRESETS[$options['tag-preset']];
      echo "Applying tag preset filter '{$options['tag-preset']}': $tag_expression\n";
    } elseif ($options['tags']) {
      $tag_expression = $options['tags'];
      echo "Applying tag filter: $tag_expression\n";
    }
  } else if ($options['all']) {
    $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules, $javascript_rules);
  } elseif ($options['web_stack']) {
    $rules_to_install = array_merge($core_rules, $web_stack_rules, $javascript_rules);
  } elseif ($options['python']) {
    $rules_to_install = array_merge($core_rules, $python_rules);
  } elseif ($options['core']) {
    $rules_to_install = $core_rules;
  } else {
    // Default to core rules if no option specified and in auto-yes mode.
    $rules_to_install = $core_rules;
  }
  
  // Find the source directory containing the rule files
  $script_dir = dirname(__FILE__);
  
  // Define a function to check if a directory contains at least some of the rule files
  function is_valid_source_dir($dir, $rule_files, $min_files = 3) {
    global $options;
    $found_files = 0;
    
    if (isset($options['debug']) && $options['debug']) {
      echo "Checking if directory is valid source: $dir\n";
      echo "Looking for at least $min_files of " . count($rule_files) . " rule files\n";
    }
    
    foreach ($rule_files as $file) {
      if (file_exists($dir . '/' . $file)) {
        $found_files++;
        if (isset($options['debug']) && $options['debug']) {
          echo "Found file: $file\n";
        }
        
        if ($found_files >= $min_files) {
          if (isset($options['debug']) && $options['debug']) {
            echo "Directory is valid: $dir (found $found_files files)\n";
          }
          
          return $dir;
        }
      }
    }
    
    if (isset($options['debug']) && $options['debug']) {
      echo "Directory is not valid: $dir (found only $found_files files)\n";
    }
    
    return null;
  }
  
  // Add debug output for rules to install
  if ($options['debug']) {
    echo "\nRules to install (" . count($rules_to_install) . " total):\n";
    foreach ($rules_to_install as $index => $rule) {
      echo ($index + 1) . ". $rule\n";
    }
    echo "\n";
  }
  
  $possible_source_dirs = [
    // Try current directory first
    getcwd() . '/.cursor/rules',
    
    // Try script directory
    $script_dir . '/.cursor/rules',
    
    // Try parent directories (up to 3 levels)
    dirname($script_dir) . '/.cursor/rules',
    dirname(dirname($script_dir)) . '/.cursor/rules',
    dirname(dirname(dirname($script_dir))) . '/.cursor/rules',
    
    // Try relative paths from common locations
    getcwd() . '/../.cursor/rules',
    getcwd() . '/../../.cursor/rules',
    $script_dir . '/../.cursor/rules',
    $script_dir . '/../../.cursor/rules',
  ];
  
  // If we're in a test environment, try to find the repository root
  if (strpos($script_dir, '.tests') !== false || strpos(getcwd(), '.tests') !== false) {
    // We're likely in a test directory, so try to find the repository root
    $test_paths = [
      dirname(dirname($script_dir)) . '/.cursor/rules', // From .tests/temp/test_dir/install.php
      dirname(dirname(dirname($script_dir))) . '/.cursor/rules', // One level deeper
      dirname(dirname(dirname(dirname($script_dir)))) . '/.cursor/rules', // Two levels deeper
    ];
    
    // Add test paths at the beginning for priority
    $possible_source_dirs = array_merge($test_paths, $possible_source_dirs);
  }
  
  // Try to download rules from GitHub if no local source is found
  $github_source = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/rules/';
  $temp_dir = sys_get_temp_dir() . '/cursor-rules-' . uniqid();
  
  // Find a valid source directory
  $source_dir = null;
  foreach ($possible_source_dirs as $dir) {
    $source_dir = is_valid_source_dir($dir, $rules_to_install);
    if ($source_dir !== null) {
      if ($options['debug']) {
        echo "Found source directory: $source_dir\n";
      }
      break;
    }
  }
  
  // Final check to ensure we have a valid source directory
  if ($source_dir === null) {
    echo "Error: Could not find source directory containing rule files.\n";
    if ($options['debug']) {
      echo "Tried the following directories:\n";
      foreach ($possible_source_dirs as $dir) {
        echo "  - $dir\n";
      }
    }
    return false;
  }
  
  $destination_dir = $options['destination'];
  
  // Ensure destination directory is not the same as source directory
  if (realpath($source_dir) === realpath($destination_dir)) {
    if ($options['debug']) {
      echo "Source and destination directories are the same, downloading from GitHub instead...\n";
    }
    
    // Create a temporary directory for downloading rules
    $temp_dir = sys_get_temp_dir() . '/cursor-rules-' . uniqid();
    if (!mkdir($temp_dir, 0755, true)) {
      echo "Error: Failed to create temporary directory.\n";
      return false;
    }
    
    $download_success = true;
    $github_source = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/rules/';
    
    // Download all rules that need to be installed
    if ($options['debug']) {
      echo "Downloading " . count($rules_to_install) . " rules from GitHub...\n";
    }
    
    foreach ($rules_to_install as $rule_file) {
      $url = $github_source . $rule_file;
      $content = @file_get_contents($url);
      
      if ($content === false) {
        if ($options['debug']) {
          echo "Failed to download: $rule_file\n";
        }
        
        // Check if the file exists locally in the destination directory
        if (file_exists($destination_dir . '/' . $rule_file)) {
          if ($options['debug']) {
            echo "File exists locally, will use local copy: $rule_file\n";
          }
          // Copy the local file to the temp directory
          copy($destination_dir . '/' . $rule_file, $temp_dir . '/' . $rule_file);
        }
        continue;
      }
      
      file_put_contents($temp_dir . '/' . $rule_file, $content);
      if ($options['debug']) {
        echo "Downloaded: $rule_file\n";
      }
    }
    
    // Verify we have at least the core rules
    if (is_valid_source_dir($temp_dir, $rules_to_install)) {
      $source_dir = $temp_dir;
      if ($options['debug']) {
        echo "Successfully downloaded rules from GitHub to: $temp_dir\n";
      }
    } else {
      // Clean up temp directory
      @rmdir($temp_dir);
      
      echo "Error: Could not download rules from GitHub. Please check your internet connection or try again later.\n";
      echo "Alternatively, you can manually download the rules from https://github.com/ivangrynenko/cursor-rules\n";
      return false;
    }
  }
  
  $copied_count = 0;
  $failed_count = 0;
  $filtered_count = 0;
  
  if ($options['debug']) {
    echo "Source directory: $source_dir\n";
    echo "Destination directory: $destination_dir\n";
    echo "Rules to install: " . count($rules_to_install) . "\n";
  }
  
  foreach ($rules_to_install as $rule_file) {
    $source_file = $source_dir . '/' . $rule_file;
    $dest_file = $destination_dir . '/' . $rule_file;
    
    // Skip this rule if tag filtering is enabled and the rule doesn't match
    if (($options['tags'] || $options['tag-preset']) && !rule_matches_tag_filter($source_file, $options)) {
      if ($options['debug']) {
        echo "Skipping due to tag filter: $rule_file\n";
      }
      $filtered_count++;
      continue;
    }
    
    if (file_exists($source_file)) {
      if (copy($source_file, $dest_file)) {
        $copied_count++;
        if ($options['debug']) {
          echo "Copied: $rule_file\n";
        }
      } else {
        $failed_count++;
        echo "Failed to copy: $rule_file\n";
      }
    } else {
      if ($options['debug']) {
        echo "Source file not found: $source_file\n";
      }
    }
  }
  
  if ($options['debug']) {
    echo "Copied $copied_count files, failed to copy $failed_count files.\n";
  }
  
  // Show summary of tag filtering if enabled
  if (($options['tags'] || $options['tag-preset']) && $filtered_count > 0) {
    echo "Filtered out $filtered_count rules based on tag criteria.\n";
  }
  
  // Inform the user if we're updating existing rules
  if (isset($temp_dir) && strpos($source_dir, $temp_dir) === 0 && is_dir($destination_dir)) {
    echo "Updated existing Cursor Rules with the latest version.\n";
  }
  
  // Clean up temporary directory if it was created
  if (isset($temp_dir) && strpos($source_dir, $temp_dir) === 0) {
    if ($options['debug']) {
      echo "Cleaning up temporary directory: $temp_dir\n";
    }
    
    // Remove all files in the temp directory
    $files = glob($temp_dir . '/*');
    foreach ($files as $file) {
      @unlink($file);
    }
    
    // Remove the directory
    @rmdir($temp_dir);
  }
  
  // Handle .cursorignore files installation
  $ignore_files_option = $options['ignore-files'];
  $should_install_ignore_files = false;
  
  if ($ignore_files_option === 'yes' || $ignore_files_option === 'y') {
    $should_install_ignore_files = true;
  } else if ($ignore_files_option === 'ask' || $ignore_files_option === 'a') {
    if (function_exists('stream_isatty') && stream_isatty(STDIN)) {
      echo "\nWould you like to install recommended .cursorignore files? (Y/n): ";
      $response = strtolower(trim(fgets(STDIN)));
      $should_install_ignore_files = ($response === '' || $response === 'y' || $response === 'yes');
    } else {
      // Default to yes if we can't ask interactively
      $should_install_ignore_files = true;
    }
  }
  
  if ($should_install_ignore_files) {
    $ignore_files_dir = dirname(__FILE__) . '/.cursor/ignore-files';
    
    // Try GitHub if local files don't exist
    if (!is_dir($ignore_files_dir)) {
      $ignore_files_dir = $source_dir . '/../ignore-files';
    }
    
    if (is_dir($ignore_files_dir)) {
      $ignore_files = glob($ignore_files_dir . '/*.cursorignore');
      $installed_count = 0;
      
      foreach ($ignore_files as $ignore_file) {
        $filename = basename($ignore_file);
        $target_path = dirname(dirname($destination_dir)) . '/' . $filename;
        
        if (copy($ignore_file, $target_path)) {
          $installed_count++;
          if ($options['debug']) {
            echo "Installed ignore file: $filename\n";
          }
        }
      }
      
      if ($installed_count > 0) {
        echo "Installed $installed_count recommended .cursorignore files.\n";
      }
    } else if ($options['debug']) {
      echo "No ignore files directory found at: $ignore_files_dir\n";
    }
  }
  
  return true;
}

/**
 * Display help information.
 */
function show_help(): void {
  echo "Cursor Rules Installer v" . CURSOR_RULES_VERSION . "\n";
  echo "Usage: php install.php [options]\n\n";
  echo "Options:\n";
  echo "  --help, -h           Show this help message\n";
  echo "  --debug              Enable debug mode\n";
  echo "  --copy-only          Only copy files, don't perform additional setup\n";
  echo "  --destination=DIR    Specify destination directory (default: .cursor/rules)\n";
  echo "  --web-stack, -w      Install web stack rules (PHP, Drupal, JavaScript, etc.)\n";
  echo "  --python, -p         Install Python rules\n";
  echo "  --javascript, -j     Install JavaScript rules\n";
  echo "  --all, -a            Install all rules\n";
  echo "  --core, -c           Install core rules only\n";
  echo "  --tags, -t <query>   Filter rules by tag expression (e.g., \"language:php category:security\")\n";
  echo "  --tag-preset <n>     Use a predefined tag preset (web, frontend, drupal, react, vue, python, security, owasp, a11y)\n";
  echo "  --ignore-files <opt> Control installation of .cursorignore files (yes, no, ask), default's to yes\n";
  echo "  --yes, -y            Automatically answer yes to all prompts\n";
  echo "\n";
  echo "Tag Expression Examples:\n";
  echo "  \"language:php\"                           - All PHP rules\n";
  echo "  \"language:javascript category:security\" - JavaScript security rules\n";
  echo "  \"framework:drupal standard:owasp-top10\" - Drupal OWASP rules\n";
  echo "  \"language:python OR language:php\"       - All Python or PHP rules\n";
  echo "\n";
  echo "Available Tag Presets:\n";
  foreach (TAG_PRESETS as $preset => $expression) {
    echo "  {$preset}: {$expression}\n";
  }
}

// If this script is being run directly, execute the installation.
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'] ?? '')) {
  // Default options
  $options = [
    'debug' => false,
    'copy_only' => false,
    'destination' => CURSOR_RULES_DIR,
    'web_stack' => false,
    'python' => false,
    'javascript' => false,
    'all' => false,
    'core' => false,
    'tags' => false,
    'tag-preset' => false,
    'ignore-files' => 'yes',
    'yes' => false,
    'help' => false,
  ];
  
  // Check for command line arguments
  if (isset($_SERVER['argv']) && is_array($_SERVER['argv']) && count($_SERVER['argv']) > 1) {
    // Process arguments
    $skip_next = false;
    foreach ($_SERVER['argv'] as $i => $arg) {
      // Skip the script name (first argument)
      if ($i === 0 || $skip_next) {
        $skip_next = false;
        continue;
      }
      
      // Process argument
      switch ($arg) {
        case '--debug':
          $options['debug'] = true;
          break;
        case '--copy-only':
          $options['copy_only'] = true;
          break;
        case '--web-stack':
        case '-w':
          $options['web_stack'] = true;
          break;
        case '--python':
        case '-p':
          $options['python'] = true;
          break;
        case '--javascript':
        case '-j':
          $options['javascript'] = true;
          break;
        case '--all':
        case '-a':
          $options['all'] = true;
          break;
        case '--core':
        case '-c':
          $options['core'] = true;
          break;
        case '--yes':
        case '-y':
          $options['yes'] = true;
          break;
        case '--help':
        case '-h':
          $options['help'] = true;
          break;
        case '--tags':
        case '-t':
          if (isset($_SERVER['argv'][$i + 1]) && !empty($_SERVER['argv'][$i + 1]) && substr($_SERVER['argv'][$i + 1], 0, 1) !== '-') {
            $options['tags'] = $_SERVER['argv'][$i + 1];
            $skip_next = true;
          } else {
            echo "Error: --tags/-t option requires a tag expression.\n";
            exit(1);
          }
          break;
        case '--tag-preset':
          if (isset($_SERVER['argv'][$i + 1]) && !empty($_SERVER['argv'][$i + 1]) && substr($_SERVER['argv'][$i + 1], 0, 1) !== '-') {
            $preset = $_SERVER['argv'][$i + 1];
            if (isset(TAG_PRESETS[$preset])) {
              $options['tag-preset'] = $preset;
              $skip_next = true;
            } else {
              echo "Error: Unknown tag preset '{$preset}'. Available presets: " . implode(', ', array_keys(TAG_PRESETS)) . "\n";
              exit(1);
            }
          } else {
            echo "Error: --tag-preset option requires a preset name.\n";
            exit(1);
          }
          break;
        case '--ignore-files':
          if (isset($_SERVER['argv'][$i + 1]) && !empty($_SERVER['argv'][$i + 1]) && substr($_SERVER['argv'][$i + 1], 0, 1) !== '-') {
            $ignoreFilesOption = strtolower($_SERVER['argv'][$i + 1]);
            if ($ignoreFilesOption === 'yes' || $ignoreFilesOption === 'y' || 
                $ignoreFilesOption === 'no' || $ignoreFilesOption === 'n' || 
                $ignoreFilesOption === 'ask' || $ignoreFilesOption === 'a') {
              $options['ignore-files'] = $ignoreFilesOption;
              $skip_next = true;
            } else {
              echo "Warning: Invalid value for --ignore-files. Using default (yes).\n";
            }
          } else {
            echo "Error: --ignore-files option requires a value (yes, no, or ask).\n";
            exit(1);
          }
          break;
        default:
          // Check for --destination=DIR format
          if (str_starts_with($arg, '--destination=')) {
            $options['destination'] = substr($arg, 14);
          } else {
            echo "Warning: Unknown option '$arg'\n";
            exit(1);
          }
          break;
      }
    }
  }
  
  // Run the installation.
  $result = install_cursor_rules($options);
  
  // Output result.
  if ($result) {
    echo "Cursor Rules installed successfully!\n";
    
    // Check if we should prompt to remove the installer file
    $stdin_available = function_exists('stream_isatty') ? stream_isatty(STDIN) : false;
    $script_path = $_SERVER['SCRIPT_FILENAME'] ?? __FILE__;
    
    if ($stdin_available && file_exists($script_path) && basename($script_path) === 'install.php') {
      echo "\nWould you like to remove the installer file? (Y/n): ";
      $remove_installer = strtolower(trim(fgets(STDIN)));
      
      if ($remove_installer === '' || $remove_installer === 'y' || $remove_installer === 'yes') {
        if (unlink($script_path)) {
          echo "Installer file removed successfully.\n";
        } else {
          echo "Failed to remove installer file. You may delete it manually.\n";
        }
      } else {
        echo "Installer file kept. You may remove it manually if needed.\n";
      }
    }
    
    exit(0);
  } else {
    echo "Installation failed!\n";
    exit(1);
  }
}

// Parse command line arguments.
function parse_args() {
  global $argv;
  
  $options = [
    'yes' => false,
    'core' => false,
    'web_stack' => false,
    'python' => false,
    'all' => false,
    'destination' => getcwd() . '/.cursor/rules',
    'debug' => false,
  ];
  
  $option_count = 0;
  
  if (isset($argv) && count($argv) > 1) {
    for ($i = 1; $i < count($argv); $i++) {
      $arg = $argv[$i];
      
      switch ($arg) {
        case '--help':
        case '-h':
          echo "Usage: php install.php [options]\n";
          echo "Options:\n";
          echo "  --help, -h          Show this help message\n";
          echo "  --yes, -y           Automatically answer yes to all prompts\n";
          echo "  --core              Install core rules only\n";
          echo "  --web-stack         Install web stack rules (includes core rules)\n";
          echo "  --python            Install Python rules (includes core rules)\n";
          echo "  --javascript, -j    Install JavaScript rules (includes core rules)\n";
          echo "  --all               Install all rules\n";
          echo "  --destination=DIR   Install to a custom directory (default: .cursor/rules)\n";
          echo "  --debug             Enable debug output for troubleshooting\n";
          exit(0);
        
        case '--yes':
        case '-y':
          $options['yes'] = true;
          break;
        
        case '--core':
          $options['core'] = true;
          $option_count++;
          break;
        
        case '--web-stack':
          $options['web_stack'] = true;
          $option_count++;
          break;
        
        case '--python':
          $options['python'] = true;
          $option_count++;
          break;
        
        case '--javascript':
        case '-j':
          $options['javascript'] = true;
          $option_count++;
          break;
          
        case '--all':
          $options['all'] = true;
          $option_count++;
          break;
          
        case '--debug':
          $options['debug'] = true;
          break;
        
        default:
          // Check for --destination=DIR format
          if (str_starts_with($arg, '--destination=')) {
            $options['destination'] = substr($arg, 14);
          } else {
            echo "Warning: Unknown option '$arg'\n";
            exit(1);
          }
          break;
      }
    }
  }
  
  return [$options, $option_count];
}

/**
 * Extract tags from a rule file.
 *
 * @param string $file_path Path to the rule file.
 * @return array List of tags found in the file.
 */
function extract_tags_from_rule(string $file_path): array {
  if (!file_exists($file_path)) {
    return [];
  }
  
  $content = file_get_contents($file_path);
  if ($content === false) {
    return [];
  }
  
  $tags = [];
  
  // Look for tags in the metadata section
  if (preg_match('/^---\s*$(.*?)^---\s*$/ms', $content, $matches)) {
    $metadata = $matches[1];
    
    // Extract tags from metadata
    if (preg_match_all('/^\s*([a-z_]+):\s*(.+?)\s*$/m', $metadata, $field_matches, PREG_SET_ORDER)) {
      foreach ($field_matches as $match) {
        $field_name = $match[1];
        $field_value = $match[2];
        
        // Special handling for tags, categories, etc.
        if (in_array($field_name, ['tags', 'tag', 'categories', 'category', 'keywords', 'language', 'framework', 'standard'])) {
          // Handle comma-separated values
          $values = preg_split('/\s*,\s*/', $field_value);
          foreach ($values as $value) {
            $value = trim($value);
            if (!empty($value)) {
              if ($field_name === 'tags' || $field_name === 'tag' || $field_name === 'categories' || $field_name === 'category' || $field_name === 'keywords') {
                $tags[] = $value;
              } else {
                // For specific fields like language, framework, add as field:value
                $tags[] = "{$field_name}:{$value}";
              }
            }
          }
        } else {
          // Add other metadata fields as is
          $tags[] = "{$field_name}:{$field_value}";
        }
      }
    }
  }
  
  return $tags;
}

/**
 * Check if a rule file matches the tag filter.
 *
 * @param string $file_path Path to the rule file.
 * @param array $options Options including tag filters.
 * @return bool Whether the rule matches the filter.
 */
function rule_matches_tag_filter(string $file_path, array $options): bool {
  global $TAG_PRESETS;
  
  // Extract the tag expression
  $tag_expression = '';
  if ($options['tag-preset'] && isset(TAG_PRESETS[$options['tag-preset']])) {
    $tag_expression = TAG_PRESETS[$options['tag-preset']];
  } elseif ($options['tags']) {
    $tag_expression = $options['tags'];
  }
  
  if (empty($tag_expression)) {
    return true; // No filtering if no expression
  }
  
  // Extract tags from the rule file
  $rule_tags = extract_tags_from_rule($file_path);
  if (empty($rule_tags)) {
    return false; // No tags in the file, can't match
  }
  
  // Debug output
  if ($options['debug']) {
    echo "Tags for file " . basename($file_path) . ": " . implode(", ", $rule_tags) . "\n";
    echo "Matching against expression: $tag_expression\n";
  }
  
  // Simple expression parser for tag matching
  $or_expressions = explode(' OR ', $tag_expression);
  foreach ($or_expressions as $or_expr) {
    $and_expressions = preg_split('/\s+/', trim($or_expr));
    $and_match = true;
    
    foreach ($and_expressions as $and_expr) {
      $expr = trim($and_expr);
      if (empty($expr)) {
        continue;
      }
      
      // Check if the expression matches any tag
      $expr_match = false;
      foreach ($rule_tags as $tag) {
        if ($expr[0] === '!') {
          // Negation: expr matches if the tag does NOT match the expression without the '!'
          $negated_expr = substr($expr, 1);
          if ($negated_expr !== $tag) {
            $expr_match = true;
          } else {
            $expr_match = false;
            break; // Found a tag that matches the negated expression, so this rule fails
          }
        } else if ($expr === $tag) {
          // Direct match
          $expr_match = true;
          break;
        }
      }
      
      if (!$expr_match) {
        $and_match = false;
        break;
      }
    }
    
    if ($and_match) {
      return true; // At least one OR clause matched completely
    }
  }
  
  return false; // No complete match found
} 
