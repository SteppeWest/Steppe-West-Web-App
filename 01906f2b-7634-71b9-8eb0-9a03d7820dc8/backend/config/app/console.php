<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../console.php';


// Get the folder name dynamically
$folderName = basename(__DIR__) . '-console';

$config = [
	// subdomain-specific console configurations
	'id' => $folderName,
];

return ArrayHelper::merge($baseConfig, $config);
