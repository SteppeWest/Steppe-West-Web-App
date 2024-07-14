<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/_params.php',
	require __DIR__ . '/../../common/config/_params-local.php',
	require __DIR__ . '/_params.php',
	require __DIR__ . '/_params-local.php'
);
$db = array_merge(
	require __DIR__ . '/../../common/config/_db.php',
	require __DIR__ . '/_db.php',
);
$assetManager = array_merge(
	require __DIR__ . '/../../common/config/_assetManager.php',
	require __DIR__ . '/_assetManager.php',
);
$urlManager = array_merge(
	require __DIR__ . '/../../common/config/_urlManager.php',
	require __DIR__ . '/_urlManager.php',
);

return [
	'id' => 'app-links',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'links\controllers',
	'components' => [
		'assetManager' => $assetManager,
		'urlManager' => $urlManager,
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
	],
	'params' => $params,
];
