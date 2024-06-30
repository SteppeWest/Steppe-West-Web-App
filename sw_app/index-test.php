<?php

$endpoint = 'dev';

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
	die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/vendor/autoload.php';
require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/' . $endpoint . '/test.php';

(new yii\web\Application($config))->run();
