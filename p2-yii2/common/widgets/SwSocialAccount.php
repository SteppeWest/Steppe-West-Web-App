<?php
/**
 * SwSocialAccount.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Provides substitution functionality for use across the application.
 *
 * @class \common\widgets\SwSocialAccount
 * @package common\widgets
 *
 * use common\widgets\SwSocialAccount;
 */

namespace common\widgets;

use frontend\models\SocialAccount;

class SwSocialAccount {
	/**
	 * Applies substitutions to a single string.
	 *
	 * @param string $text
	 * @return string
	 */
	public static function renderSocialAccount($template, $account, $url, $icon)
	{
		// Regular substitutions from the Substitution model
		$substitutions = Substitution::find()->all();

		// Apply regular substitutions
		foreach ($substitutions as $sub) {
			$text = str_replace("{" . $sub->name . "}", $sub->value, $text);
		}

		// Use regex to find all placeholders in single braces, like {UA}
		return preg_replace_callback('/\{([A-Z]{2})\}/', function ($matches) {
			$iconCode = $matches[1];
			// Use SwFlagSelector for two-letter country codes
			return SwFlagSelector::getFlagIcon($iconCode);
		}, $text);
	}

	/**
	 * Recursively applies substitutions to each element of an array.
	 *
	 * @param array $array
	 * @return array
	 */
	public static function processSubstitutions(array $array)
	{
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$array[$key] = self::processSubstitutions($value);
			} elseif (is_string($value)) {
				$array[$key] = self::applySubstitutions($value);
			}
		}
		return $array;
	}
}
