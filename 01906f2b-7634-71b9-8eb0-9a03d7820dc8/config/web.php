<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'components' => [
		'assetManager' => [
			'bundles' => [
				'yii\bootstrap5\BootstrapAsset' => [
					'sourcePath' => null,
					'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/',
					'css' => [
						'css/bootstrap.min.css',
					],
					'cssOptions' => [
						'integrity' => 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN',
						'crossorigin' => 'anonymous',
					],
				],
				'yii\bootstrap5\BootstrapPluginAsset' => [
					'sourcePath' => null,
					'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/',
					'js' => [
						'js/bootstrap.bundle.min.js',
					],
					'jsOptions' => [
						'integrity' => 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL',
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
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => \yii\symfonymailer\Mailer::class,
			'viewPath' => '@app/mail',
			// send all mails to a file by default.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => $db,
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
				'<language:[A-Za-z]{2,3}>' => 'site/index',
			],
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;
