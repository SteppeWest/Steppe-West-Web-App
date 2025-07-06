<?php
// sw_manager/lib/Options.php

class Options
{
	public static function parseFlag(array &$args, string $flag): bool
	{
		$i = array_search($flag, $args, true);
		if ($i !== false) {
			array_splice($args, $i, 1);
			return true;
		}
		return false;
	}
}
