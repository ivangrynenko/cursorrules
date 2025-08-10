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
 * --help, -h: Display help information
 * --quiet, -q: Suppress verbose output
 * --yes, -y: Automatically confirm all prompts
 */

declare(strict_types=1);

// Define constants.
define('CURSOR_RULES_VERSION', '1.0.5');
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
  $cursor_dir = dirname($options['destination']);
  if ($cursor_dir !== '.' && !is_dir($cursor_dir)) {
    if (!mkdir($cursor_dir, 0755, true)) {
      echo "Error: Failed to create .cursor directory.\n";
      return false;
    }
  }

  // Define available rules.
  $core_rules = [
    'cursor-rules.mdc',
    'git-commit-standards.mdc',
    'github-actions-standards.mdc',
    'improve-cursorrules-efficiency.mdc',
    'pull-request-changelist-instructions.mdc',
    'readme-maintenance-standards.mdc',
    'testing-guidelines.mdc',
  ];

  $web_stack_rules = [
    'accessibility-standards.mdc',
    'api-standards.mdc',
    'build-optimization.mdc',
    'code-generation-standards.mdc',
    'debugging-standards.mdc',
    'docker-compose-standards.mdc',
    'drupal-authentication-failures.mdc',
    'drupal-broken-access-control.mdc',
    'drupal-cryptographic-failures.mdc',
    'drupal-database-standards.mdc',
    'drupal-file-permissions.mdc',
    'drupal-injection.mdc',
    'drupal-insecure-design.mdc',
    'drupal-integrity-failures.mdc',
    'drupal-logging-failures.mdc',
    'drupal-security-misconfiguration.mdc',
    'drupal-ssrf.mdc',
    'drupal-vulnerable-components.mdc',
    'generic_bash_style.mdc',
    'govcms-saas-project-documentation-creation.mdc',
    'govcms-saas.mdc',
    'javascript-performance.mdc',
    'javascript-standards.mdc',
    'lagoon-docker-compose-standards.mdc',
    'lagoon-yml-standards.mdc',
    'multi-agent-coordination.mdc',
    'node-dependencies.mdc',
    'php-drupal-best-practices.mdc',
    'php-drupal-development-standards.mdc',
    'project-definition-template.mdc',
    'react-patterns.mdc',
    'security-practices.mdc',
    'secret-detection.mdc',
    'tailwind-standards.mdc',
    'tests-documentation-maintenance.mdc',
    'third-party-integration.mdc',
    'vortex-cicd-standards.mdc',
    'vortex-scaffold-standards.mdc',
    'vue-best-practices.mdc',
    'behat-steps.mdc',
    'behat-ai-guide.mdc',
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
    'security-practices.mdc',
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

  // Handle tag-based filtering
  if ($options['tags'] || $options['tag-preset']) {
    $tag_expression = $options['tags'] ?: TAG_PRESETS[$options['tag-preset']] ?? '';
    
    if (empty($tag_expression)) {
      echo "Error: Invalid tag preset '{$options['tag-preset']}'\n";
      echo "Available presets: " . implode(', ', array_keys(TAG_PRESETS)) . "\n";
      return false;
    }
    
    echo "Installing rules matching tag expression: $tag_expression\n";
    
    // When using tags, we need to check all available rules
    $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules, $javascript_rules);
    
    if ($options['debug']) {
      echo "Will filter " . count($rules_to_install) . " rules based on tags\n";
    }
  } else {
    // Check if STDIN is available for interactive input
    $stdin_available = function_exists('stream_isatty') ? stream_isatty(STDIN) : false;

    // Interactive mode if no specific option is selected and not in auto-yes mode and STDIN is available
    if ($option_count === 0 && !$options['yes'] && $stdin_available) {
      echo "Welcome to Cursor Rules Installer v" . CURSOR_RULES_VERSION . "\n\n";
      echo "Please select which rules to install:\n";
      echo "1) Core rules only\n";
      echo "2) Web stack rules (PHP, Drupal, etc.)\n";
      echo "3) Python rules\n";
      echo "4) JavaScript security rules (OWASP Top 10)\n";
      echo "5) All rules\n";
      echo "6) Tag-based installation (advanced)\n";
      echo "7) Install .cursorignore files\n";
      echo "8) Exit\n";

      $valid_choice = false;
      while (!$valid_choice) {
        echo "\nEnter your choice (1-8): ";
        $choice = trim(fgets(STDIN));

        switch ($choice) {
          case '1':
            $rules_to_install = $core_rules;
            $valid_choice = true;
            echo "Installing core rules...\n";
            break;
          case '2':
            $rules_to_install = array_merge($core_rules, $web_stack_rules);
            $valid_choice = true;
            echo "Installing web stack rules...\n";
            if ($options['debug']) {
              echo "Selected " . count($rules_to_install) . " rules to install (" . count($core_rules) . " core + " . count($web_stack_rules) . " web stack)\n";
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
            echo "Installing JavaScript security rules...\n";
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
            // Tag-based installation
            echo "Available tag presets:\n";
            foreach (TAG_PRESETS as $preset => $expression) {
              echo "  - $preset: $expression\n";
            }
            echo "\nEnter tag preset name or custom tag expression: ";
            $tag_input = trim(fgets(STDIN));
            
            if (array_key_exists($tag_input, TAG_PRESETS)) {
              $tag_expression = TAG_PRESETS[$tag_input];
            } else {
              $tag_expression = $tag_input;
            }
            
            echo "Installing rules matching: $tag_expression\n";
            $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules, $javascript_rules);
            $options['tags'] = $tag_expression;
            $valid_choice = true;
            break;
          case '7':
            // Install only .cursorignore files
            $rules_to_install = [];
            $options['ignore-files'] = true;
            $valid_choice = true;
            echo "Installing .cursorignore files...\n";
            break;
          case '8':
            echo "Installation cancelled.\n";
            return true;
          default:
            echo "Invalid choice. Please enter a number between 1 and 8.\n";
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
    } else if ($options['all']) {
      $rules_to_install = array_merge($core_rules, $web_stack_rules, $python_rules, $javascript_rules);
    } elseif ($options['web_stack']) {
      $rules_to_install = array_merge($core_rules, $web_stack_rules, $javascript_rules);
    } elseif ($options['python']) {
      $rules_to_install = array_merge($core_rules, $python_rules);
    } elseif ($options['javascript']) {
      $rules_to_install = array_merge($core_rules, $javascript_rules);
    } elseif ($options['core']) {
      $rules_to_install = $core_rules;
    } else {
      // Default to core rules if no option specified and in auto-yes mode.
      $rules_to_install = $core_rules;
    }
  }

  // Define possible source directories.
  $possible_source_dirs = [
    __DIR__ . '/.cursor/rules',
    dirname(__FILE__) . '/.cursor/rules',
    realpath(__DIR__ . '/../.cursor/rules'),
    getcwd() . '/.cursor/rules',
  ];

  // Filter out false values (realpath returns false if path doesn't exist)
  $possible_source_dirs = array_filter($possible_source_dirs, function($dir) {
    return $dir !== false;
  });

  // Check if we're in the cloned repo root
  if (file_exists(__DIR__ . '/.cursor/rules')) {
    // We're likely in the root of the cloned repository
    $possible_source_dirs[] = __DIR__ . '/.cursor/rules';
  }

  // Validate source directory has the rules we need
  function is_valid_source_dir($dir, $rule_files) {
    if (!is_dir($dir)) {
      return false;
    }

    // Check if at least half of the expected rule files exist
    $found_files = 0;
    $min_files = max(1, intval(count($rule_files) * 0.5));

    if (isset($options['debug']) && $options['debug']) {
      echo "Checking if directory is valid source: $dir\n";
      echo "Looking for at least $min_files of " . count($rule_files) . " rule files\n";
    }

    foreach ($rule_files as $file) {
      if (file_exists($dir . '/' . $file)) {
        $found_files++;
        if (isset($options['debug']) && $options['debug']) {
          echo "  Found rule file: $file\n";
        }
        if ($found_files >= $min_files) {
          return true;
        }
      }
    }

    if (isset($options['debug']) && $options['debug']) {
      echo "  Found only $found_files files, need at least $min_files\n";
    }

    return false;
  }

  // Add debug output for rules to install
  if ($options['debug']) {
    echo "\nRules to install (" . count($rules_to_install) . " total):\n";
    foreach ($rules_to_install as $index => $rule) {
      echo ($index + 1) . ". $rule\n";
    }
    echo "\n";
  }

  // Remove duplicates from rules to install
  $rules_to_install = array_unique($rules_to_install);

  // If copy_only option is set, skip the source directory check.
  if ($options['copy_only']) {
    echo "Copy-only mode enabled. Skipping source directory check.\n";
    return true;
  }

  // Try to download rules from GitHub if no local source is found
  $github_source = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/rules/';
  $temp_dir = sys_get_temp_dir() . '/cursor-rules-' . uniqid();

  // Find a valid source directory
  $source_dir = null;
  foreach ($possible_source_dirs as $dir) {
    if (is_valid_source_dir($dir, $rules_to_install)) {
      $source_dir = $dir;
      if ($options['debug']) {
        echo "Found valid source directory: $dir\n";
      }
      break;
    }
  }

  // If no local source found, try to download from GitHub
  if ($source_dir === null) {
    if ($options['debug']) {
      echo "No local source found, attempting to download from GitHub...\n";
    }

    if (!mkdir($temp_dir, 0755, true)) {
      echo "Error: Failed to create temporary directory.\n";
      return false;
    }

    $download_success = true;

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
        $download_success = false;
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
      $ignore_files = ['.cursorignore', '.cursorindexingignore'];
      $copied_ignore_count = 0;
      
      foreach ($ignore_files as $ignore_file) {
        $source_ignore = $ignore_files_dir . '/' . $ignore_file;
        $dest_ignore = dirname($options['destination']) . '/../' . $ignore_file;
        
        if (file_exists($source_ignore)) {
          if (file_exists($dest_ignore)) {
            if ($options['debug']) {
              echo "$ignore_file already exists, skipping...\n";
            }
          } else {
            if (copy($source_ignore, $dest_ignore)) {
              $copied_ignore_count++;
              if ($options['debug']) {
                echo "Copied: $ignore_file\n";
              }
            }
          }
        }
      }
      
      if ($copied_ignore_count > 0) {
        echo "Installed $copied_ignore_count ignore file(s) to help improve Cursor AI performance.\n";
      }
    } else {
      // Try to download from GitHub
      $github_ignore_base = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/';
      $ignore_files = ['.cursorignore', '.cursorindexingignore'];
      $downloaded_ignore_count = 0;
      
      foreach ($ignore_files as $ignore_file) {
        $dest_ignore = dirname($options['destination']) . '/../' . $ignore_file;
        
        if (file_exists($dest_ignore)) {
          if ($options['debug']) {
            echo "$ignore_file already exists, skipping...\n";
          }
          continue;
        }
        
        $url = $github_ignore_base . $ignore_file;
        $content = @file_get_contents($url);
        
        if ($content !== false) {
          if (file_put_contents($dest_ignore, $content)) {
            $downloaded_ignore_count++;
            if ($options['debug']) {
              echo "Downloaded and installed: $ignore_file\n";
            }
          }
        }
      }
      
      if ($downloaded_ignore_count > 0) {
        echo "Downloaded and installed $downloaded_ignore_count ignore file(s) to help improve Cursor AI performance.\n";
      }
    }
  }
  
  // Create UPDATE.md file to track version
  $cursor_parent_dir = dirname($options['destination']);
  $update_file_path = $cursor_parent_dir . '/UPDATE.md';
  
  $update_content = "# Cursor Rules Installation\n\n";
  $update_content .= "**Version:** " . CURSOR_RULES_VERSION . "\n";
  $update_content .= "**Installation Date:** " . date('Y-m-d H:i:s T') . "\n";
  $update_content .= "**Rules Installed:** " . $copied_count . " files\n\n";
  
  if (($options['tags'] || $options['tag-preset']) && $filtered_count > 0) {
    $tag_expression = $options['tags'] ?: (TAG_PRESETS[$options['tag-preset']] ?? '');
    $update_content .= "**Tag Filter:** $tag_expression\n";
    $update_content .= "**Filtered Out:** $filtered_count rules\n\n";
  }
  
  $update_content .= "## Installation Type\n";
  if ($options['all']) {
    $update_content .= "- All rules (core, web stack, Python, JavaScript)\n";
  } elseif ($options['web_stack']) {
    $update_content .= "- Web stack rules (core, web, Drupal, JavaScript)\n";
  } elseif ($options['python']) {
    $update_content .= "- Python rules (core + Python security)\n";
  } elseif ($options['javascript']) {
    $update_content .= "- JavaScript rules (core + JavaScript security)\n";
  } elseif ($options['core']) {
    $update_content .= "- Core rules only\n";
  } elseif ($options['tags'] || $options['tag-preset']) {
    $update_content .= "- Tag-based installation\n";
  } else {
    $update_content .= "- Core rules (default)\n";
  }
  
  $update_content .= "\n## Source\n";
  $update_content .= "Rules downloaded from: https://github.com/ivangrynenko/cursor-rules\n";
  
  if (file_put_contents($update_file_path, $update_content)) {
    if ($options['debug']) {
      echo "Created UPDATE.md file at: $update_file_path\n";
    }
  } else {
    echo "Warning: Failed to create UPDATE.md file\n";
  }
  
  return true;
}

/**
 * Check if a rule file matches the tag filter expression.
 * 
 * @param string $file_path Path to the rule file
 * @param array $options Installation options containing tag filters
 * @return bool True if the rule matches the filter, false otherwise
 */
function rule_matches_tag_filter($file_path, $options) {
  if (!file_exists($file_path)) {
    return false;
  }
  
  $content = file_get_contents($file_path);
  
  // Extract tags from the metadata section
  $tags = [];
  if (preg_match('/metadata:\s*\n(?:[^\n]*\n)*?\s*tags:\s*\n((?:\s*-\s*[^\n]+\n)+)/m', $content, $matches)) {
    $tag_lines = explode("\n", trim($matches[1]));
    foreach ($tag_lines as $line) {
      if (preg_match('/^\s*-\s*(.+)$/', $line, $tag_match)) {
        $tags[] = trim($tag_match[1]);
      }
    }
  }
  
  if (empty($tags)) {
    return false;
  }
  
  // Get the tag expression
  $tag_expression = $options['tags'] ?: (TAG_PRESETS[$options['tag-preset']] ?? '');
  
  // Parse and evaluate the tag expression
  return evaluate_tag_expression($tag_expression, $tags);
}

/**
 * Evaluate a tag expression against a set of tags.
 * 
 * Supports:
 * - Simple tags: "language:php"
 * - AND operations: "language:php category:security" (space-separated)
 * - OR operations: "language:php OR language:javascript"
 * 
 * @param string $expression The tag expression to evaluate
 * @param array $tags The tags to check against
 * @return bool True if the expression matches, false otherwise
 */
function evaluate_tag_expression($expression, $tags) {
  // Handle OR operations
  if (stripos($expression, ' OR ') !== false) {
    $or_parts = array_map('trim', explode(' OR ', $expression));
    foreach ($or_parts as $part) {
      if (evaluate_tag_expression($part, $tags)) {
        return true;
      }
    }
    return false;
  }
  
  // Handle AND operations (space-separated)
  $and_parts = array_filter(array_map('trim', explode(' ', $expression)));
  foreach ($and_parts as $required_tag) {
    $found = false;
    foreach ($tags as $tag) {
      if ($tag === $required_tag || stripos($tag, $required_tag) !== false) {
        $found = true;
        break;
      }
    }
    if (!$found) {
      return false;
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
  echo "  --web-stack, --ws    Install web stack rules (PHP, Drupal, JavaScript, etc.)\n";
  echo "  --python, -p         Install Python rules\n";
  echo "  --all, -a            Install all rules\n";
  echo "  --core, -c           Install core rules only\n";
  echo "  --yes, -y            Automatically answer yes to all prompts\n";
  echo "  --tags=EXPR          Install rules matching tag expression (e.g., \"language:php category:security\")\n";
  echo "  --tag-preset=NAME    Use a predefined tag preset\n";
  echo "  --ignore-files=OPT   Control .cursorignore file installation (yes/no/ask, default: yes)\n";
  echo "\nTag Presets:\n";
  foreach (TAG_PRESETS as $name => $expression) {
    echo "  $name: $expression\n";
  }
  echo "\nExamples:\n";
  echo "  php install.php --tags \"language:javascript category:security\"\n";
  echo "  php install.php --tag-preset php-security\n";
  echo "  php install.php --web-stack --ignore-files=no\n";
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
    'yes' => false,
    'help' => false,
    'tags' => false,
    'tag-preset' => false,
    'ignore-files' => 'yes',
  ];

  // Check for command line arguments
  if (isset($_SERVER['argv']) && is_array($_SERVER['argv']) && count($_SERVER['argv']) > 1) {
    // Process arguments
    $argv_count = count($_SERVER['argv']);
    for ($i = 1; $i < $argv_count; $i++) {
      $arg = $_SERVER['argv'][$i];

      // Process argument
      switch ($arg) {
        case '--debug':
          $options['debug'] = true;
          break;
        case '--copy-only':
          $options['copy_only'] = true;
          break;
        case '--web-stack':
        case '--ws':
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
          // Get the next argument as the value
          if ($i + 1 < count($_SERVER['argv'])) {
            $options['tags'] = $_SERVER['argv'][$i + 1];
            $i++; // Skip the next argument
          } else {
            echo "Error: --tags requires a value\n";
            exit(1);
          }
          break;
        case '--tag-preset':
          // Get the next argument as the value
          if ($i + 1 < count($_SERVER['argv'])) {
            $options['tag-preset'] = $_SERVER['argv'][$i + 1];
            $i++; // Skip the next argument
          } else {
            echo "Error: --tag-preset requires a value\n";
            exit(1);
          }
          break;
        case '--ignore-files':
          // Get the next argument as the value
          if ($i + 1 < count($_SERVER['argv'])) {
            $value = $_SERVER['argv'][$i + 1];
            if (in_array($value, ['yes', 'no', 'ask', 'y', 'n', 'a'])) {
              $options['ignore-files'] = $value;
              $i++; // Skip the next argument
            } else {
              echo "Warning: Invalid value for --ignore-files. Use yes, no, or ask.\n";
              exit(1);
            }
          } else {
            echo "Error: --ignore-files requires a value\n";
            exit(1);
          }
          break;
        default:
          // Check for --destination=DIR format
          if (str_starts_with($arg, '--destination=')) {
            $options['destination'] = substr($arg, 14);
          } else if (str_starts_with($arg, '--tags=')) {
            $options['tags'] = substr($arg, 7);
          } else if (str_starts_with($arg, '--tag-preset=')) {
            $options['tag-preset'] = substr($arg, 13);
          } else if (str_starts_with($arg, '--ignore-files=')) {
            $value = substr($arg, 15);
            if (in_array($value, ['yes', 'no', 'ask', 'y', 'n', 'a'])) {
              $options['ignore-files'] = $value;
            } else {
              echo "Warning: Invalid value for --ignore-files. Use yes, no, or ask.\n";
              exit(1);
            }
          } else {
            echo "Warning: Unknown option '$arg'\n";
            exit(1);
          }
      }
    }
  } else {
    // No arguments provided, check if we should parse from STDIN (for curl | php usage)
    if (!stream_isatty(STDIN)) {
      // We're being piped to, look for arguments after the separator
      list($options, $option_count) = parseArguments();
    }
  }

  // Execute installation
  $success = install_cursor_rules($options);

  // Ask about cleanup if not in auto-yes mode and the file still exists
  if ($success && file_exists(__FILE__) && !$options['yes'] && function_exists('stream_isatty') && stream_isatty(STDIN)) {
    echo "\nWould you like to remove the installer file? (Y/n): ";
    $response = strtolower(trim(fgets(STDIN)));
    if ($response === '' || $response === 'y' || $response === 'yes') {
      unlink(__FILE__);
      echo "Installer file removed.\n";
    }
  }

  echo "\nInstallation " . ($success ? "completed successfully!" : "failed.") . "\n";
  echo "Cursor AI will now use these rules when working with your codebase.\n";

  exit($success ? 0 : 1);
}

/**
 * Parse command line arguments when running through curl pipe.
 * 
 * @return array
 */
function parseArguments() {
  global $argv, $argc;
  
  $options = [
    'debug' => false,
    'copy_only' => false,
    'destination' => CURSOR_RULES_DIR,
    'web_stack' => false,
    'python' => false,
    'javascript' => false,
    'all' => false,
    'core' => false,
    'yes' => false,
    'help' => false,
    'tags' => false,
    'tag-preset' => false,
    'ignore-files' => 'yes',
  ];
  
  $option_count = 0;
  
  // Look for -- separator in argv to handle piped arguments
  $start_index = 1;
  for ($i = 1; $i < $argc; $i++) {
    if ($argv[$i] === '--') {
      $start_index = $i + 1;
      break;
    }
  }
  
  // Process arguments after the separator
  for ($i = $start_index; $i < $argc; $i++) {
    $arg = $argv[$i];
    
    // Skip empty arguments
    if (empty($arg)) {
      continue;
    }
    
    switch ($arg) {
      case '--help':
      case '-h':
        echo "Usage: php install.php [options]\n";
        echo "Options:\n";
        echo "  --help, -h          Show this help message\n";
        echo "  --yes, -y           Automatically answer yes to all prompts\n";
        echo "  --core              Install core rules only\n";
        echo "  --web-stack, --ws   Install web stack rules (includes core rules)\n";
        echo "  --python            Install Python rules (includes core rules)\n";
        echo "  --all               Install all rules\n";
        echo "  --destination=DIR   Install to a custom directory (default: .cursor/rules)\n";
        echo "  --debug             Enable debug output for troubleshooting\n";
        echo "  --tags=EXPR         Install rules matching tag expression\n";
        echo "  --tag-preset=NAME   Use a predefined tag preset\n";
        echo "  --ignore-files=OPT  Control .cursorignore file installation (yes/no/ask)\n";
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
      case '--ws':
        $options['web_stack'] = true;
        $option_count++;
        break;

      case '--python':
        $options['python'] = true;
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
        // Check for parameter=value format
        if (strpos($arg, '=') !== false) {
          list($param, $value) = explode('=', $arg, 2);
          switch ($param) {
            case '--destination':
              $options['destination'] = $value;
              break;
            case '--tags':
              $options['tags'] = $value;
              $option_count++;
              break;
            case '--tag-preset':
              $options['tag-preset'] = $value;
              $option_count++;
              break;
            case '--ignore-files':
              if (in_array($value, ['yes', 'no', 'ask', 'y', 'n', 'a'])) {
                $options['ignore-files'] = $value;
              }
              break;
          }
        }
        break;
    }
  }

  return [$options, $option_count];
}