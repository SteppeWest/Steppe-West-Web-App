<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../console.php';

$config = [
	// subdomain-specific test configurations
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
	// configuration adjustments for 'dev' environment
	// requires version `2.1.21` of yii2-debug module
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return ArrayHelper::merge($baseConfig, $config);
