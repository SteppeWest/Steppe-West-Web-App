#!/usr/bin/env php
<?php
// sw_manager/lib/Remote.php

class Remote
{
	/**
	 * Look for “-r” in $args, remove it if found, and return true.
	 *
	 * @param array &$args  The arguments passed to the command.
	 * @return bool         Whether remote mode was requested.
	 */
	public static function parseFlag(array &$args): bool
	{
		$i = array_search('-r', $args, true);
		if ($i !== false) {
			array_splice($args, $i, 1);
			return true;
		}
		return false;
	}
}
