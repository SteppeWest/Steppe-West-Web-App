<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../test.php';

/**
 * Application configuration shared by all test types
 */

// Get the folder name dynamically
$folderName = basename(__DIR__) . '-tests';

$config = [
	// subdomain-specific test configurations
	'id' => $folderName,
];

return ArrayHelper::merge($baseConfig, $config);
