#!/usr/bin/env php
<?php
// sw_manager/commands/clean.php

require_once __DIR__ . '/../lib/Console.php';

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
	echo "✅ All runtime directories cleaned.\n";
} else {
	echo "✅ Nothing to clean (all runtime dirs were already empty).\n";
}



// Example:
echo Console::ok("All runtime dirs cleaned.") . "\n";
echo Console::info("Nothing to do.") . "\n";
fwrite(STDERR, Console::fail("Backup failed!") . "\n");
