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
 * --tags: Filter rules by tag expression (e.g., "language:php category:security")
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

// Parse command line options
$options = getopt('wpachyqt:', [
    'web-stack',
    'python',
    'all',
    'core',
    'custom',
    'help',
    'yes',
    'quiet',
    'tags:',
    'tag-preset:',
    'ignore-files:',
]);

// Default settings
$autoConfirm = false;
$quietMode = false;
$installMode = 'interactive';
$tagExpression = '';
$tagPreset = '';
$installIgnoreFiles = 'yes';

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

// Check for ignore files option
if (isset($options['ignore-files'])) {
    $ignoreFilesOption = strtolower($options['ignore-files']);
    if ($ignoreFilesOption === 'yes' || $ignoreFilesOption === 'y') {
        $installIgnoreFiles = 'yes';
    } elseif ($ignoreFilesOption === 'no' || $ignoreFilesOption === 'n') {
        $installIgnoreFiles = 'no';
    } elseif ($ignoreFilesOption === 'ask' || $ignoreFilesOption === 'a') {
        $installIgnoreFiles = 'ask';
    } else {
        println(colorize("Warning: Invalid value for --ignore-files. Using default (ask).", 'yellow'));
    }
}

// Check for tag-based filtering
if (isset($options['tags'])) {
    $tagExpression = $options['tags'];
    $installMode = 'tags';
}

if (isset($options['t'])) {
    $tagExpression = $options['t'];
    $installMode = 'tags';
}

if (isset($options['tag-preset'])) {
    $tagPreset = $options['tag-preset'];
    if (isset(TAG_PRESETS[$tagPreset])) {
        $tagExpression = TAG_PRESETS[$tagPreset];
        $installMode = 'tags';
    } else {
        println(colorize("Error: Unknown tag preset '{$tagPreset}'. Available presets: " . implode(', ', array_keys(TAG_PRESETS)), 'red'));
        exit(1);
    }
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
if ($installOptions > 1 || ($installOptions === 1 && $installMode === 'tags')) {
    println(colorize("Error: Conflicting installation options provided. Please specify only one of: --web-stack, --python, --all, --core, --custom, --tags", 'red'));
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
    println("  --web-stack, -w       Install core, web, and Drupal rules");
    println("  --python, -p          Install core and Python rules");
    println("  --all, -a             Install all rule sets");
    println("  --core, -c            Install only core rules");
    println("  --custom              Enable selective installation (interactive)");
    println("  --tags, -t <query>    Filter rules by tag expression (e.g., \"language:php category:security\")");
    println("  --tag-preset <name>   Use a predefined tag preset (web, frontend, drupal, react, vue, python, security, owasp, a11y)");
    println("  --ignore-files <opt>  Control installation of .cursorignore files (yes, no, ask), default's to yes");
    println("  --help, -h            Display this help information");
    println("  --quiet, -q           Suppress verbose output");
    println("  --yes, -y             Automatically confirm all prompts");
    println();
    println("Tag Expression Examples:");
    println("  \"language:php\"                     - All PHP rules");
    println("  \"language:javascript category:security\" - JavaScript security rules");
    println("  \"framework:drupal standard:owasp-top10\" - Drupal OWASP rules");
    println("  \"language:python OR language:php\"  - All Python or PHP rules");
    println();
    println("Available Tag Presets:");
    foreach (TAG_PRESETS as $preset => $expression) {
        println("  {$preset}: {$expression}");
    }
    println();
    println("Examples:");
    println("  php install.php --web-stack --yes");
    println("  php install.php -p -q");
    println("  php install.php --tags \"language:javascript framework:react\"");
    println("  php install.php --tag-preset security");
    println("  php install.php --ignore-files ask");
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

/**
 * Extract tags from an MDC file.
 * 
 * @param string $content The content of the MDC file
 * @return array Array of tags found in the file
 */
function extractTags(string $content): array {
    $tags = [];
    
    // Look for metadata section with tags
    if (preg_match('/metadata:\s*\n(.*?)(?:\n\w|$)/s', $content, $matches)) {
        $metadataSection = $matches[1];
        
        // Extract tags section
        if (preg_match('/tags:\s*\n(.*?)(?:\n\w|$)/s', $metadataSection, $tagMatches)) {
            $tagsSection = $tagMatches[1];
            
            // Extract individual tags
            preg_match_all('/^\s*-\s*([a-z0-9_-]+:[a-z0-9_-]+)\s*$/m', $tagsSection, $tagItems);
            if (!empty($tagItems[1])) {
                $tags = $tagItems[1];
            }
        }
    }
    
    return $tags;
}

/**
 * Evaluate if a set of tags matches a tag expression.
 * 
 * @param array $tags Array of tags to check
 * @param string $expression Tag expression to evaluate
 * @return bool True if tags match the expression
 */
function matchesTagExpression(array $tags, string $expression): bool {
    // Split by OR operator
    $orParts = explode(' OR ', $expression);
    
    foreach ($orParts as $orPart) {
        // Split by AND operator (space)
        $andParts = array_filter(preg_split('/\s+/', trim($orPart)));
        
        // Check if all AND conditions match
        $allAndMatch = true;
        foreach ($andParts as $andTag) {
            if (!in_array(trim($andTag), $tags)) {
                $allAndMatch = false;
                break;
            }
        }
        
        // If any OR condition is fully satisfied, return true
        if ($allAndMatch) {
            return true;
        }
    }
    
    return false;
}

/**
 * Download a rule file and check if it matches a tag expression.
 * 
 * @param string $file Rule filename
 * @param string $baseUrl Base URL for downloading
 * @param string $tempDir Temporary directory for downloads
 * @param string $tagExpression Tag expression to match against
 * @return bool True if the rule matches the tag expression
 */
function ruleMatchesTags(string $file, string $baseUrl, string $tempDir, string $tagExpression): bool {
    if (empty($tagExpression)) {
        return true;
    }
    
    $url = "{$baseUrl}/{$file}";
    $tempFile = "{$tempDir}/{$file}";
    
    // Download the file to a temporary location
    if (!downloadFile($url, $tempFile)) {
        return false;
    }
    
    // Read the file content
    $content = file_get_contents($tempFile);
    if ($content === false) {
        return false;
    }
    
    // Extract tags and check if they match the expression
    $tags = extractTags($content);
    return matchesTagExpression($tags, $tagExpression);
}

if (!$quietMode) {
    println(colorize('Cursor Rules Installer', 'blue'));
    println('================================');
    println();
}

$targetDir = '.cursor/rules';
$baseUrl = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/rules';
$updateMdUrl = 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursor/UPDATE.md';

// Create a temporary directory for tag checking
$tempDir = sys_get_temp_dir() . '/cursor-rules-' . uniqid();
if (!file_exists($tempDir)) {
    mkdir($tempDir, 0755, true);
}

// Define rule categories
$ruleCategories = [
    'core' => [
        'cursor-rules.mdc',
        'improve-cursorrules-efficiency.mdc',
        'git-commit-standards.mdc',
        'readme-maintenance-standards.mdc',
        'secret-detection.mdc', // Always include secret detection rule
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
    'javascript-owasp' => [
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
    case 'tags':
        if (!$quietMode) {
            println(colorize("Selecting rules based on tag expression: {$tagExpression}", 'green'));
        }
        
        // Get all available rules
        $allRules = array_merge(
            $ruleCategories['core'],
            $ruleCategories['web'],
            $ruleCategories['drupal'],
            $ruleCategories['python'],
            $ruleCategories['javascript-owasp']
        );
        
        // Always include core rules
        $selectedRules = $ruleCategories['core'];
        
        // Intelligent OWASP rule selection based on language tags
        if (strpos($tagExpression, 'language:') !== false) {
            // Extract language from tag expression
            if (preg_match('/language:(php|javascript|python|js)/', $tagExpression, $matches)) {
                $language = $matches[1];
                if ($language === 'js') $language = 'javascript';
                
                // If the expression also contains OWASP or security tags, add language-specific OWASP rules
                if (strpos($tagExpression, 'standard:owasp') !== false || 
                    strpos($tagExpression, 'category:security') !== false) {
                    
                    // Add language-specific OWASP rules
                    switch ($language) {
                        case 'php':
                        case 'drupal':
                            if (!$quietMode) {
                                println(colorize("Adding PHP/Drupal OWASP rules based on language tag", 'blue'));
                            }
                            $selectedRules = array_merge($selectedRules, $ruleCategories['drupal']);
                            break;
                        case 'javascript':
                            if (!$quietMode) {
                                println(colorize("Adding JavaScript OWASP rules based on language tag", 'blue'));
                            }
                            $selectedRules = array_merge($selectedRules, $ruleCategories['javascript-owasp']);
                            break;
                        case 'python':
                            if (!$quietMode) {
                                println(colorize("Adding Python OWASP rules based on language tag", 'blue'));
                            }
                            $selectedRules = array_merge($selectedRules, $ruleCategories['python']);
                            break;
                    }
                }
            }
        }
        
        // Check each rule against the tag expression
        foreach ($allRules as $rule) {
            // Skip rules that are already included
            if (in_array($rule, $selectedRules)) {
                continue;
            }
            
            if (ruleMatchesTags($rule, $baseUrl, $tempDir, $tagExpression)) {
                $selectedRules[] = $rule;
            }
        }
        
        if (count($selectedRules) <= count($ruleCategories['core']) && !$quietMode) {
            println(colorize("Warning: No additional rules matched the tag expression. Only core rules will be installed.", 'yellow'));
        }
        break;
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
            println("4) " . colorize("Core Rules Only", 'white') . " (Essential rules only)");
            println("5) " . colorize("Tag-Based Selection", 'white') . " (Filter by tags)");
            println("6) " . colorize("Security Focus", 'white') . " (OWASP & security rules)");
            println("7) " . colorize("Custom Selection", 'white') . " (Choose specific rule sets)");
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
                    println(colorize("Core Rules Only:", 'magenta'));
                    println("Select which core rules to install:");
                    println("1) " . colorize("All Core Rules", 'white'));
                    println("2) " . colorize("Core Rules (Essential)", 'white'));
                    println();
                }
                
                $coreOption = prompt("Enter option number", "1");
                
                // Always include core rules
                $selectedRules = $ruleCategories['core'];
                
                switch ($coreOption) {
                    case "1":
                        if (!$quietMode) {
                            println(colorize("Installing all core rules...", 'green'));
                        }
                        break;
                    case "2":
                        if (!$quietMode) {
                            println(colorize("Installing core rules (essential only)", 'green'));
                        }
                        // Add essential core rules
                        $selectedRules = array_merge($selectedRules, [
                            'cursor-rules.mdc',
                            'improve-cursorrules-efficiency.mdc',
                            'git-commit-standards.mdc',
                            'readme-maintenance-standards.mdc',
                        ]);
                        break;
                    default:
                        if (!$quietMode) {
                            println(colorize("Invalid option. Installing all core rules by default.", 'yellow'));
                        }
                        $selectedRules = $ruleCategories['core'];
                }
                break;
            case "5":
                if (!$quietMode) {
                    println(colorize("Tag-Based Selection:", 'magenta'));
                    println("Enter a tag expression to filter rules.");
                    println("Examples: \"language:php\", \"framework:drupal category:security\"");
                    println();
                }
                
                $tagExpression = prompt("Enter tag expression");
                
                if (empty($tagExpression)) {
                    println(colorize("No tag expression provided. Installing core rules only.", 'yellow'));
                    $selectedRules = $ruleCategories['core'];
                } else {
                    // Get all available rules
                    $allRules = array_merge(
                        $ruleCategories['core'],
                        $ruleCategories['web'],
                        $ruleCategories['drupal'],
                        $ruleCategories['python']
                    );
                    
                    // Always include core rules
                    $selectedRules = $ruleCategories['core'];
                    
                    // Check each rule against the tag expression
                    foreach ($allRules as $rule) {
                        // Skip core rules as they're already included
                        if (in_array($rule, $ruleCategories['core'])) {
                            continue;
                        }
                        
                        if (ruleMatchesTags($rule, $baseUrl, $tempDir, $tagExpression)) {
                            $selectedRules[] = $rule;
                        }
                    }
                    
                    if (count($selectedRules) <= count($ruleCategories['core']) && !$quietMode) {
                        println(colorize("Warning: No additional rules matched the tag expression. Only core rules will be installed.", 'yellow'));
                    }
                }
                break;
            case "6":
                if (!$quietMode) {
                    println(colorize("Security Focus Selection:", 'magenta'));
                    println("Select which language-specific security rules to install:");
                    println("1) " . colorize("PHP/Drupal Security", 'white'));
                    println("2) " . colorize("JavaScript Security", 'white'));
                    println("3) " . colorize("Python Security", 'white'));
                    println("4) " . colorize("All Security Rules", 'white'));
                    println();
                }
                
                $secOption = prompt("Enter option number", "4");
                
                // Always include core rules
                $selectedRules = $ruleCategories['core'];
                
                switch ($secOption) {
                    case "1":
                        if (!$quietMode) {
                            println(colorize("Installing PHP/Drupal security rules...", 'green'));
                        }
                        // Use tag-based selection with the php-security preset
                        $tagExpression = TAG_PRESETS['php-owasp'];
                        foreach ($ruleCategories['drupal'] as $rule) {
                            if (strpos($rule, 'drupal-') === 0) {
                                $selectedRules[] = $rule;
                            }
                        }
                        break;
                    case "2":
                        if (!$quietMode) {
                            println(colorize("Installing JavaScript security rules...", 'green'));
                        }
                        // Add JavaScript OWASP rules
                        $selectedRules = array_merge($selectedRules, $ruleCategories['javascript-owasp']);
                        break;
                    case "3":
                        if (!$quietMode) {
                            println(colorize("Installing Python security rules...", 'green'));
                        }
                        // Add Python OWASP rules
                        $selectedRules = array_merge($selectedRules, $ruleCategories['python']);
                        break;
                    case "4":
                    default:
                        if (!$quietMode) {
                            println(colorize("Installing all security rules...", 'green'));
                        }
                        // Add all OWASP rules
                        $selectedRules = array_merge(
                            $selectedRules,
                            $ruleCategories['drupal'],
                            $ruleCategories['python'],
                            $ruleCategories['javascript-owasp']
                        );
                        break;
                }
                break;
            case "7":
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
    println(colorize("Selected " . count($selectedRules) . " rules for installation.", 'blue'));
    $confirm = strtolower(prompt('Do you want to proceed with the installation? (Y/n)', 'Y'));

    if ($confirm !== 'y') {
        println();
        println(colorize('Installation cancelled by user.', 'red'));
        
        // Clean up temporary directory
        if (file_exists($tempDir)) {
            array_map('unlink', glob("$tempDir/*.*"));
            rmdir($tempDir);
        }
        
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
        
        // Clean up temporary directory
        if (file_exists($tempDir)) {
            array_map('unlink', glob("$tempDir/*.*"));
            rmdir($tempDir);
        }
        
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
    
    // If we already downloaded the file for tag checking, move it
    if (file_exists("{$tempDir}/{$file}")) {
        if (rename("{$tempDir}/{$file}", $destination)) {
            $installedFiles[] = $file;
            if (!$quietMode) {
                println("Installed {$file}");
            }
        } else {
            println(colorize("Error: Failed to install {$file}", 'red'));
        }
    } else {
        if (!$quietMode) {
            println("Downloading {$file}...");
        }
        if (downloadFile($url, $destination)) {
            $installedFiles[] = $file;
        } else {
            println(colorize("Error: Failed to download {$file}", 'red'));
        }
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

// Install ignore files if requested
$ignoreFiles = [
    '.cursorignore' => 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursorignore',
    '.cursorindexingignore' => 'https://raw.githubusercontent.com/ivangrynenko/cursor-rules/main/.cursorindexingignore'
];

$shouldInstallIgnoreFiles = false;

if ($installIgnoreFiles === 'yes') {
    $shouldInstallIgnoreFiles = true;
} elseif ($installIgnoreFiles === 'ask' && !$autoConfirm) {
    println();
    println(colorize("Would you like to install .cursorignore and .cursorindexingignore files?", 'cyan'));
    println("These files help Cursor AI ignore sensitive files and improve search quality.");
    $response = strtolower(prompt("Install ignore files? (Y/n)", "Y"));
    $shouldInstallIgnoreFiles = ($response === 'y');
} elseif ($installIgnoreFiles === 'ask' && $autoConfirm) {
    // If auto-confirm is enabled and we're set to ask, default to yes
    $shouldInstallIgnoreFiles = true;
}

if ($shouldInstallIgnoreFiles) {
    if (!$quietMode) {
        println();
        println(colorize("Installing ignore files...", 'blue'));
    }
    
    foreach ($ignoreFiles as $file => $url) {
        $fileExists = file_exists($file);
        
        if ($fileExists && !$autoConfirm) {
            println(colorize("File '{$file}' already exists.", 'yellow'));
            $overwrite = strtolower(prompt("Overwrite? (y/N)", "N"));
            if ($overwrite !== 'y') {
                if (!$quietMode) {
                    println("Skipping {$file}");
                }
                continue;
            }
        } elseif ($fileExists && $autoConfirm) {
            // With auto-confirm, we'll skip existing files by default
            if (!$quietMode) {
                println(colorize("File '{$file}' already exists. Skipping.", 'yellow'));
            }
            continue;
        }
        
        if (!$quietMode) {
            println("Downloading {$file}...");
        }
        
        if (downloadFile($url, $file)) {
            $installedFiles[] = $file;
            if (!$quietMode) {
                println(colorize("Installed {$file}", 'green'));
            }
        } else {
            println(colorize("Error: Failed to download {$file}", 'red'));
        }
    }
}

// Clean up temporary directory
if (file_exists($tempDir)) {
    array_map('unlink', glob("$tempDir/*.*"));
    rmdir($tempDir);
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