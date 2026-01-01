<?php

return [
	'sourcePath' => dirname(__DIR__, 2) . '/backend',
	'messagePath' => dirname(__DIR__, 2) . '/backend/messages',
	'languages' => ['ru'],
	//'languages' => ['ru', 'kk', 'ky', 'tg', 'uz'],
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
