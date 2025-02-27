<?php

declare(strict_types=1);

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
 * --help, -h: Display help information
 * --quiet, -q: Suppress verbose output
 * --yes, -y: Automatically confirm all prompts
 */

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

// Parse command line options
$options = getopt('wpachyq', [
    'web-stack',
    'python',
    'all',
    'core',
    'custom',
    'help',
    'yes',
    'quiet'
]);

// Default settings
$autoConfirm = false;
$quietMode = false;
$installMode = 'interactive';

// Process options
if (isset($options['h']) || isset($options['help'])) {
    displayHelp();
    exit(0);
}

if (isset($options['y']) || isset($options['yes'])) {
    $autoConfirm = true;
}

if (isset($options['q']) || isset($options['quiet'])) {
    $quietMode = true;
}

// Check for conflicting installation options
$installOptions = 0;
if (isset($options['w']) || isset($options['web-stack'])) {
    $installMode = 'web-stack';
    $installOptions++;
}

if (isset($options['p']) || isset($options['python'])) {
    $installMode = 'python';
    $installOptions++;
}

if (isset($options['a']) || isset($options['all'])) {
    $installMode = 'all';
    $installOptions++;
}

if (isset($options['c']) || isset($options['core'])) {
    $installMode = 'core';
    $installOptions++;
}

if (isset($options['custom'])) {
    $installMode = 'custom';
    $installOptions++;
}

// Check for conflicting installation options
if ($installOptions > 1) {
    println(colorize("Error: Conflicting installation options provided. Please specify only one of: --web-stack, --python, --all, --core, --custom", 'red'));
    displayHelp();
    exit(1);
}

function displayHelp() {
    println("Cursor Rules Installer");
    println("======================");
    println();
    println("Usage: php install.php [options]");
    println();
    println("Options:");
    println("  --web-stack, -w    Install core, web, and Drupal rules");
    println("  --python, -p       Install core and Python rules");
    println("  --all, -a          Install all rule sets");
    println("  --core, -c         Install only core rules");
    println("  --custom           Enable selective installation (interactive)");
    println("  --help, -h         Display this help information");
    println("  --quiet, -q        Suppress verbose output");
    println("  --yes, -y          Automatically confirm all prompts");
    println();
    println("Examples:");
    println("  php install.php --web-stack --yes");
    println("  php install.php -p -q");
    println("  php install.php --all");
    println();
}

function colorize(string $message, string $color): string {
    global $quietMode;
    if ($quietMode) {
        return $message;
    }
    return COLORS[$color] . $message . COLORS['reset'];
}

function println(string $message = ''): void {
    global $quietMode;
    if (!$quietMode || empty($message)) {
        echo $message . PHP_EOL;
    }
}

function prompt(string $message, string $default = ''): string {
    global $autoConfirm;
    
    // If auto-confirm is enabled, return the default
    if ($autoConfirm) {
        return $default;
    }
    
    // Check if input is piped
    $isPiped = !posix_isatty(STDIN);
    if ($isPiped) {
        return $default;
    }
    
    echo $message . ($default ? " [{$default}]" : '') . ': ';
    $input = fgets(STDIN);
    if ($input === false) {
        return $default;
    }
    return trim($input) ?: $default;
}

function downloadFile(string $url, string $destination): bool {
    $ch = curl_init($url);
    if ($ch === FALSE) {
        return FALSE;
    }

    $fp = fopen($destination, 'w');
    if ($fp === FALSE) {
        curl_close($ch);
        return FALSE;
    }

    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $success = curl_exec($ch);
    
    curl_close($ch);
    fclose($fp);

    return $success !== FALSE;
}

if (!$quietMode) {
    println(colorize('Cursor Rules Installer', 'blue'));
    println('================================');
    println();
}

$targetDir = '.cursor/rules';
$baseUrl = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/rules';
$updateMdUrl = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/UPDATE.md';

// Define rule categories
$ruleCategories = [
    'core' => [
        'cursor-rules.mdc',
        'improve-cursorrules-efficiency.mdc',
        'git-commit-standards.mdc',
        'readme-maintenance-standards.mdc',
    ],
    'web' => [
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
    ],
    'drupal' => [
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
    ],
    'python' => [
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
    ],
];

// Check if directory exists
if (!file_exists($targetDir) && !$quietMode) {
    println(colorize("Notice: Directory '{$targetDir}' does not exist.", 'yellow'));
    println("It will be created during installation.");
} elseif (!$quietMode) {
    println(colorize("Warning: Directory '{$targetDir}' already exists.", 'yellow'));
    println("Existing files with the same names will be overwritten.");
}

$selectedRules = [];

// Process installation mode
switch ($installMode) {
    case 'web-stack':
        if (!$quietMode) {
            println(colorize("Installing Web Stack rules...", 'green'));
        }
        $selectedRules = array_merge(
            $ruleCategories['core'],
            $ruleCategories['web'],
            $ruleCategories['drupal']
        );
        break;
    case 'python':
        if (!$quietMode) {
            println(colorize("Installing Python rules...", 'green'));
        }
        $selectedRules = array_merge(
            $ruleCategories['core'],
            $ruleCategories['python']
        );
        break;
    case 'all':
        if (!$quietMode) {
            println(colorize("Installing all rules...", 'green'));
        }
        $selectedRules = array_merge(
            $ruleCategories['core'],
            $ruleCategories['web'],
            $ruleCategories['drupal'],
            $ruleCategories['python']
        );
        break;
    case 'core':
        if (!$quietMode) {
            println(colorize("Installing core rules...", 'green'));
        }
        $selectedRules = $ruleCategories['core'];
        break;
    case 'custom':
        if (!$quietMode) {
            println(colorize("Custom Selection:", 'magenta'));
            println();
            
            println(colorize("Core rules:", 'cyan'));
        }
        $installCore = strtolower(prompt("Install core rules? (Y/n)", "Y"));
        if ($installCore === 'y') {
            $selectedRules = array_merge($selectedRules, $ruleCategories['core']);
        }
        
        if (!$quietMode) {
            println(colorize("Web rules (JavaScript, CSS, etc):", 'cyan'));
        }
        $installWeb = strtolower(prompt("Install web rules? (Y/n)", "Y"));
        if ($installWeb === 'y') {
            $selectedRules = array_merge($selectedRules, $ruleCategories['web']);
        }
        
        if (!$quietMode) {
            println(colorize("Drupal rules:", 'cyan'));
        }
        $installDrupal = strtolower(prompt("Install Drupal rules? (Y/n)", "Y"));
        if ($installDrupal === 'y') {
            $selectedRules = array_merge($selectedRules, $ruleCategories['drupal']);
        }
        
        if (!$quietMode) {
            println(colorize("Python rules:", 'cyan'));
        }
        $installPython = strtolower(prompt("Install Python rules? (Y/n)", "n"));
        if ($installPython === 'y') {
            $selectedRules = array_merge($selectedRules, $ruleCategories['python']);
        }
        break;
    default:
        // Interactive mode if no options specified
        if (!$quietMode) {
            println(colorize("Select your primary use case:", 'cyan'));
            println("1) " . colorize("Web Stack", 'white') . " (Drupal, PHP, JS, CSS)");
            println("2) " . colorize("Python", 'white') . " (Python, Django, Flask)");
            println("3) " . colorize("All Rules", 'white') . " (Install everything)");
            println("4) " . colorize("Custom Selection", 'white') . " (Choose specific rule sets)");
            println();
        }
        
        $option = prompt("Enter option number", "1");
        
        switch ($option) {
            case "1":
                if (!$quietMode) {
                    println(colorize("Installing Web Stack rules...", 'green'));
                }
                $selectedRules = array_merge(
                    $ruleCategories['core'],
                    $ruleCategories['web'],
                    $ruleCategories['drupal']
                );
                break;
            case "2":
                if (!$quietMode) {
                    println(colorize("Installing Python rules...", 'green'));
                }
                $selectedRules = array_merge(
                    $ruleCategories['core'],
                    $ruleCategories['python']
                );
                break;
            case "3":
                if (!$quietMode) {
                    println(colorize("Installing all rules...", 'green'));
                }
                $selectedRules = array_merge(
                    $ruleCategories['core'],
                    $ruleCategories['web'],
                    $ruleCategories['drupal'],
                    $ruleCategories['python']
                );
                break;
            case "4":
                if (!$quietMode) {
                    println(colorize("Custom Selection:", 'magenta'));
                    println();
                    
                    println(colorize("Core rules:", 'cyan'));
                }
                $installCore = strtolower(prompt("Install core rules? (Y/n)", "Y"));
                if ($installCore === 'y') {
                    $selectedRules = array_merge($selectedRules, $ruleCategories['core']);
                }
                
                if (!$quietMode) {
                    println(colorize("Web rules (JavaScript, CSS, etc):", 'cyan'));
                }
                $installWeb = strtolower(prompt("Install web rules? (Y/n)", "Y"));
                if ($installWeb === 'y') {
                    $selectedRules = array_merge($selectedRules, $ruleCategories['web']);
                }
                
                if (!$quietMode) {
                    println(colorize("Drupal rules:", 'cyan'));
                }
                $installDrupal = strtolower(prompt("Install Drupal rules? (Y/n)", "Y"));
                if ($installDrupal === 'y') {
                    $selectedRules = array_merge($selectedRules, $ruleCategories['drupal']);
                }
                
                if (!$quietMode) {
                    println(colorize("Python rules:", 'cyan'));
                }
                $installPython = strtolower(prompt("Install Python rules? (Y/n)", "n"));
                if ($installPython === 'y') {
                    $selectedRules = array_merge($selectedRules, $ruleCategories['python']);
                }
                break;
            default:
                if (!$quietMode) {
                    println(colorize("Invalid option. Installing Web Stack rules by default.", 'yellow'));
                }
                $selectedRules = array_merge(
                    $ruleCategories['core'],
                    $ruleCategories['web'],
                    $ruleCategories['drupal']
                );
        }
}

if (!$autoConfirm) {
    println();
    $confirm = strtolower(prompt('Do you want to proceed with the installation? (Y/n)', 'Y'));

    if ($confirm !== 'y') {
        println();
        println(colorize('Installation cancelled by user.', 'red'));
        exit(1);
    }
}

// Create directory if it doesn't exist
if (!$quietMode) {
    println();
    println('Starting installation...');
}

if (!file_exists($targetDir)) {
    if (!mkdir($targetDir, 0755, TRUE)) {
        println(colorize("Error: Failed to create directory '{$targetDir}'", 'red'));
        exit(1);
    }
    if (!$quietMode) {
        println(colorize("Created directory: {$targetDir}", 'green'));
    }
}

// Download and install selected rules
$installedFiles = [];
foreach ($selectedRules as $file) {
    $url = "{$baseUrl}/{$file}";
    $destination = "{$targetDir}/{$file}";
    
    if (!$quietMode) {
        println("Downloading {$file}...");
    }
    if (downloadFile($url, $destination)) {
        $installedFiles[] = $file;
    } else {
        println(colorize("Error: Failed to download {$file}", 'red'));
    }
}

// Download UPDATE.md
if (!$quietMode) {
    println("Downloading UPDATE.md...");
}
if (downloadFile($updateMdUrl, '.cursor/UPDATE.md')) {
    $installedFiles[] = 'UPDATE.md';
} else {
    println(colorize("Error: Failed to download UPDATE.md", 'red'));
}

if (!$quietMode) {
    println();
    println(colorize('Installation Complete!', 'green'));
    println('--------------------------------');
    println(colorize('Installed files:', 'blue'));
    foreach ($installedFiles as $file) {
        println("✓ {$file}");
    }
    println();
    println(colorize('Cursor rules have been installed successfully!', 'green'));
    println('You can now use these rules in your project.');
    println('For information on updating rules, see .cursor/UPDATE.md');
}

@unlink(__FILE__); 