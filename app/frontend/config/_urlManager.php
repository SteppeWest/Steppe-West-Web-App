<?php
return [
	'rules' => [
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

		/*
		// Root URL and default page handling
		'' => 'sw-language-page/view',
		'<lc:\w+>/' => 'sw-language-page/view',
		// Page rules with and without `lc`
		'<slug:introduction|invite|links>/<lc:\w+>' => 'sw-language-page/view',
		'<slug:introduction|invite|links>' => 'sw-language-page/view',
		 */
	],
];
/*
 *
 *
 */
