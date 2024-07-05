<?php
use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../web.php';

// Get the folder name dynamically
$folderName = basename(__DIR__);

$config = [
	'id' => $folderName,
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'peSCoQvozIJaVm6hyq3ZQpKR7iRdnH9s',
		],
	],
];

return ArrayHelper::merge($baseConfig, $config);
