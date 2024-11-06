<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main common application asset bundle.
 */
class AppAsset extends AssetBundle
{
	public $sourcePath = '@static/app';
	//public $basePath = '@webroot';
	//public $baseUrl = '@web';
	public $css = [
		'css/site.min.css',
		//'css/site.css',
	];
	public $js = [
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap5\BootstrapAsset',
	];
}
