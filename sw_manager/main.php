#!/usr/bin/env php
<?php
/**
 * sw_manager/main.php
 * CLI front-controller for Steppe West project.
 */

// 1) Ensure we’re running from the project root
chdir(__DIR__ . '/..');

// 2) Parse the command name + args
array_shift($argv);                         // drop script name
$cmd  = isset($argv[0]) ? strtolower($argv[0]) : 'help';
$args = array_slice($argv, 1);

// 3) Locate & dispatch to the command script
$cmdFile = __DIR__ . "/commands/{$cmd}.php";
if (is_file($cmdFile)) {
    // make $args available to the command
    $GLOBALS['sw_args'] = $args;
    require $cmdFile;
} else {
    fwrite(STDERR, "Unknown command “{$cmd}”.\n");
    fwrite(STDERR, "Try: ./sw help\n");
    exit(1);
}
