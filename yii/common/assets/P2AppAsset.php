<?php
/**
 * P2AppAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\P2AppAsset
 *
 * Load this asset with...
 * common\assets\P2AppAsset::register($this);
 *
 * use common\assets\P2AppAsset;
 * P2AppAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\P2AppAsset',
 */

namespace common\assets;

use common\assets\P2AssetBundle;

class P2AppAsset extends P2AssetBundle
{
	public $basePath;
	//public $basePath = '@webroot';
	public $baseUrl;
	//public $baseUrl = '@web';

	public $css = [
		'css/steppe-west.min.css',
		//'//cdn.steppewest.com/css/steppe-west.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];
}
