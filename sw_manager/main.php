#!/usr/bin/env php
<?php
/**
 * sw_manager/main.php
 * CLI front-controller for Steppe West project.
 */

// 1) Ensure we’re running from the project root
chdir(__DIR__ . '/..');

// 2) (Optional) load your credentials if needed by commands
if (file_exists(__DIR__ . '/credentials.php')) {
    require __DIR__ . '/credentials.php';
}

// 3) Parse the command name + args
array_shift($argv);                         // drop script name
$cmd  = isset($argv[0]) ? strtolower($argv[0]) : 'help';
$args = array_slice($argv, 1);

// 4) Locate & dispatch to the command script
$cmdFile = __DIR__ . "/commands/{$cmd}.php";
if (is_file($cmdFile)) {
    // Pass $args into the command
    require $cmdFile;
} else {
    fwrite(STDERR, "Unknown command “{$cmd}”.\n");
    fwrite(STDERR, "Try: php main.php help\n");
    exit(1);
}
