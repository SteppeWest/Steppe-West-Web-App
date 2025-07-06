#!/usr/bin/env php
<?php
// sw_manager/lib/Db.php

class Db
{
	/**
	 * Dump the configured database to the given file,
	 * suppressing tablespace errors and the CLI-password warning.
	 *
	 * @param string $outputPath   Path for the .sql file.
	 * @return int                 Exit code.
	 */
	public static function dump(string $outputPath): int
	{
		require_once __DIR__ . '/../credentials.php';

		// Use MYSQL_PWD to avoid "-pPASSWORD" warning,
		// and skip tablespace-related errors.
		$cmd = sprintf(
			'MYSQL_PWD=%s mysqldump --no-tablespaces -h%s -u%s %s > %s',
			escapeshellarg(DB_PASS),
			DB_HOST,
			DB_USER,
			DB_NAME,
			escapeshellarg($outputPath)
		);

		passthru($cmd, $code);
		return $code;
	}
}
