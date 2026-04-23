<?php
/**
 * app/frontend/config/main.php
 */
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-frontend',
	'name' => 'Steppe West', // Set the application name here
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'frontend\controllers',
	'bootstrap' => ['log'],
	'modules' => [
		'user' => [
			'class' => Da\User\Module::class,
			'administrators' => ['admin'], // or whatever username you’ll create in the migration
		],
	],
	'components' => [
		'urlManager' => [
			'rules' => [
				'' => 'site/index',
				'<slug:[A-Za-z0-9\-]+>/<lc:[A-Za-z]{2}>' => 'site/index',
				'<slug:[A-Za-z0-9\-]+>' => 'site/index',
				'<lc:[A-Za-z]{2}>' => 'site/index',
			],
		],
		/**
		'view' => [
			'theme' => [
				'pathMap' => [
					'@app/views' => '@app/views/letter'
				],
			],
		],
		 */
		'request' => [
			'csrfParam' => '_csrf-frontend',
		],
		'authManager' => [
			'class' => Da\User\Component\AuthDbManagerComponent::class,
		],
		'session' => [
			// this is the name of the session cookie used for login on the frontend
			'name' => 'steppe-west-frontend',
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
	'modules' => [
		'letter' => [
			'class' => 'frontend\modules\LetterModule',
		],
		'links' => [
			'class' => 'frontend\modules\LinksModule',
		],
	],
	'params' => $params,
];
