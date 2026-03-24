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
				// Home == intro (English)
				'' => 'letter/view',

				// /lc  -> intro in that language
				'<lc:[a-z]{2,3}>' => 'letter/view',

				// /slug -> English for that slug
				'<slug:(?:intro|invite)>' => 'letter/view',

				// /slug/lc -> language-specific
				'<slug:(?:intro|invite)>/<lc:[a-z]{2,3}>' => 'letter/view',
			],
			'rules' => [
				//'' => 'site/index',   // root now uses default frontend views

				// Root URL, defaults to 'intro' in LetterController
				'' => '/letter/letter/view',

				// Specific slugs (e.g., intro, invite, faq) without or with language code
				'<slug:(?:intro|invite|faq)>' => 'letter/letter/view',
				'<slug:(?:intro|invite|faq)>/<lc:[a-z]{2,3}>' => 'letter/letter/view',


				// Language code only (e.g., domain.tld/en) routes to the view action
				'<lc:[a-z]{2,3}>' => 'letter/letter/view',

				// Specific slug 'links' without or with language code
				'<slug:links>' => 'links/links/view',
				'<slug:links>/<lc:[a-z]{2,3}>' => 'links/links/view',

				// Fallback rules to handle other modules or controllers
				'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
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
