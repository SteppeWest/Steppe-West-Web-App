<?php
/**
 * @common/assets/SwAssetBundle.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ #####
 * ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ #####
 * ##### ^ #####                                           ##### ^ #####
 * ##### ^ #####      DO NOT USE THIS CLASS DIRECTLY!      ##### ^ #####
 * ##### ^ #####                                           ##### ^ #####
 * ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ #####
 * ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ #####
 */

/**
 * @class \frontend\assets\SwAssetBundle
 *
 * Load this asset with...
 *
 * common\assets\SwAssetBundle::register($this);
 *
 * use common\assets\SwAssetBundle;
 * SwAssetBundle::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwAssetBundle',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SwAssetBundle extends AssetBundle
{
	// @var string
	public $basePath // = '@webroot';

	// @var string
	public $sourcePath = '@static/common';

	// @var string
	public $baseUrl // = '@web';

	// @var array
	public $css = [
		//'css/filename.min.css',
	];

	// @var array
	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	// @var array
	public $js = [
		//'js/filename.min.js',
	];

	// @var array
	public $jsOptions = [
		'crossorigin' => 'anonymous',
	];

	// @var array
	public $depends = [
		'p2m\assets\P2CoreAsset',
	];

	// @var array
	public $publishOptions = [
	];
}
