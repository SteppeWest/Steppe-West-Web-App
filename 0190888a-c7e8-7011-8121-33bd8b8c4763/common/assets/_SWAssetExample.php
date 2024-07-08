<?php
/**
 * SWAssetExample.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * To use this class, copy it & rename the copy,
 * then replace all instances of 'SWAssetExample'
 * with your new asset name. Finally remove this
 * comment block.
 */

/**
 * @class \common\assets\SWAssetExample
 *
 * Load this asset with...
 * common\assets\SWAssetExample::register($this);
 *
 * use common\assets\SWAssetExample;
 * SWAssetExample::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SWAssetExample',
 */

namespace common\assets;

use common\assets\SWAssetBundle;

class SWAssetExample extends SWAssetBundle
{
	public $basePath;
	//public $basePath = '@webroot';
	public $baseUrl;
	//public $baseUrl = '@web';

	public $css = [
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $js = [
	];

	public $jsOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
	];

	public $publishOptions = [
	];
}
