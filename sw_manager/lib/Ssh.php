#!/usr/bin/env php
<?php
// sw_manager/lib/Ssh.php

class Ssh
{
	/**
	 * Run a command locally or remotely.
	 *
	 * @param string $cmd            The shell command to run.
	 * @param bool   $remote         If true, run over SSH; otherwise run locally.
	 * @param string $remoteDir      Working dir on the remote host (relative to home).
	 * @param bool   $allocateTty    Whether to allocate a TTY (-t) for ANSI colours.
	 * @return int                   Exit code.
	 */
	public static function run(string $cmd, bool $remote = false, ?string $remoteDir = null, bool $allocateTty = true): int
	{
		if ($remote) {
			// load SSH constants
			require_once __DIR__ . '/../credentials.php';
			$remoteDir = $remoteDir ?? SSH_REMOTE_DIR;
			$sshFlags = $allocateTty ? '-t' : '';
			$full = sprintf(
				'ssh %s %s %s',
				$sshFlags,
				SSH_ALIAS,
				escapeshellarg(sprintf('cd ~/%%s && %s', $cmd)),
			);
			$ssh = sprintf($full, $remoteDir);
			passthru($ssh, $code);
			return $code;
		} else {
			passthru($cmd, $code);
			return $code;
		}
	}

	/**
	 * Copy a file from remote to local via scp.
	 *
	 * @param string $remotePath   Path on the remote host (with ~/ or absolute).
	 * @param string $localPath    Destination on local filesystem.
	 * @return int                 Exit code.
	 */
	public static function scpGet(string $remotePath, string $localPath): int
	{
		require_once __DIR__ . '/../credentials.php';
		$scp = sprintf(
			'scp %s:%s %s',
			SSH_ALIAS,
			escapeshellarg($remotePath),
			escapeshellarg($localPath)
		);
		passthru($scp, $code);
		return $code;
	}
}
