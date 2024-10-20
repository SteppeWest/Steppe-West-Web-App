<?php
return [
	'basePath' => '@webroot/assets',
	'baseUrl' => '@web/assets',
	'bundles' => [
		'yii\bootstrap5\BootstrapAsset' => [
			'sourcePath' => null,
			'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/',
			'css' => [
				'css/bootstrap.min.css',
			],
			'cssOptions' => [
				'integrity' => 'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH',
				'crossorigin' => 'anonymous',
			],
		],
		'yii\bootstrap5\BootstrapPluginAsset' => [
			'sourcePath' => null,
			'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/',
			'js' => [
				'js/bootstrap.bundle.min.js',
			],
			'jsOptions' => [
				'integrity' => 'sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz',
				'crossorigin' => 'anonymous',
			],
		],
		'yii\web\JqueryAsset' => [
			'sourcePath' => null,
			'baseUrl' => '//code.jquery.com/',
			'js' => [
				'jquery-3.7.1.min.js',
			],
			'jsOptions' => [
				'integrity' => 'sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs',
				'crossorigin' => 'anonymous',
			],
		],
	],
];
