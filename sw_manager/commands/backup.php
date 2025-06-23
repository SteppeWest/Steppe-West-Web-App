#!/usr/bin/env php
<?php
// sw_manager/commands/backup.php

require_once __DIR__ . '/../lib/Console.php';
require_once __DIR__ . '/../lib/Remote.php';

$args   = $GLOBALS['sw_args'] ?? [];
$remote = Remote::parseFlag($args);

// Load your non‐secret constants (and DB credentials) in credentials.php
// It must define at least:
//   SSH_ALIAS       e.g. 'steppewest'
//   SSH_REMOTE_DIR  e.g. 'domains/steppewest.com'
//   DB_HOST, DB_USER, DB_PASS, DB_NAME
require __DIR__ . '/../credentials.php';

// Build timestamp and file paths
date_default_timezone_set('Australia/Brisbane');
$ts       = date('Y-m-d\TH-i-s');
$suffix   = $remote ? 'r' : 'l';
$baseDir  = realpath(__DIR__ . '/../../');
$backupDirLocal = $baseDir . '/z_gitignore/backup';
@mkdir($backupDirLocal, 0755, true);
$zipLocal = "{$backupDirLocal}/{$ts}-{$suffix}.zip";

// Patterns to exclude when zipping
$excludes = [
	'p2-yii2/*/vendor/*',
	'p2-yii2/*/runtime/*/*',
	'public_html/assets/*',
	'public_html/sub_*/assets/*',
];

// Prepare the SQL dump command
$sqlRel   = "z_gitignore/data/".DB_NAME."_{$ts}.sql";
@mkdir(dirname("{$baseDir}/{$sqlRel}"), 0755, true);
$sqlCmd   = sprintf(
	'mysqldump -h%s -u%s -p%s %s > %s',
	DB_HOST, DB_USER, DB_PASS, DB_NAME,
	escapeshellarg($sqlRel)
);

// Helper to build the zip command
function buildZip(string $zipPath, array $excludes): string {
	$cmd = "zip -r " . escapeshellarg($zipPath) . " p2-yii2 public_html " . escapeshellarg($GLOBALS['sqlRel']);
	foreach ($excludes as $pattern) {
		$cmd .= " -x " . escapeshellarg($pattern);
	}
	return $cmd;
}

if ($remote) {
	// Remote: run over SSH, then scp back
	$remoteZip = "~/".SSH_REMOTE_DIR."/z_gitignore/backup/{$ts}-r.zip";
	$remoteSql = "~/".SSH_REMOTE_DIR."/{$sqlRel}";
	$cmds = [
		"cd ~/".SSH_REMOTE_DIR,
		$sqlCmd,
		buildZip($remoteZip, $excludes),
		"rm ".escapeshellarg($remoteSql),
	];
	$ssh  = sprintf(
		'ssh -t %s %s',
		SSH_ALIAS,
		escapeshellarg(implode(' && ', $cmds))
	);
	passthru($ssh, $code);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("Remote backup failed (exit code {$code}).\n"));
		exit($code);
	}
	// Copy it back
	$scp = sprintf(
		'scp %s:%s %s',
		SSH_ALIAS,
		escapeshellarg($remoteZip),
		escapeshellarg($zipLocal)
	);
	passthru($scp, $code);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("Failed to copy remote backup (exit code {$code}).\n"));
		exit($code);
	}
	echo Console::ok("✅ Remote backup complete: {$zipLocal}\n");

} else {
	// Local: run everything here
	chdir($baseDir);
	passthru($sqlCmd, $code);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("DB dump failed (exit code {$code}).\n"));
		exit($code);
	}
	$zipCmd = buildZip($zipLocal, $excludes);
	passthru($zipCmd, $code);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("Zip creation failed (exit code {$code}).\n"));
		exit($code);
	}
	// Clean up the SQL file
	@unlink("{$baseDir}/{$sqlRel}");
	echo Console::ok("✅ Local backup complete: {$zipLocal}\n");
}

exit(0);
