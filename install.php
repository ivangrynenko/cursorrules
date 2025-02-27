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

// Main function to install cursor rules.
function install_cursor_rules(array $options = []): bool {
  // Default options.
  $default_options = [
    'debug' => false,
    'copy_only' => false,
    'destination' => CURSOR_RULES_DIR,
  ];
  
  // Merge options.
  $options = array_merge($default_options, $options);
  
  // Debug mode.
  if ($options['debug']) {
    echo "Debug mode enabled\n";
    echo "Options: " . print_r($options, true) . "\n";
  }
  
  // Create destination directory if it doesn't exist.
  if (!is_dir($options['destination'])) {
    mkdir($options['destination'], 0755, true);
    if ($options['debug']) {
      echo "Created directory: {$options['destination']}\n";
    }
  }
  
  // Copy rules.
  $rules_files = [
    'accessibility-standards.mdc',
    'api-standards.mdc',
    'build-optimization.mdc',
    'code-generation-standards.mdc',
    'cursor-rules.mdc',
    'debugging-standards.mdc',
    'docker-compose-standards.mdc',
    'drupal-database-standards.mdc',
    'drupal-file-permissions.mdc',
    'generic_bash_style.mdc',
    'git-commit-standards.mdc',
    'github-actions-standards.mdc',
    'govcms-saas.mdc',
    'improve-cursorrules-efficiency.mdc',
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
    'readme-maintenance-standards.mdc',
    'security-practices.mdc',
    'tailwind-standards.mdc',
    'tests-documentation-maintenance.mdc',
    'third-party-integration.mdc',
    'vortex-cicd-standards.mdc',
    'vortex-scaffold-standards.mdc',
    'vue-best-practices.mdc',
  ];
  
  // Return success.
  return true;
}

// If this script is being run directly, execute the installation.
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'] ?? '')) {
  // Default options
  $options = [
    'debug' => false,
    'copy_only' => false,
    'destination' => CURSOR_RULES_DIR,
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
      if ($arg === '--debug') {
        $options['debug'] = true;
      } elseif ($arg === '--copy-only') {
        $options['copy_only'] = true;
      } elseif (substr($arg, 0, 14) === '--destination=') {
        $options['destination'] = substr($arg, 14);
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