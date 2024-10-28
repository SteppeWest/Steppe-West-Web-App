<?php
$endpoint = 'links';
$appfolder  = 'app';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../' . $appfolder . '/vendor/autoload.php';
require __DIR__ . '/../' . $appfolder . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../' . $appfolder . '/common/config/bootstrap.php';
require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
	require __DIR__ . '/../' . $appfolder . '/common/config/main.php',
	require __DIR__ . '/../' . $appfolder . '/common/config/main-local.php',
	require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/main.php',
	require __DIR__ . '/../' . $appfolder . '/' . $endpoint . '/config/main-local.php'
);

(new yii\web\Application($config))->run();
