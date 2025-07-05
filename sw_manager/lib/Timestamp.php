#!/usr/bin/env php
<?php
// sw_manager/lib/Timestamp.php

class Timestamp
{
	/**
	 * ISO-style timestamp for this process, e.g. "2025-07-06T09-15-30".
	 * Static so it's consistent across all calls in one run.
	 *
	 * @var string
	 */
	private static string $ts;

	/**
	 * Initialise the timestamp once.
	 */
	private static function init(): void
	{
		if (!isset(self::$ts)) {
			// Ensure correct timezone
			date_default_timezone_set('Australia/Brisbane');
			self::$ts = date('Y-m-d\TH-i-s');
		}
	}

	/**
	 * Generic filename: <prefix>_<timestamp>_<suffix>.<ext>
	 *
	 * @param string $prefix   e.g. 'sw' or DB_NAME
	 * @param bool   $remote   remote flag (true = 'r', false = 'l')
	 * @param string $ext      file extension without dot
	 * @return string
	 */
	public static function filename(string $prefix, bool $remote, string $ext): string
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
	 * Expose the raw timestamp if ever needed
	 */
	public static function timestamp(): string
	{
		self::init();
		return self::$ts;
	}
}
