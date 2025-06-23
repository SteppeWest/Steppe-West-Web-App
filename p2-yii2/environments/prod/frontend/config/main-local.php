<?php
/**
 * app/frontend/config/main-local.php
 */

$rootUrl = 'https://steppewest.com'; // production

$config = [
	'homeUrl' => $rootUrl,
	'components' => [
		'urlManager' => [
			'baseUrl' => $rootUrl,
		],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'n9R4mk3Czhb2w7fBUWi0_zVyByEgWj8_',
		],
	],
];

if (!YII_ENV_TEST) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => \yii\debug\Module::class,
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => \yii\gii\Module::class,
	];
}

return $config;
