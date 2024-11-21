<?php
return yii\helpers\ArrayHelper::merge(
	require __DIR__ . '/main.php',
	require __DIR__ . '/main-local.php',
	require __DIR__ . '/test.php',
	require __DIR__ . '/test-local.php',
	[
		'components' => [
			'request' => [
				// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
				'cookieValidationKey' => 'QGh_wG1sv4ie0r7ADh8g6sNYiuwKiEpo',
			],
		],
	]
);
