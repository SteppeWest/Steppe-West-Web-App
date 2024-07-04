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
			'cookieValidationKey' => 'LFZMHWb2bcuOxDbi13fUWBOedA6ZJeyk',
		],
	],
];

return ArrayHelper::merge($baseConfig, $config);
