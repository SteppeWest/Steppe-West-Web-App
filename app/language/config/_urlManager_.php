<?php
return [
	'rules' => [
		'<language:[A-Za-z]{2,3}>' => 'sw-current-language/index',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>' => '<controller>/index',
	],
	'rules' => [
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>' => '<controller>/index',
		'<language:[A-Za-z]{2,3}>' => 'site/index',
	],
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
		'TR' => 'site/language-redirect?lang=tr',
	],
];
