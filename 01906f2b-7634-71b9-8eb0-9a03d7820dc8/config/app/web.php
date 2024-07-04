<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../web.php';

$config = [
	'components' => [
		// subdomain-specific components configuration
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'GVPlFcjr9fIDd4JZIORRHI53YkaixVGT',
		],
		'view' => [
			'theme' => [
				'pathMap' => [
					'@app/views' => [
						'@app/themes/admin',
						//'@app/themes/letter',
						//'@app/themes/links',
					]
					//'@app/modules' => '@app/themes/basic/modules',
					//@app/widgets' => '@app/themes/basic/widgets',
				],
			],
		],
	],
	// other subdomain-specific configurations
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

return ArrayHelper::merge($baseConfig, $config);
