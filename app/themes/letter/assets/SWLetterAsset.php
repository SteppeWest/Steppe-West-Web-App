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
 * @class \common\assets\SwLetterAsset
 *
 * Load this asset with...
 * common\assets\SwLetterAsset::register($this);
 *
 * use common\assets\SwLetterAsset;
 * SwLetterAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SwLetterAsset',
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
