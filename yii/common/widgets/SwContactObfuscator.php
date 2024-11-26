<?php
/**
 * SwContactObfuscator.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Provides substitution functionality for use across the application.
 *
 * @class \common\widgets\SwContactObfuscator
 * @package common\widgets
 *
 * use common\widgets\SwContactObfuscator;
 */

namespace common\widgets;

use yii\helpers\Html;

class SwContactObfuscator
{
	/**
	 * Obfuscate email address by splitting it into parts and using a span.
	 *
	 * @param string $email The email address to obfuscate
	 * @return string The obfuscated email address HTML
	 */
	public static function obfuscateEmail(string $email): string
	{
		$emailParts = explode('@', $email);
		$localPart = $emailParts[0];
		$domainParts = explode('.', $emailParts[1]);

		// Render with spans to obfuscate
		return Html::tag('span', Html::encode($localPart)) . ' [at] ' .
			   Html::tag('span', Html::encode($domainParts[0])) . ' [dot] ' .
			   Html::tag('span', Html::encode($domainParts[1]));
	}

	/**
	 * Obfuscate phone number by breaking it into segments.
	 *
	 * @param string $phone The phone number to obfuscate
	 * @return string The obfuscated phone number HTML
	 */
	public static function obfuscatePhone(string $phone): string
	{
		// Split phone into smaller parts
		$phoneParts = str_split($phone, 3);

		return implode(' ', array_map(fn($part) => Html::tag('span', Html::encode($part)), $phoneParts));
	}
}
