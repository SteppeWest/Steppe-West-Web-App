<?php
// sw_manager/lib/Db.php

class Db
{
	/**
	 * Dump the configured database to the given file.
	 *
	 * @param string $outputPath   Relative or absolute path for the .sql file.
	 * @return int                 Exit code of mysqldump.
	 */
	public static function dump(string $outputPath): int
	{
		require_once __DIR__ . '/../credentials.php';
		$dsn = sprintf(
			'mysqldump -h%s -u%s -p%s %s > %s',
			DB_HOST,
			DB_USER,
			DB_PASS,
			DB_NAME,
			escapeshellarg($outputPath)
		);
		passthru($dsn, $code);
		return $code;
	}
}
