# SW Files

## Config

### Base Config

Located at `/f85e7124-c0dc-4c64-9e91-99036ba56790/config/`

Files...

File               | Comment
------------------ | -------------------------------
__autocomplete.php | Unmodified. Probably not used.
console.php        | Customised as necessary.
db.php             | Edited to include DB settings.
params.php         | To be edited to include params.
test_db.php        | Customised as necessary.
test.php           | Customised as necessary.
web.php            | Customised as necessary.

### Endpoint Config

Located at `/f85e7124-c0dc-4c64-9e91-99036ba56790/config/subdomain/`

#### `web.php`

```php
<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../web.php';

$config = [
	'components' => [
		// subdomain-specific components configuration
	],
	// other subdomain-specific configurations
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return ArrayHelper::merge($baseConfig, $config);
```

#### `console.php `

```php
<?php

use yii\helpers\ArrayHelper;

$baseConfig = require __DIR__ . '/../console.php';

$config = [
	// subdomain-specific test configurations
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
	// configuration adjustments for 'dev' environment
	// requires version `2.1.21` of yii2-debug module
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return ArrayHelper::merge($baseConfig, $config);
```

#### `test.php `

```php
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
```

## Web

The web host only allows the base domain webroot at `public_html/`. That requires a small difference between the web files for `steppewest.com` & those for subdomains.

### `steppewest.com`

`index.php`

```php
<?php

$subdomain = 'home';

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/f85e7124-c0dc-4c64-9e91-99036ba56790/vendor/autoload.php';
require __DIR__ . '/f85e7124-c0dc-4c64-9e91-99036ba56790/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/f85e7124-c0dc-4c64-9e91-99036ba56790/config/' . $subdomain . '/web.php';

(new yii\web\Application($config))->run();
```

`index-test.php`

```php
<?php

$subdomain = 'home';

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require __DIR__ . '/f85e7124-c0dc-4c64-9e91-99036ba56790/vendor/autoload.php';
require __DIR__ . '/f85e7124-c0dc-4c64-9e91-99036ba56790/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/f85e7124-c0dc-4c64-9e91-99036ba56790/config/' . $subdomain . '/test.php';

(new yii\web\Application($config))->run();
```

### `subdomain.steppewest.com`

`index.php`

```php
<?php

$subdomain = 'dev';

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/vendor/autoload.php';
require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/' . $subdomain . '/web.php';

(new yii\web\Application($config))->run();
```

`index-test.php`

```php
<?php

$subdomain = 'dev';

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
	die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/vendor/autoload.php';
require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../f85e7124-c0dc-4c64-9e91-99036ba56790/config/' . $subdomain . '/test.php';

(new yii\web\Application($config))->run();
```
