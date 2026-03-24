<?php
/**
 * app/common/config/params.php
 */
return [
	'adminEmail' => 'pedro@steppewest.com',
	'supportEmail' => 'pedro@steppewest.com',
	'senderEmail' => 'noreply@steppewest.com',
	'senderName' => 'Steppe West Mailer',
	'user.passwordResetTokenExpire' => 3600, // remove
	'user.passwordMinLength' => 8, // remove
	'swAssetMap' => [
		'backend' => [
			'main'  => p2m\admin\assets\P2sbAdminAsset::class,
			'auth'  => backend\assets\SwAuthAsset::class,
			'error' => backend\assets\SwErrorAsset::class,
		],
		'frontend' => [
			//'main'  => frontend\assets\SwAppAsset::class,
			//'auth'  => frontend\assets\SwAuthAsset::class,
			//'error' => frontend\assets\SwErrorAsset::class,
		],
	],
	'swSocialAccounts' => '{Substack} {Facebook} {Instagram} {YouTube} {TikTok} {Threads} {Bluesky} {Reddit}',
	'swSocials' => [
		'Substack',
		'Facebook',
		'Instagram',
		'YouTube',
		'TikTok',
		'Threads',
		'Bluesky',
		'Reddit',
	],
	'swDefaultLanguage' => 'en',
	'swUiLanguages' => [
		'ru', 'kk', 'ky', 'tg', 'uz'
	],
	/**
	 * Copyright params
	 */
	'p2params' => [
		'ip' => [
			// Mandatory
			'author' => 'Pedro Plowman',
			'year'   => '2024',

			// Identity
			'title'  => 'Steppe West',
			'org'    => 'Steppe West',
			'owner'  => 'Steppe West',

			// Attribution
			'url'    => 'https://steppewest.com',
			/**
			'page'   => 'https://github.com/p2made/p2y2-sb-themes',
			'email'  => 'pedrofp@me.com',

			// Classification
			'item'   => 'p2made/p2y2-sb-themes',
			'type'   => 'yii2-extension',

			// Legal
			'license'    => 'MIT',
			'licenseUrl' => 'https://github.com/p2made/p2y2-sb-themes/blob/master/README.md',
			//'licenseUrl' => 'https://opensource.org/licenses/MIT',
			'copyright'  => null, // optional override
			'notice'     => null,

			// Optional future
			'contributors' => [],
			'jurisdiction' => null,
			 */
		],
	],
];
