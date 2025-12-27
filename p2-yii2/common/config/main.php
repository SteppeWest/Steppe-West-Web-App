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
