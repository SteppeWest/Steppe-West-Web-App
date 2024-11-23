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
	'swSocialAccounts' => '{Substack} {Facebook} {Instagram} {YouTube} {TikTok} {Threads} {Bluesky}',
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
