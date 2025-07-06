#!/usr/bin/env php
<?php
// sw_manager/lib/Files.php

class Files
{
	/** @var string */
	private static string $ts;

	/** Initialise a consistent timestamp per run */
	private static function init(): void
	{
		if (!isset(self::$ts)) {
			date_default_timezone_set('Australia/Brisbane');
			self::$ts = date('Y-m-d\TH-i-s');
		}
	}

	/**
	 * Generic filename: <prefix>_<timestamp>_<suffix>.<ext>
	 * @param string $prefix  e.g. DB_NAME or 'sw'
	 * @param bool   $remote  true => 'r', false => 'l'
	 * @param string $ext     extension without leading dot
	 */
	private static function filename(string $prefix, bool $remote, string $ext): string
	{
		self::init();
		$suffix = $remote ? 'r' : 'l';
		return sprintf("%s_%s_%s.%s", $prefix, self::$ts, $suffix, $ext);
	}

	/**
	 * SQL dump filename: <DB_NAME>_<timestamp>_<suffix>.sql
	 */
	public static function sqlFilename(bool $remote): string
	{
		require_once __DIR__ . '/../credentials.php';
		return self::filename(DB_NAME, $remote, 'sql');
	}

	/**
	 * ZIP backup filename: sw_<timestamp>_<suffix>.zip
	 */
	public static function zipFilename(bool $remote): string
	{
		return self::filename('sw', $remote, 'zip');
	}

	/**
	 * Local SQL dump directory: ./z_gitignore/data/dumps
	 */
	public static function sqlLocalDir(): string
	{
		$dir = getcwd() . '/z_gitignore/data/dumps';
		if (!is_dir($dir)) {
			mkdir($dir, 0755, true);
		}
		return $dir;
	}

	/**
	 * Local zip backup directory: ../z_backup
	 */
	public static function zipLocalDir(): string
	{
		$dir = dirname(getcwd()) . '/z_backup';
		if (!is_dir($dir)) {
			mkdir($dir, 0755, true);
		}
		return $dir;
	}

	/**
	 * Full local path to SQL dump
	 */
	public static function sqlLocalPath(bool $remote): string
	{
		return self::sqlLocalDir() . '/' . self::sqlFilename($remote);
	}

	/**
	 * Full local path to zip backup
	 */
	public static function zipLocalPath(bool $remote): string
	{
		return self::zipLocalDir() . '/' . self::zipFilename($remote);
	}

	/**
	 * Remote SQL dump path (relative to home)
	 */
	public static function sqlRemotePath(bool $remote): string
	{
		require_once __DIR__ . '/../credentials.php';
		return sprintf('~/'.SSH_REMOTE_DIR.'/z_gitignore/data/dumps/%s', self::sqlFilename($remote));
	}

	/**
	 * Remote zip backup path (relative to home)
	 */
	public static function zipRemotePath(bool $remote): string
	{
		require_once __DIR__ . '/../credentials.php';
		return sprintf('~/'.SSH_REMOTE_DIR.'/z_backup/%s', self::zipFilename($remote));
	}
}
