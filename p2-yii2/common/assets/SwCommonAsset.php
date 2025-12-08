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
	public $sourcePath = '@static/common';

	public $depends = [
		'p2m\assets\P2BootstrapAsset',
		'p2m\assets\P2BootstrapIconsAsset',
	];

/**
	// @var string
	public $basePath // = '@webroot';

	// @var string
	public $sourcePath // = '@app/assets/lib';

	// @var string
	public $baseUrl // = '@web';

	// @var array
	public $css = [
	];

	// @var array
	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	// @var array
	public $js = [
	];

	// @var array
	public $jsOptions = [
		'crossorigin' => 'anonymous',
	];

	// @var array
	public $depends = [
	];

	// @var array
	public $publishOptions = [
	];

	P2AppAsset
	P2AssetBundle

 */
}
