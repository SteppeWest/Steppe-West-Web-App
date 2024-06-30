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
 * @class \app\assets\base\SWAssetBundle
 *
 * Load this asset with...
 * app\assets\base\SWAssetBundle::register($this);
 *
 * use app\assets\base\SWAssetBundle;
 * SWAssetBundle::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\base\SWAssetBundle',
 */

namespace app\assets\base;

use yii\web\AssetBundle;

class SWAssetBundle extends AssetBundle
{

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap5\BootstrapAsset',
		'yii\bootstrap5\BootstrapIconAsset',
		'yii\bootstrap5\BootstrapPluginAsset',
		'yii\bootstrap5\JqueryAsset',
	];

/**
	// @var string
	public $baseUrl;

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
