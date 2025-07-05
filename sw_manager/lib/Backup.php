<?php
// sw_manager/lib/Backup.php

class Backup
{
	private string $timestamp;
	private string $suffix;
	private string $baseDir;

	public function __construct(bool $remote)
	{
		date_default_timezone_set('Australia/Brisbane');
		$this->timestamp = date('Y-m-d\TH-i-s');
		$this->suffix    = $remote ? 'r' : 'l';
		$this->baseDir   = realpath(__DIR__ . '/../../');
	}

	private function zipFilename(): string
	{
		return "sw_{$this->timestamp}_{$this->suffix}.zip";
	}

	private function sqlFilename(): string
	{
		require __DIR__ . '/../credentials.php';
		return DB_NAME . "_{$this->timestamp}_{$this->suffix}.sql";
	}

	/** Local paths **/
	public function zipLocalPath(): string
	{
		$dir = "{$this->baseDir}/z_gitignore/backup";
		if (!is_dir($dir)) mkdir($dir, 0755, true);
		return "{$dir}/{$this->zipFilename()}";
	}

	public function sqlLocalPath(): string
	{
		$dir = "{$this->baseDir}/z_gitignore/data/dumps";
		if (!is_dir($dir)) mkdir($dir, 0755, true);
		return "{$dir}/{$this->sqlFilename()}";
	}

	/** Remote paths (relative to home) **/
	public function zipRemotePath(): string
	{
		require __DIR__ . '/../credentials.php';
		return sprintf(
			'~/'.SSH_REMOTE_DIR.'/z_gitignore/backup/%s',
			$this->zipFilename()
		);
	}

	public function sqlRemotePath(): string
	{
		require __DIR__ . '/../credentials.php';
		return sprintf(
			'~/'.SSH_REMOTE_DIR.'/z_gitignore/data/dumps/%s',
			$this->sqlFilename()
		);
	}
}
