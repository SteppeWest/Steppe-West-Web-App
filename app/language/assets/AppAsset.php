<?php

namespace language\assets;

use yii\web\AssetBundle;

/**
 * Main language application asset bundle.
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
	];
	public $js = [
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap5\BootstrapAsset',
	];
}
