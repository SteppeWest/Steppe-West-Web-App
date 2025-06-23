<?php
/**
 * app/frontend/config/main-local.php
 */

$rootUrl = 'https://steppewest.com'; // production

return [
	'homeUrl' => $rootUrl,
	'components' => [
		'urlManager' => [
			'baseUrl' => $rootUrl,
		],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'n9R4mk3Czhb2w7fBUWi0_zVyByEgWj8_',
		],
	],
];
