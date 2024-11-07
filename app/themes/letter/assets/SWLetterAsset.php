<?php
/**
 * SwLetterAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \themes\letter\assetsSwLetterAsset
 *
 * Load this asset with...
 * themes\letter\assetsSwLetterAsset::register($this);
 *
 * use themes\letter\assetsSwLetterAsset;
 * SwLetterAsset::register($this);
 *
 * or specify as a dependency with...
 *     'themes\letter\assetsSwLetterAsset',
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class SwLetterAsset extends AssetBundle
{
	public $sourcePath = '@static/sw-letter';

	public $css = [
		'css/sw-letter.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];
}
