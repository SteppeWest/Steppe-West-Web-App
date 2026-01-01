<?php

return [
	'sourcePath' => dirname(__DIR__, 2),
	'messagePath' => dirname(__DIR__, 2) . '/messages',
	'languages' => ['ru', 'kk', 'ky', 'tg', 'uz', 'tr'], // whatever you want later
	'translator' => 'Yii::t',
	'sort' => true,
	'overwrite' => true,
	'removeUnused' => false,

	// IMPORTANT: where to scan
	'only' => [
		'*.php',
	],
	'except' => [
		'.git',
		'vendor',
		'runtime',
		'node_modules',
		'assets',
	],

	// Categories you expect to see
	'markUnused' => true,
	'categories' => [
		'admin',
		'admin.nav',
		'admin.users',
		'usuario',
		'app',
	],
];
