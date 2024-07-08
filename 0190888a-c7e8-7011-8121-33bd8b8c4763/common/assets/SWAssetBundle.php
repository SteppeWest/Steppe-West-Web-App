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
 * @class \common\assets\SWAssetBundle
 *
 * Load this asset with...
 * common\assets\SWAssetBundle::register($this);
 *
 * use common\assets\SWAssetBundle;
 * SWAssetBundle::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SWAssetBundle',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SWAssetBundle extends AssetBundle
{
	public $sourcePath = '@common/assets/lib';

	public $depends = [
		'yii\bootstrap5\BootstrapAsset',
		'common\assets\SWBootstrapIconsAsset',
		//'yii\bootstrap5\BootstrapIconAsset',
		'yii\bootstrap5\BootstrapPluginAsset',
		'yii\web\JqueryAsset',
		//'yii\web\YiiAsset',
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

 */

}
