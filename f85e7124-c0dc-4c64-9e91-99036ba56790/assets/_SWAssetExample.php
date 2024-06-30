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
 * @class \app\assets\SWAssetExample
 *
 * Load this asset with...
 * app\assets\SWAssetExample::register($this);
 *
 * use app\assets\SWAssetExample;
 * SWAssetExample::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\SWAssetExample',
 */

namespace app\assets;

use app\assets\base\SWAssetBundle;

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
