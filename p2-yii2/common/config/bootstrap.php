<?php
/**
 * app/common/config/bootstrap.php
 */
Yii::setAlias('@common',   dirname(__DIR__));
Yii::setAlias('@backend',  dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@console',  dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@static',   dirname(dirname(__DIR__)) . '/static');

// Define dynamic host base URL (e.g., https://steppewest.com or https://steppewest.p2m)
Yii::$container->set('hostBaseUrl', function () {
	$host = Yii::$app->request->hostName;
	$scheme = Yii::$app->request->isSecureConnection ? 'https' : 'http';
	return "{$scheme}://{$host}";
});
