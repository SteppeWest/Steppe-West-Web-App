<?php
/**
 * @common/assets/SwAlternateAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SwAlternateAsset
 *
 * Load this asset with...
 *
 * common\assets\SwAlternateAsset::register($this);
 *
 * use common\assets\SwAlternateAsset;
 * SwAlternateAsset::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwAlternateAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SwAlternateAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/common/alternate';

	// @var array
	public $css = [
		'css/sw-alternate.min.css',
	];
}
