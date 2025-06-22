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

use yii\base\Widget;
use p2m\assets\P2FlagIconsAsset;
use p2m\helpers\FI;

class SwFlagSelector extends Widget
{
	/** @var string Two-letter country code */
	public $iconCode;

	/** @var int|null optional font-size utility */
	public $size;

	public function init()
	{
		parent::init();
		// register the BI asset bundle
		P2FlagIconsAsset::register($this);
	}

	public function run()
	{
		// now you can generate your <i>…</i> safely
		if (preg_match('/^[A-Z]{2}$/', $this->iconCode)) {
			$points = [
				127397 + ord($this->iconCode[0]),
				127397 + ord($this->iconCode[1]),
			];
			$html = mb_convert_encoding('&#' . implode(';&#', $points) . ';', 'UTF-8', 'HTML-ENTITIES');
		} else {
			$html = 'NF';
		}

		if ($this->size) {
			// wrap or style as you need, e.g.
			return "<span class=\"fs-{$this->size}\">{$html}</span>";
		}

		return $html;
	}
	/**
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
	 */
}
