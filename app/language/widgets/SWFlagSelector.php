<?php
/**
 * SWFlagSelector.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \language\widgets\SWFlagSelector
 *
 * use language\widgets\SWFlagSelector;
 */

namespace language\widgets;

class SWFlagSelector
{
	public static function getFlag($code)
	{
		// Check if the country code is strictly 2 characters in A-Z
		if (preg_match('/^[A-Z]{2}$/', $code)) {
			$codePoints = [
				127397 + ord($code[0]),
				127397 + ord($code[1])
			];
			$emoji = mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
			return $emoji ?: 'NF';
		}

		// Check if the country code is 2 or 3 characters in a-z
		if (preg_match('/^[a-z]{2,3}$/', $code)) {
			return 'NF'; // we will later return an SVG here
		}

		// If none of the above conditions are met, return 'NF'
		return 'NF';
	}
}
