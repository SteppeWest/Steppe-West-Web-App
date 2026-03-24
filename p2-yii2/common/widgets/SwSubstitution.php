<?php
/**
 * SwSubstitution.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Provides substitution functionality for use across the application.
 *
 * @class \common\widgets\SwSubstitution
 * @package common\widgets
 *
 * use common\widgets\SwSubstitution;
 */

namespace common\widgets;

use yii\bootstrap5\Html;
use common\models\Substitution;
use p2m\helpers\BI;
use p2m\helpers\FI;

class SwSubstitution
{
	/**
	 * Recursively applies substitutions to each element of an array.
	 */
	public static function processSubstitutions(array $input)
	{
		foreach ($input as $key => $value) {
			if (is_array($value)) {
				$input[$key] = self::processSubstitutions($value);
			}
			elseif (is_string($value)) {
				$input[$key] = self::applySubstitutions($value);
			}
		}
		return $input;
	}

	/**
	 * Applies substitutions to a single string.
	 *
	 * @param string $text
	 * @return string
	 */
	public static function applySubstitutions(string $text): string
	{
		// 1) Double-brace flags
		$text = preg_replace_callback(
			'/\{\{([a-z]{2}(?:[a-z-][a-z0-9]{0,9})?)\}\}/',
			function (array $match) {
				// $code[1] is the code, e.g. 'gb', 'kz', 'ua', 'au-qld', 'pride'
				// $match[1] is now guaranteed to be:
				//  • length 2–12
				//  • first two chars [a-z]
				//  • third char (if any) [a-z or -]
				//  • remaining chars [a-z0-9]
				return FI::i($match[1]);
			},
			$text
		);

		// 2) Single-brace text/link substitutions
		return preg_replace_callback(
			'/\{([A-Za-z0-9_-]+)\}/',
			function (array $match) {
				$name = $match[1];

				$substitution = Substitution::findOne(['name' => $name]);
				if (!$substitution) {
					return $match[0]; // leave placeholder intact
				}

				// Escape the title
				$title = Html::encode($substitution->title);

				// if no URL, return plain text
				if (empty($substitution->url)) {
					return $title;
				}

				// Build link options
				$linkOptions = [
					'title'  => $title,
					'target' => $substitution->external ? '_blank' : '_self',
				];

				if (!empty($substitution->class)) {
					$linkOptions['class'] = $substitution->class;
				}

				// Build link text: icon only for btn-* classes
				if (!empty($substitution->icon)) {
					$icon = BI::i($substitution->icon);
					$linkText = strpos($substitution->class ?? '', 'btn') === 0
							  ? $icon
							  : $icon . '&nbsp;' . $title;
				} else {
					$linkText = $title;
				}

				return Html::a($linkText, $substitution->url, $linkOptions);
			},
			$text
		);
	}
}
