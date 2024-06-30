<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../test.php';

/**
 * Application configuration shared by all test types
 */
$config = [
	// subdomain-specific test configurations
];

return ArrayHelper::merge($baseConfig, $config);
