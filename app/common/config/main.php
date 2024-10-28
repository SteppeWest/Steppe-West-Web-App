<?php
return [
	'name' => 'Steppe West', // Set the application name here
	'homeUrl' => '//steppewest.com/', // Set the global home URL here
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
