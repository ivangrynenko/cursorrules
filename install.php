<?php

declare(strict_types=1);

/**
 * Cursor Rules Installer Script.
 * 
 * This script downloads and installs Cursor rules into your project's .cursor/rules directory.
 */

// ANSI color codes for terminal output
const COLORS = [
    'red' => "\033[0;31m",
    'green' => "\033[0;32m",
    'yellow' => "\033[1;33m",
    'blue' => "\033[0;34m",
    'reset' => "\033[0m",
];

/**
 * Print colored message to terminal.
 */
function colorize(string $message, string $color): string {
    return COLORS[$color] . $message . COLORS['reset'];
}

/**
 * Print message to terminal.
 */
function println(string $message = ''): void {
    echo $message . PHP_EOL;
}

/**
 * Get user input with optional default value.
 */
function prompt(string $message, string $default = ''): string {
    echo $message . ($default ? " [{$default}]" : '') . ': ';
    $input = trim(fgets(STDIN));
    return $input ?: $default;
}

/**
 * Download a file from URL.
 */
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

// Script start
println(colorize('Cursor Rules Installer', 'blue'));
println('================================');
println();

$targetDir = '.cursor/rules';
$baseUrl = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/rules';
$ruleFiles = [
    'accessibility-standards.mdc',
    'api-standards.mdc',
    'build-optimization.mdc',
    'cursor-rules.mdc',
    'drupal-database-standards.mdc',
    'git-commit-standards.mdc',
    'improve-cursorrules-efficiency.mdc',
    'javascript-performance.mdc',
    'javascript-standards.mdc',
    'node-dependencies.mdc',
    'php-drupal-best-practices.mdc',
    'react-patterns.mdc',
    'security-practices.mdc',
    'tailwind-standards.mdc',
    'third-party-integration.mdc',
    'vue-best-practices.mdc',
];

// Check if target directory exists
if (!file_exists($targetDir)) {
    println(colorize("Notice: Directory '{$targetDir}' does not exist.", 'yellow'));
    println("It will be created during installation.");
} else {
    println(colorize("Warning: Directory '{$targetDir}' already exists.", 'yellow'));
    println("Existing files with the same names will be overwritten.");
}

println();
$confirm = strtolower(prompt('Do you want to proceed with the installation? (Y/n)', 'Y'));

if ($confirm !== 'y') {
    println();
    println(colorize('Installation cancelled by user.', 'red'));
    exit(1);
}

println();
println('Starting installation...');

// Create directory if it doesn't exist
if (!file_exists($targetDir)) {
    if (!mkdir($targetDir, 0755, TRUE)) {
        println(colorize("Error: Failed to create directory '{$targetDir}'", 'red'));
        exit(1);
    }
    println(colorize("Created directory: {$targetDir}", 'green'));
}

// Download and install rules
$installedFiles = [];
foreach ($ruleFiles as $file) {
    $url = "{$baseUrl}/{$file}";
    $destination = "{$targetDir}/{$file}";
    
    println("Downloading {$file}...");
    if (downloadFile($url, $destination)) {
        $installedFiles[] = $file;
    } else {
        println(colorize("Error: Failed to download {$file}", 'red'));
    }
}

// Installation summary
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

// Self-delete
@unlink(__FILE__); 