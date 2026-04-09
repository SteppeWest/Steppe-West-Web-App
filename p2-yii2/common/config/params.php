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
	'swSubstitutions' => [
		'SubstackOrigin01' => [
			'title' => 'Substack',
			'url' => 'https://steppewest.substack.com/p/steppe-wests-invitation',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-substack',
			'external' => true,
			'social' => 0,
			'description' => 'Link back to the origin of the invite letter.',
		],
		'GubbiGubbi' => [
			'title' => 'Gubbi Gubbi',
			'url' => 'https://gubbigubbidyungungoo.com/',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => null,
			'external' => true,
			'social' => 0,
			'description' => 'Link to the Gubbi Gubbi website.',
		],
		'KabiKabi' => [
			'title' => 'Kabi Kabi',
			'url' => 'https://gubbigubbidyungungoo.com/explanation-of-the-gubbi-gubbi-language/',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => null,
			'external' => true,
			'social' => 0,
			'description' => 'Link to a page on the Gubbi Gubbi website explaining Kabi Kabi.',
		],
		'Substack' => [
			'title' => 'Substack',
			'url' => 'https://steppewest.substack.com',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-substack',
			'external' => true,
			'social' => 1,
			'description' => 'Button link to the Substack account.',
		],
		'Facebook' => [
			'title' => 'Facebook',
			'url' => 'https://facebook.com/SteppeWest',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-facebook',
			'external' => true,
			'social' => 2,
			'description' => 'Button link to the Facebook account.',
		],
		'Instagram' => [
			'title' => 'Instagram',
			'url' => 'https://instagram.com/steppe.west',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-instagram',
			'external' => true,
			'social' => 3,
			'description' => 'Button link to the Instagram account.',
		],
		'Xitter' => [
			'title' => 'X/Twitter',
			'url' => 'https://x.com/SteppeWest',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-twitter-x',
			'external' => true,
			'social' => 99,
			'description' => 'Button link to the X/Twitter account.',
		],
		'YouTube' => [
			'title' => 'YouTube',
			'url' => 'https://youtube.com/@SteppeWest',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-youtube',
			'external' => true,
			'social' => 4,
			'description' => 'Button link to the YouTube account.',
		],
		'TikTok' => [
			'title' => 'TikTok',
			'url' => 'https://tiktok.com/@steppewest',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-tiktok',
			'external' => true,
			'social' => 5,
			'description' => 'Button link to the TikTok account.',
		],
		'Threads' => [
			'title' => 'Threads',
			'url' => 'https://threads.net/@steppe.west',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-threads',
			'external' => true,
			'social' => 6,
			'description' => 'Button link to the Threads account.',
		],
		'Bluesky' => [
			'title' => 'Bluesky',
			'url' => 'https://bsky.app/profile/steppewest.bsky.social',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-bluesky',
			'external' => true,
			'social' => 7,
			'description' => 'Button link to the Bluesky account.',
		],
		'Substack-t' => [
			'title' => 'Substack',
			'url' => 'https://steppewest.substack.com',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-substack',
			'external' => true,
			'social' => 1,
			'description' => 'Text link to the Substack account.',
		],
		'Facebook-t' => [
			'title' => 'Facebook',
			'url' => 'https://facebook.com/SteppeWest',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-facebook',
			'external' => true,
			'social' => 2,
			'description' => 'Text link to the Facebook account.',
		],
		'Instagram-t' => [
			'title' => 'Instagram',
			'url' => 'https://instagram.com/steppe.west',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-instagram',
			'external' => true,
			'social' => 3,
			'description' => 'Text link to the Instagram account.',
		],
		'Xitter-t' => [
			'title' => 'X/Twitter',
			'url' => 'https://x.com/SteppeWest',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-twitter-x',
			'external' => true,
			'social' => 99,
			'description' => 'Text link to the X/Twitter account.',
		],
		'YouTube-t' => [
			'title' => 'YouTube',
			'url' => 'https://youtube.com/@SteppeWest',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-youtube',
			'external' => true,
			'social' => 4,
			'description' => 'Text link to the YouTube account.',
		],
		'TikTok-t' => [
			'title' => 'TikTok',
			'url' => 'https://tiktok.com/@steppewest',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-tiktok',
			'external' => true,
			'social' => 5,
			'description' => 'Text link to the TikTok account.',
		],
		'Threads-t' => [
			'title' => 'Threads',
			'url' => 'https://threads.net/@steppe.west',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-threads',
			'external' => true,
			'social' => 6,
			'description' => 'Text link to the Threads account.',
		],
		'Bluesky-t' => [
			'title' => 'Bluesky',
			'url' => 'https://bsky.app/profile/steppewest.bsky.social',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => 'bi bi-bluesky',
			'external' => true,
			'social' => 7,
			'description' => 'Text link to the Bluesky account.',
		],
		'Reddit' => [
			'title' => 'Reddit',
			'url' => 'https://www.reddit.com/r/SteppeWest/',
			'class' => 'btn btn-secondary btn-circle btn-circle-sm',
			'icon' => 'bi bi-reddit',
			'external' => true,
			'social' => 8,
			'description' => 'Button link to the Reddit subreddit.',
		],
		'RedditU' => [
			'title' => 'Reddit User',
			'url' => 'https://www.reddit.com/user/SteppeWest/',
			'class' => 'btn btn-secondary-emphasis btn-circle btn-circle-sm',
			'icon' => 'bi bi-reddit',
			'external' => true,
			'social' => 9,
			'description' => 'Button link to the Reddit user account.',
		],
		'Reddit-t' => [
			'title' => 'Reddit',
			'url' => 'https://www.reddit.com/r/SteppeWest/',
			'class' => 'link-info link-opacity-75-hover text-decoration-none',
			'icon' => null,
			'external' => true,
			'social' => 8,
			'description' => 'Text link to the Reddit subreddit.',
		],
		'RedditU-t' => [
			'title' => 'Reddit User',
			'url' => 'https://www.reddit.com/user/SteppeWest/',
			'class' => 'link-info-emphasis link-opacity-75-hover text-decoration-none',
			'icon' => null,
			'external' => true,
			'social' => 9,
			'description' => 'Text link to the Reddit user account.',
		],
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
