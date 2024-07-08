<?php
$endpoint = 'letter';
$appfolder  = '0190888a-c7e8-7011-8121-33bd8b8c4763';

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
	die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require __DIR__ . '/../' . $appfolder . '/vendor/autoload.php';
require __DIR__ . '/../' . $appfolder . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../' . $appfolder . '/common/config/bootstrap.php';
require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/bootstrap.php';


$config = yii\helpers\ArrayHelper::merge(
	require __DIR__ . '/../' . $appfolder . '/common/config/main.php',
	require __DIR__ . '/../' . $appfolder . '/common/config/main-local.php',
	require __DIR__ . '/../' . $appfolder . '/common/config/test.php',
	require __DIR__ . '/../' . $appfolder . '/common/config/test-local.php',
	require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/main.php',
	require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/main-local.php',
	require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/test.php',
	require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/test-local.php'
);

(new yii\web\Application($config))->run();
