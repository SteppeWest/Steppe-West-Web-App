<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'name' => 'Steppe West', // Set the application name here
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'backend\controllers',
	'bootstrap' => ['log'],
	'modules' => [
		'user' => [
			'class' => Da\User\Module::class,
			'administrators' => ['pedro'],       // your super username
			'enableRegistration' => false,       // backend: no public register
			'classMap' => [
				'User' => common\models\User::class,
			],
		],
	],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
		],
		'authManager' => [
			'class' => Da\User\Component\AuthDbManagerComponent::class,
		],
		'user' => [
			'class' => yii\web\User::class,
			'identityClass' => Da\User\Model\User::class,
			'enableAutoLogin' => true,
			'loginUrl' => ['/user/security/login'],
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'advanced-backend',
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
		/**
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
			],
		],
		 */
	],
	'params' => $params,

	// optional but handy:
	'defaultRoute' => 'user/admin',
];
