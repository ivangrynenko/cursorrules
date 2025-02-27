<?php
/**
 * Cursor Rules Installer
 *
 * This script installs Cursor Rules into your project.
 */

declare(strict_types=1);

// Define constants.
define('CURSOR_RULES_VERSION', '1.0.0');
define('CURSOR_RULES_DIR', '.cursor/rules');
define('CURSOR_DIR', '.cursor');

// Main function to install cursor rules.
function install_cursor_rules(array $options = []): bool {
  // Default options.
  $default_options = [
    'debug' => false,
    'copy_only' => false,
    'destination' => CURSOR_RULES_DIR,
    'web_stack' => false,
    'python' => false,
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
  if ($options['all']) $option_count++;
  if ($options['core']) $option_count++;
  
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
  
  // Determine which rules to install.
  $rules_to_install = [];
  
  if ($options['all']) {
    $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules);
  } elseif ($options['web_stack']) {
    $rules_to_install = array_merge($core_rules, $web_stack_rules);
  } elseif ($options['python']) {
    $rules_to_install = array_merge($core_rules, $python_rules);
  } elseif ($options['core']) {
    $rules_to_install = $core_rules;
  } else {
    // Default to core rules if no option specified.
    $rules_to_install = $core_rules;
  }
  
  // Find the source directory containing the rule files
  $script_dir = dirname(__FILE__);
  
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
  
  $source_dir = null;
  foreach ($possible_source_dirs as $dir) {
    if ($options['debug']) {
      echo "Checking for source directory: $dir\n";
    }
    
    if (is_dir($dir)) {
      $source_dir = $dir;
      if ($options['debug']) {
        echo "Found source directory: $dir\n";
      }
      break;
    }
  }
  
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
    echo "Error: Source and destination directories are the same.\n";
    return false;
  }
  
  $copied_count = 0;
  $failed_count = 0;
  
  if ($options['debug']) {
    echo "Source directory: $source_dir\n";
    echo "Destination directory: $destination_dir\n";
    echo "Rules to install: " . count($rules_to_install) . "\n";
  }
  
  foreach ($rules_to_install as $rule_file) {
    $source_file = $source_dir . '/' . $rule_file;
    $dest_file = $destination_dir . '/' . $rule_file;
    
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
  echo "  --all, -a            Install all rules\n";
  echo "  --core, -c           Install core rules only\n";
  echo "  --yes, -y            Automatically answer yes to all prompts\n";
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
    'all' => false,
    'core' => false,
    'yes' => false,
    'help' => false,
  ];
  
  // Check for command line arguments
  if (isset($_SERVER['argv']) && is_array($_SERVER['argv']) && count($_SERVER['argv']) > 1) {
    // Process arguments
    foreach ($_SERVER['argv'] as $i => $arg) {
      // Skip the script name (first argument)
      if ($i === 0) {
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
    exit(0);
  } else {
    echo "Installation failed!\n";
    exit(1);
  }
} 