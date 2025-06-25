#!/usr/bin/env php
<?php
// sw_manager/commands/backup.php

require_once __DIR__ . '/../lib/Console.php';
require_once __DIR__ . '/../lib/Remote.php';
require_once __DIR__ . '/../lib/Ssh.php';
require_once __DIR__ . '/../lib/Db.php';

$args     = $GLOBALS['sw_args'] ?? [];
$remote   = Remote::parseFlag($args);
date_default_timezone_set('Australia/Brisbane');
$ts       = date('Y-m-d\TH-i-s');
$suffix   = $remote ? 'r' : 'l';
$baseDir  = realpath(__DIR__ . '/../../');
$zipLocal = "{$baseDir}/z_gitignore/backup/{$ts}-{$suffix}.zip";
$sqlRel   = "{$baseDir}/z_gitignore/data/".DB_NAME."_{$ts}.sql";

// 1) Dump DB
$code = $remote
	? Ssh::run(sprintf('php -r %s', var_export("require 'sw_manager/lib/Db.php'; Db::dump('{$sqlRel}');", true)), true, SSH_REMOTE_DIR)
	: Db::dump($sqlRel);
if ($code !== 0) {
	fwrite(STDERR, Console::fail("DB dump failed (exit code {$code}).\n"));
	exit($code);
}

// 2) Build exclude patterns
$excludes = [
	'p2-yii2/*/vendor/*',
	'p2-yii2/*/runtime/*/*',
	'public_html/assets/*',
	'public_html/sub_*/assets/*',
];
$excludeFlags = array_map(fn($p) => '-x '.escapeshellarg($p), $excludes);

// 3) Zip
$zipCmd = sprintf(
	'cd %s && zip -r %s p2-yii2 public_html %s %s',
	escapeshellarg($baseDir),
	escapeshellarg($remote ? "~/".SSH_REMOTE_DIR."/z_gitignore/backup/{$ts}-r.zip" : $zipLocal),
	escapeshellarg(basename($sqlRel)),
	implode(' ', $excludeFlags)
);

$code = $remote
	? Ssh::run($zipCmd, true, SSH_REMOTE_DIR)
	: Ssh::run($zipCmd, false);
if ($code !== 0) {
	fwrite(STDERR, Console::fail("Zip failed (exit code {$code}).\n"));
	exit($code);
}

// 4) If remote, scp back
if ($remote) {
	$remoteZip = "~/".SSH_REMOTE_DIR."/z_gitignore/backup/{$ts}-r.zip";
	$code = Ssh::scpGet($remoteZip, $zipLocal);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("SCP fetch failed (exit code {$code}).\n"));
		exit($code);
	}
}

echo Console::ok("Backup complete: {$zipLocal}\n");
exit(0);
