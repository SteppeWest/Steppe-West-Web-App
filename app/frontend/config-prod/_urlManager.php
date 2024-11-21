<?php
return [
	//'baseUrl' => 'http://steppewest.p2m',
	//'baseUrl' => 'https://steppewest.com',
	'rules' => [
		// Root URL, defaults to 'intro' in LetterController
		'' => 'letter/letter/view',

		// Specific slugs (e.g., intro, invite, faq) without or with language code
		'<slug:intro|invite|faq>' => 'letter/letter/view',
		'<slug:intro|invite|faq>/<lc:[a-z]{2,3}>' => 'letter/letter/view',

		// Language code only (e.g., domain.tld/en) routes to the view action
		'<lc:[a-z]{2,3}>' => 'letter/letter/view',

		// Specific slug 'links' without or with language code
		'<slug:links>' => 'links/links/view',
		'<slug:links>/<lc:[a-z]{2,3}>' => 'links/links/view',

		// Fallback rules to handle other modules or controllers
		'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	],
];
/**
 *
 *
 */
