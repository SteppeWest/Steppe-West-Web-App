#!/usr/bin/env php
<?php
// sw_manager/lib/Console.php

class Console
{
	// ANSI colour codes
	private const COLORS = [
		'reset'   => '0',
		'red'     => '31',
		'green'   => '32',
		'yellow'  => '33',
		'blue'    => '34',
		'magenta' => '35',
		'cyan'    => '36',
		'white'   => '37',
	];

	/**
	 * Wraps a message in the given colour.
	 */
	public static function color(string $text, string $colour): string
	{
		$code = self::COLORS[$colour] ?? self::COLORS['reset'];
		return "\033[{$code}m{$text}\033[" . self::COLORS['reset'] . "m";
	}

	/** green “ok” */
	public static function ok(string $text): string
	{
		return self::color($text, 'green');
	}

	/** yellow “info” */
	public static function info(string $text): string
	{
		return self::color($text, 'yellow');
	}

	/** red “fail” */
	public static function fail(string $text): string
	{
		return self::color($text, 'red');
	}
}
