<?php
/**
 * P2BootstrapIconsAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\P2BootstrapIconsAsset
 *
 * Load this asset with...
 * common\assets\P2BootstrapIconsAsset::register($this);
 *
 * use common\assets\P2BootstrapIconsAsset;
 * P2BootstrapIconsAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\P2BootstrapIconsAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class P2BootstrapIconsAsset extends AssetBundle
{
	public $sourcePath = null;
	public $baseUrl = '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/';
	public $css = [
		'bootstrap-icons.css',
	];
	public $cssOptions = [
		'integrity' => 'sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD',
		'crossorigin' => 'anonymous',
	];
}
