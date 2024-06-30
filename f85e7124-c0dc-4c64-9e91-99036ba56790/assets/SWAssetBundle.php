<?php
/**
 * SWAssetBundle.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
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
 * @class \app\assets\SWAssetBundle
 *
 * Load this asset with...
 * app\assets\SWAssetBundle::register($this);
 *
 * use app\assets\SWAssetBundle;
 * SWAssetBundle::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\SWAssetBundle',
 */

namespace app\assets;

use yii\web\AssetBundle;

class SWAssetBundle extends AssetBundle
{
	public $sourcePath = '@app/assets/lib';

	public $depends = [
		'yii\bootstrap5\BootstrapAsset',
		'yii\bootstrap5\BootstrapIconAsset',
		'yii\bootstrap5\BootstrapPluginAsset',
		'yii\bootstrap5\JqueryAsset',
		'yii\web\YiiAsset',
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

	SWAppAsset
	SWAssetBundle
	SWBootstrapAsset
	SWBootstrapIconsAsset
	SWBootstrapPluginAsset
	SWJqueryAsset
	SWYiiAsset

 */

}
