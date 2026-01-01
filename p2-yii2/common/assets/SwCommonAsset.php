<?php
/**
 * SwCommonAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SwCommonAsset
 *
 * Load this asset with...
 * common\assets\SwCommonAsset::register($this);
 *
 * use common\assets\SwCommonAsset;
 * SwCommonAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SwCommonAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SwCommonAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/common';

	// @var array
	/**
	public $css = [
		'css/sw-common.min.css',
	];
	 */

	/**
	// @var array
	public $js = [
		'js/sw-common.min.js',
	];
	 */
}
