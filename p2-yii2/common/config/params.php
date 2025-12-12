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
			'main'  => p2m\admin\sbadmin\assets\P2SBAdminAsset::class,
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
	'swDefaultLanguage' => 'en',
	'swActiveLanguages' => [
		'az',
		'en',
		'kk',
		'ky',
		'mn',
		'ru',
		'tg',
		'tk',
		'uz',
		'tr',
	],
	'swLanguageMap' => [
		'EN' => 'en',
		'RU' => 'ru',
		'KZ' => 'kk',
		'KG' => 'ky',
		'TJ' => 'tg',
		'TM' => 'tk',
		'UZ' => 'uz',
		'AZ' => 'az',
		'MN' => 'mn',
	],
];
