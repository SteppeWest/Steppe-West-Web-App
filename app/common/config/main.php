<?php
use yii\helpers\Url;

return [
	'name' => 'Steppe West', // Set the application name here
	'homeUrl' => '//steppewest.p2m/', // Local development URL
	//'homeUrl' => '//dev.steppewest.com/', // Remote development URL
	//'homeUrl' => '//steppewest.com/', // Public
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
