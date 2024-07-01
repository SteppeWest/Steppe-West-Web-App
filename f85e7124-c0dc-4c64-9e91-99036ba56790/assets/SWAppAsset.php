<?php
/**
 * SWAppAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license Proprietary/MIT
 */

/**
 * @class \app\assets\SWAppAsset
 *
 * Load this asset with...
 * app\assets\SWAppAsset::register($this);
 *
 * use app\assets\SWAppAsset;
 * SWAppAsset::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\SWAppAsset',
 */

namespace app\assets;

use yii\web\AssetBundle;

class SWAppAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/lib';

	public $css = [
		'css/steppe-west.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $js = [
		'js/steppe-west.min.js',
	];

	public $jsOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
		'yii\bootstrap5\BootstrapAsset',
		'yii\bootstrap5\BootstrapIconAsset',
		'yii\bootstrap5\BootstrapPluginAsset',
	];
}
