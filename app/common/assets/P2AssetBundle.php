<?php
/**
 * P2AssetBundle.php
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
 * @class \common\assets\P2AssetBundle
 *
 * Load this asset with...
 * common\assets\P2AssetBundle::register($this);
 *
 * use common\assets\P2AssetBundle;
 * P2AssetBundle::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\P2AssetBundle',
 */

namespace common\assets;

use yii\web\AssetBundle;

class P2AssetBundle extends AssetBundle
{
	public $sourcePath = '@common/assets/lib';

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap5\BootstrapAsset',
		'yii\bootstrap5\BootstrapPluginAsset',
		'common\assets\P2BootstrapIconsAsset',
		'yii\web\JqueryAsset',
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
