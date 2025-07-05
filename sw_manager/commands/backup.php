#!/usr/bin/env php
<?php
// sw_manager/commands/backup.php

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../lib/Console.php';
require_once __DIR__ . '/../lib/Remote.php';
require_once __DIR__ . '/../lib/Ssh.php';
require_once __DIR__ . '/../lib/Db.php';
require_once __DIR__ . '/../lib/Backup.php';

$args   = $GLOBALS['sw_args'] ?? [];
$remote = Remote::parseFlag($args);

// instantiate helper
$backup   = new Backup($remote);
$zipLocal = $backup->zipLocalPath();
$sqlLocal = $backup->sqlLocalPath();

// 1) DB dump
Console::info("Dumping DB… ");
if ($remote) {
	// remote dump to remote path
	$remoteSql = $backup->sqlRemotePath();
	$cmd       = sprintf(
		'php -r %s',
		var_export("require 'sw_manager/lib/Db.php'; Db::dump('{$remoteSql}');", true)
	);
	$code = Ssh::run($cmd, true, SSH_REMOTE_DIR);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("DB dump failed (exit code {$code}).\n"));
		exit($code);
	}
	// fetch back and remove remote
	Ssh::scpGet($remoteSql, $sqlLocal) && Ssh::run("rm ".escapeshellarg($remoteSql), true, SSH_REMOTE_DIR);
} else {
	$code = Db::dump($sqlLocal);
	if ($code !== 0) {
		fwrite(STDERR, Console::fail("DB dump failed (exit code {$code}).\n"));
		exit($code);
	}
}
echo Console::ok("done\n");

// 2) Create ZIP
Console::info("Creating ZIP… ");
$patterns = [
	'p2-yii2/vendor/*',
	'p2-yii2/*/runtime/*/*',
	'public_html/assets/*',
	'public_html/sub_*/assets/*',
];
$exFlags = array_map(fn($p) => '-x '.escapeshellarg($p), $patterns);

if ($remote) {
	$remoteZip = $backup->zipRemotePath();
	$zipCmd    = sprintf(
		'cd ~/'.SSH_REMOTE_DIR.' && zip -r -q %s p2-yii2 public_html %s %s',
		escapeshellarg($remoteZip),
		escapeshellarg(basename($sqlLocal)),
		implode(' ', $exFlags)
	);
	Ssh::run($zipCmd, true, SSH_REMOTE_DIR);
	// fetch back & remove remote zip
	Ssh::scpGet($remoteZip, $zipLocal) && Ssh::run("rm ".escapeshellarg($remoteZip), true, SSH_REMOTE_DIR);
} else {
	$zipCmd = sprintf(
		'cd %s && zip -r -q %s p2-yii2 public_html %s %s',
		escapeshellarg(realpath(__DIR__.'/../../')),
		escapeshellarg($zipLocal),
		escapeshellarg(basename($sqlLocal)),
		implode(' ', $exFlags)
	);
	Ssh::run($zipCmd, false);
}
echo Console::ok("done\n");

// 3) Prompt to delete SQL dump
echo Console::info("Delete SQL dump? [y/N]: ");
$ans = trim(fgets(STDIN));
if (strtolower($ans)==='y') {
	@unlink($sqlLocal);
	echo Console::ok("Deleted SQL dump.\n");
}

// 4) Final
echo Console::ok("✅ Backup complete: {$zipLocal}\n");
exit(0);
