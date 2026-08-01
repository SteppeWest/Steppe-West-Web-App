<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap5\BootstrapAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
	public $sourcePath = '@static/frontend';
	//public $basePath = '@webroot';
	//public $baseUrl = '@web';

	public $css = [
		'css/site.min.css',
	];
	public $js = [
	];

	public $depends = [
		YiiAsset::class,
		BootstrapAsset::class,
	];
}
