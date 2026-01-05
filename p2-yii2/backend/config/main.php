<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'name' => 'Steppe West HQ',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'backend\controllers',
	'on beforeRequest' => function () {
		$session = Yii::$app->session;

		// Prefer cookie, fall back to session, else default
		$lang = Yii::$app->request->cookies->getValue('userLanguage')
			?? ($session->has('userLanguage') ? $session->get('userLanguage') : null)
			?? Yii::$app->sourceLanguage;

		if ($lang) {
			Yii::$app->language = $lang;
		}
	},
	'bootstrap' => ['log'],
	'modules' => [
		'user' => [
			'class' => Da\User\Module::class,
			'viewPath' => '@backend/views',
			'administrators' => ['chinggis'],       // your super username
			'enableRegistration' => false,       // backend: no public register
			'classMap' => [
				'User' => common\models\User::class,
			],
			'controllerMap' => [
				'role' => backend\controllers\SwRoleController::class,
				// later:
				// 'permission' => backend\controllers\SwPermissionController::class,
				// 'rule' => backend\controllers\SwRuleController::class,
			],
		],
	],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
		],
		'urlManager' => [
			'rules' => [
				'' => 'site/index',   // root of backend = SiteController::actionIndex()

				// your other rules here, e.g.:
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			],
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
		'i18n' => [
			'translations' => [
				'admin*' => [
					'class' => yii\i18n\PhpMessageSource::class,
					'basePath' => '@backend/messages',
					'sourceLanguage' => 'en',
					'fileMap' => [
						'admin' => 'admin.php',
						'admin.nav' => 'admin.nav.php',
						'admin.dashboard' => 'admin.dashboard.php',
						'admin.user' => `admin.user.php`,
						'admin.users' => 'admin.users.php',
						'admin.roles' => 'admin.roles.php',
						'admin.permissions' => 'admin.permissions.php',
						'admin.rules' => 'admin.rules.php',
						'admin.settings' => 'admin.settings.php',
						'admin.errors' => 'admin.errors.php',
					],
				],
				'usuario*' => [
					'class' => yii\i18n\PhpMessageSource::class,
					'basePath' => '@backend/messages',
					'sourceLanguage' => 'en',
					'fileMap' => [
						'usuario' => 'usuario.php',
					],
				],
			],
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'steppe-west-hq',
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
		 */
	],
	'params' => $params,

	'defaultRoute' => 'site/index',
];

	/**
	'components' => [
		'user' => [
			'class' => yii\web\User::class,
			'identityClass' => Da\User\Model\User::class,
			'enableAutoLogin' => true,
			'loginUrl' => ['/user/security/login'],
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
		],
		// ...
	],
	 */

	/**
	'components' => [
		'user' => [
			'identityClass' => 'common\models\User', // whatever you currently use
			'enableAutoLogin' => true,
			'loginUrl' => ['site/login'],          // 👈 important
			// other user settings...
		],
		// ...
	],
	 */

