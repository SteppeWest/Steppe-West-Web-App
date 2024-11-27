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

use yii\helpers\Html;
use common\widgets\SwFlagSelector;
use frontend\models\Substitution;

class SwSubstitution {
	/**
	 * Recursively applies substitutions to each element of an array.
	 *
	 * @param array $array
	 * @return array
	 */
	public static function processSubstitutions(array $array)
	{
		if (is_array($input)) {
			foreach ($input as $key => $value) {
				$input[$key] = self::processSubstitutions($value);
			}
			return $input;
		} elseif (is_string($input)) {
			return self::applySubstitutions($input);
		}

		return $input;
	}

	/**
	 * Applies substitutions to a single string.
	 *
	 * @param string $text
	 * @return string
	 */
	public static function applySubstitutions($text)
	{
		// Use regex to find all placeholders in braces, like {UA} or {SubstitutionName}
		return preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', function ($matches) {
			$name = $matches[1];

			// Check if the name is exactly 2 uppercase letters for a flag emoji
			if (preg_match('/^[A-Z]{2}$/', $name)) {
				return SwFlagSelector::getFlagIcon($name);
			}

			// Fetch the Substitution record by name
			$substitution = Substitution::findOne(['name' => $name]);
			if (!$substitution) {
				return $matches[0]; // No substitution found, return original placeholder
			}

			$substitutionTitle = Html::encode($substitution->title);

			// Check if it's a plain text substitution
			if (empty($substitution->url)) {
				return $substitutionTitle;
			}

			// Construct the link with provided details
			$linkOptions = [
				'title' => $substitutionTitle,
				'target' => $substitution->external ? '_blank' : '_self'
			];

			if (!empty($substitution->class)) {
				$linkOptions['class'] = $substitution->class;
			}

			// Determine link text based on icon and title
			$linkText = '';
			if (!empty($substitution->icon)) {
				$linkIcon = Html::tag('i', '', ['class' => $substitution->icon]);
				if (strpos($substitution->class, 'btn') === 0) {
					$linkText = $linkIcon;
				} else {
					$linkText = $linkIcon . '&nbsp;' . $substitutionTitle;
				}
			} else {
				$linkText = $substitutionTitle;
			}

			return Html::a($linkText, $substitution->url, $linkOptions);
		}, $text);
	}
}
