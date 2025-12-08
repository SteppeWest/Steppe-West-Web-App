<?php
/**
 * SBAdminAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \backend\assets\SBAdminAsset
 *
 * Load this asset with...
 * backend\assets\SBAdminAsset::register($this);
 *
 * use backend\assets\SBAdminAsset;
 * SBAdminAsset::register($this);
 *
 * or specify as a dependency with...
 *     'backend\assets\SBAdminAsset',
 */

namespace backend\assets;

class SBAdminAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@static/sb-admin';

	public $css = [
		'css/sb-admin.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $js = [
		'js/sb-admin.min.js',
	];

	public $jsOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
		'common\assets\SwMetaAsset',
		'p2m\assets\P2BootstrapAsset',
		'p2m\assets\P2BootstrapIconsAsset',
	];
}
