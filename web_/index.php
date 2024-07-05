<?php
$currentDir = basename(dirname(__FILE__));

$endpoint = 'home';
$appfolder  = '01906f2b-7634-71b9-8eb0-9a03d7820dc8';

if (strpos($currentDir, 'sw_') === 0) {
    $endpoint = substr($currentDir, 3); // Remove 'sw_' from the start
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/' . $appfolder . '/vendor/autoload.php';
require __DIR__ . '/' . $appfolder . '/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/' . $appfolder . '/config/' . $endpoint . '/web.php';

(new yii\web\Application($config))->run();
