<?php

$endpoint = 'app';
$appfolder  = 'f85e7124-c0dc-4c64-9e91-99036ba56790';

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../' . $appfolder . '/vendor/autoload.php';
require __DIR__ . '/../' . $appfolder . '/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../' . $appfolder . '/config/' . $endpoint . '/web.php';

(new yii\web\Application($config))->run();
