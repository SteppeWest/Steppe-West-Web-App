#!/usr/bin/env php
<?php
// sw_manager/commands/compose.php
// Runs `composer update` in the p2-yii2 directory,
// only prints on failure.

$projectDir = realpath(__DIR__ . '/../../p2-yii2');
if (!$projectDir || !is_dir($projectDir)) {
	fwrite(STDERR, "Error: p2-yii2 not found.\n");
	exit(1);
}

chdir($projectDir);
// Force ANSI output even if composer thinks we're in a pipe:
passthru('composer update --ansi', $exitCode);

if ($exitCode !== 0) {
	// Use our Console helper (see below) to print red
	fwrite(STDERR, Console::fail("`composer update` failed (exit code {$exitCode}).") . "\n");
	exit($exitCode);
}

// silent on success
exit(0);
