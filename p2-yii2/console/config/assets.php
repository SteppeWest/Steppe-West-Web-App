<?php

return [
	'bundles' => [
		'common\assets\SteppeWestAsset',
	],

	'targets' => [
		'all' => [
			'class' => 'yii\web\AssetBundle',
			'basePath' => '@webroot/assets-prod',
			'baseUrl' => '@web/assets-prod',
			'css' => 'css/all-{hash}.css',
			'js' => 'js/all-{hash}.js',
		],
	],

	'assetManager' => [
		'converter' => [
			'class' => 'yii\web\AssetConverter',
			'commands' => [
				'scss' => [
					'css',
					'sass --quiet-deps --load-path=vendor/twbs/bootstrap/scss {from} {to}',
				],
			],
		],
	],
];
