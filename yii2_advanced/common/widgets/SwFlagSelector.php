<?php
/**
 * SwFlagSelector.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\widgets\SwFlagSelector
 *
 * use common\widgets\SwFlagSelector;
 */

namespace common\widgets;

class SwFlagSelector
{
	public static function getFlagIcon($iconCode)
	{
		// Check if the icon code is strictly 2 characters in A-Z
		if (preg_match('/^[A-Z]{2}$/', $iconCode)) {
			$codePoints = [
				127397 + ord($iconCode[0]),
				127397 + ord($iconCode[1])
			];
			return mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
		}
		else {
			return 'NF'; // we will later return an SVG here
		}
	}
}
