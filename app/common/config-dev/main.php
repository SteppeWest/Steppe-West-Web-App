<?php
use yii\helpers\Url;

return [
	'bootstrap' => [
		function () {
			// Get the current request's host and scheme
			$hostInfo = Yii::$app->request->hostInfo;
			$basePath = Yii::$app->request->baseUrl;

			// Set dynamically generated baseUrl and homeUrl
			Yii::$app->urlManager->baseUrl = $hostInfo . $basePath;
			Yii::$app->homeUrl = $hostInfo . $basePath;
		},
	],
	'name' => 'Steppe West', // Set the application name here
	'charset' => 'utf-8',
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'components' => [
		'cache' => [
			'class' => \yii\caching\FileCache::class,
		],
	],
];
