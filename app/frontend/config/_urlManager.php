<?php
return [
	'baseUrl' => 'http://steppewest.p2m',
	//'baseUrl' => 'http://steppewest.com',
	'rules' => [
		// Root URL, defaults to 'introduction' in LanguagePageController
		//'' => 'site/index',
		'' => 'language-page/view',
		'<lc:[a-z]{2,3}>/' => 'language-page/view',

		// Additional rules for valid pages by slug and language code
		'<slug:introduction|invite|faq>' => 'language-page/view',
		'<slug:introduction|invite|faq>/<lc:[a-z]{2,3}>' => 'language-page/view',

		/*
		// Redirect uppercase country codes to lowercase language codes
		'EN' => 'site/language-redirect?lang=en',
		'RU' => 'site/language-redirect?lang=ru',
		'KZ' => 'site/language-redirect?lang=kk',
		'KG' => 'site/language-redirect?lang=ky',
		'TJ' => 'site/language-redirect?lang=tg',
		'TM' => 'site/language-redirect?lang=tk',
		'UZ' => 'site/language-redirect?lang=uz',
		'AZ' => 'site/language-redirect?lang=az',
		'MN' => 'site/language-redirect?lang=mn',

		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<view:[a-zA-Z0-9-]+>/'=>'site/page',
		 */
	],
];
/*
 *
 *
 */
