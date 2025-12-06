<?php
/**
 * app/common/config/main.php
 */

$bootstrapVersion = '5.3.4';
$bootstrapCssIntegrity = 'sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC';
$bootstrapJsIntegrity = 'sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu';
$jqueryVersion = '3.7.1';
$jqueryIntegrity = 'sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs';
$bootstrapIconsVersion = '1.11.3';
$bootstrapIconsIntegrity = 'sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD';

return [
	'charset' => 'utf-8',
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => [
		'log',
		\p2m\components\P2UrlManagerBootstrap::class,
	],
	'components' => [
		'assetManager' => [
			'basePath' => '@webroot/assets',
			'baseUrl' => '@web/assets',
			//'appendTimestamp' => true, // useful while developing custom assets
			'bundles' => [
				'yii\bootstrap5\BootstrapAsset' => [
					'sourcePath' => null,
					'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap@' . $bootstrapVersion . '/dist/',
					'css' => [
						'css/bootstrap.min.css',
					],
					'cssOptions' => [
						'integrity' => $bootstrapCssIntegrity,
						'crossorigin' => 'anonymous',
					],
				],
				'yii\bootstrap5\BootstrapPluginAsset' => [
					'sourcePath' => null,
					'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap@' . $bootstrapVersion . '/dist/',
					'js' => [
						'js/bootstrap.bundle.min.js',
					],
					'jsOptions' => [
						'integrity' => $bootstrapJsIntegrity,
						'crossorigin' => 'anonymous',
					],
				],
				'yii\web\JqueryAsset' => [
					'sourcePath' => null,
					'baseUrl' => '//code.jquery.com/',
					'js' => [
						'jquery-' . $jqueryVersion . '.min.js',
					],
					'jsOptions' => [
						'integrity' => $jqueryIntegrity,
						'crossorigin' => 'anonymous',
					],
				],
				'yii\bootstrap5\BootstrapIconAsset' => [
					'sourcePath' => null,
					'baseUrl' => '//cdn.jsdelivr.net/npm/bootstrap-icons@' . $bootstrapIconsVersion . '/font/',
					'css' => [
						'bootstrap-icons.css',
					],
					'cssOptions' => [
						'integrity' => $bootstrapIconsIntegrity,
						'crossorigin' => 'anonymous',
					],
				],
				//'yii\jui\JuiAsset' => [
				//	'sourcePath' => null, 'css' => [], 'js' => [],
				//],
			],
		],
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
		],
		'authManager' => [
			'class' => yii\rbac\DbManager::class,
			// optional:
			'defaultRoles' => ['guest', 'user'],
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
