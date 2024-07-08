<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);
$assets = array_merge(
	require __DIR__ . '/../../common/config/assets.php',
	require __DIR__ . '/assets.php',
);
$url = array_merge(
	require __DIR__ . '/../../common/config/url.php',
	require __DIR__ . '/url.php',
);
$db = array_merge(
	require __DIR__ . '/../../common/config/db.php',
	require __DIR__ . '/db.php',
);

return [
	'id' => 'app-links',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'links\controllers',
	'components' => [
		'assetManager' => $assets,
		'urlManager' => $url,
		'db' => $db,
		'request' => [
			'csrfParam' => '_csrf-links',
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-links', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the links
			'name' => 'advanced-links',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => \yii\log\FileTarget::class,
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		/*
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
			],
		],
		*/
	],
	'params' => $params,
];
