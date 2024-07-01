<?php

$endpoint = 'invite';
$appfolder  = '01906f2b-7634-71b9-8eb0-9a03d7820dc8';

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../' . $appfolder . '/vendor/autoload.php';
require __DIR__ . '/../' . $appfolder . '/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../' . $appfolder . '/config/' . $endpoint . '/web.php';

(new yii\web\Application($config))->run();
