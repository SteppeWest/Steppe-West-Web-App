<?php
/**
 * SwAuthAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \backend\assets\SwAuthAsset
 *
 * Load this asset with...
 * backend\assets\SwAuthAsset::register($this);
 *
 * use backend\assets\SwAuthAsset;
 * SwAuthAsset::register($this);
 *
 * or specify as a dependency with...
 *     'backend\assets\SwAuthAsset',
 */

namespace backend\assets;

use yii\web\AssetBundle;

class SwAuthAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/backend';

	// @var array
	public $css = [
		'css/login.min.css',
	];

	// @var array
	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	// @var array
	public $depends = [
		'p2m\assets\P2BootstrapAsset',
		'p2m\assets\P2BootstrapIconsAsset',
	];
}
