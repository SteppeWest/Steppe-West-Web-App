<?php
/**
 * app/common/config/main.php
 */

return [
	'charset' => 'utf-8',
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => [
		'log',
		//\p2m\components\P2UrlManagerBootstrap::class,
	],
	'components' => [
		'assetManager' => [
			'basePath' => '@webroot/assets',
			'baseUrl' => '@web/assets',
			//'appendTimestamp' => true, // useful while developing custom assets
			'bundles' => [
				'yii\bootstrap5\BootstrapAsset' => [
					'class' => 'p2m\assets\base\P2BootstrapCdnAsset',
				],
				'yii\bootstrap5\BootstrapPluginAsset' => [
					'class' => 'p2m\assets\base\P2BootstrapPluginCdnAsset',
				],
				'yii\bootstrap5\BootstrapIconAsset' => [
					'class' => 'p2m\assets\base\P2BootstrapIconsCdnAsset',
				],
				'yii\web\JqueryAsset' => [
					'class' => 'p2m\assets\base\P2JqueryCdnAsset',
				],
			],
		],
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
		],
		'authManager' => [
			'class' => Da\User\Component\AuthDbManagerComponent::class,
			// optional:
			'defaultRoles' => ['konok', 'musafir'],
		],
		'formatter' => [
			'class' => yii\i18n\Formatter::class,
			// ISO 8601 date
			'dateFormat' => 'php:Y-m-d',
			// If you later render datetimes, this is the ISO-ish default:
			'datetimeFormat' => 'php:Y-m-d H:i:s',
			// Optional: if you ever use asTime()
			'timeFormat' => 'php:H:i:s',
		],
		'mailer' => [
			'class' => \yii\symfonymailer\Mailer::class,
			'viewPath' => '@common/mail',
			'useFileTransport' => true,
			'fileTransportPath' => '@runtime/mail', // default, but explicit is nice
		],
		'i18n' => [
			'translations' => [
				'sw*' => [
					'class' => \yii\i18n\PhpMessageSource::class,
					'basePath' => '@common/i18n/messages',
					'sourceLanguage' => 'en',
					'fileMap' => [
						'sw' => 'sw.php',
						'sw.a11y' => 'sw.a11y.php',
						'sw.auth' => 'sw.auth.php',
						'sw.settings' => 'sw.settings.php',
						'sw.profile' => 'sw.profile.php',
						'sw.user' => 'sw.user.php',

						'sw.backend' => 'sw.backend.php',
						'sw.backend.nav' => 'sw.backend.nav.php',
						'sw.backend.admin' => 'sw.backend.admin.php',
						'sw.backend.rbac' => 'sw.backend.rbac.php',
						'sw.backend.audit' => 'sw.backend.audit.php',
						'sw.backend.demo' => 'sw.backend.demo.php',

						'sw.frontend' => 'sw.frontend.php',
						'sw.tests' => 'sw.tests.php',

						'p2m.rbac' => 'p2m.rbac.php',
						'p2m.rbac.a11y' => 'p2m.rbac.a11y.php',
					],
				],
				'p2m.rbac*' => [
					'class' => \yii\i18n\PhpMessageSource::class,
					'basePath' => '@common/i18n/messages',
					'sourceLanguage' => 'en',
					'fileMap' => [
						'p2m.rbac' => 'p2m.rbac.php',
						'p2m.rbac.a11y' => 'p2m.rbac.a11y.php',
					],
				],
			],
		],
		/**
		'request' => [
			'enableCsrfCookie' => false,
		],
		 */
		'cache' => [
			'class' => \yii\caching\FileCache::class,
		],
	],
	'modules' => [
		'user' => [
			'class' => Da\User\Module::class,
			// ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
			// 'administrators' => ['admin'], // this is required for accessing administrative actions
			// 'generatePasswords' => true,
			// 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
		],
	],
];
