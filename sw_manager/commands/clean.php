#!/usr/bin/env php
<?php
// sw_manager/commands/clean.php

// 1. Load your libraries
require_once __DIR__ . '/../lib/Console.php';
require_once __DIR__ . '/../lib/Remote.php';
require_once __DIR__ . '/../lib/Options.php';

// 2. Grab the arguments passed in
$args = $GLOBALS['sw_args'] ?? [];

// 3. Parse flags (order only matters if flags interact)
$remote = Remote::parseFlag($args);
$dryRun = Options::parseFlag($args, '--dry-run');

// …now you can use $remote, $dryRun, $args, and Console::* in your logic…

/**
 * Recursively delete a directory’s contents (but not the dir itself).
 */
function rrmdir_contents(string $dir): void {
	foreach (glob(rtrim($dir, '/').'/*') ?: [] as $path) {
		if (is_dir($path)) {
			rrmdir_contents($path);
			rmdir($path);
		} else {
			unlink($path);
		}
	}
}

// pattern for each runtime folder under p2-yii2/*/runtime/*
$pattern = __DIR__ . '/../../p2-yii2/*/runtime/*';

$didClean = false;
foreach (glob($pattern, GLOB_ONLYDIR) ?: [] as $runtimeDir) {
	// check if there's anything inside
	$contents = glob(rtrim($runtimeDir, '/') . '/*');
	if (empty($contents)) {
		continue;
	}

	echo "Cleaning: {$runtimeDir}\n";
	rrmdir_contents($runtimeDir);
	$didClean = true;
}

if ($didClean) {
	echo Console::ok("✅ All runtime directories cleaned.") . "\n";
} else {
	echo Console::ok("✅ Nothing to clean (all runtime dirs were already empty).") . "\n";
	echo "";
}
