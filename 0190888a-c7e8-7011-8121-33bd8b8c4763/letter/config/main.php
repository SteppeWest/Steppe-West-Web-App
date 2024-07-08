<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);
$assetManager = array_merge(
	require __DIR__ . '/../../common/config/assets.php',
	require __DIR__ . '/assets.php',
);
$urlManager = array_merge(
	require __DIR__ . '/../../common/config/url.php',
	require __DIR__ . '/url.php',
);
$db = array_merge(
	require __DIR__ . '/../../common/config/db.php',
	require __DIR__ . '/db.php',
);

return [
	'id' => 'app-letter',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'letter\controllers',
	'components' => [
		'assetManager' => $assetManager,
		'urlManager' => $urlManager,
		'db' => $db,
		'request' => [
			'csrfParam' => '_csrf-letter',
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-letter', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the letter
			'name' => 'advanced-letter',
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
