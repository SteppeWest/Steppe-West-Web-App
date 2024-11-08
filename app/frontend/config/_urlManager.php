<?php
return [
	'baseUrl' => 'http://steppewest.p2m',
	//'baseUrl' => 'http://steppewest.com',
	'rules' => [
		// Root URL, defaults to 'intro' in LanguagePageController
		'' => 'sw-language-page/view',
		'<alias:intro|invite|faq>' => 'sw-language-page/view',
		'<lc:[a-z]{2,3}>' => 'sw-language-page/view',
		'<alias:intro|invite|faq>/<lc:[a-z]{2,3}>' => 'sw-language-page/view',
	],
];
/*
 *
 *
 */
