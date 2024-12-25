<?php
/**
 * SwAppAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SwAppAsset
 *
 * Load this asset with...
 * common\assets\SwAppAsset::register($this);
 *
 * use common\assets\SwAppAsset;
 * SwAppAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SwAppAsset',
 */

namespace common\assets;

use common\assets\SWAssetBundle;

class SwAppAsset extends SWAssetBundle
{
	public $sourcePath = '@static/sw-app';
	//public $basePath;
	//public $basePath = '@webroot';
	//public $baseUrl;
	//public $baseUrl = '@web';

	public $css = [
		'css/steppe-west.min.css',
		//'//cdn.steppewest.com/css/steppe-west.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap5\BootstrapAsset',
		'common\assets\P2BootstrapIconsAsset',
	];
}
