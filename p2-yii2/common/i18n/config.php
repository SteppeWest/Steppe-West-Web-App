<?php
/**
 * @common/i18n/config.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

return [
	'sourcePath' => dirname(__DIR__, 2),           // points at project root-ish; adjust if needed
	'messagePath' => __DIR__ . '/messages',
	'languages' => ['ru', 'kk', 'ky', 'tg', 'uz'],
	'sourceLanguage' => 'en',
	'translator' => 'Yii::t',
	'sort' => true,
	'removeUnused' => false,                       // I’d keep false while refactoring
	'markUnused' => true,                          // optional
	'only' => ['*.php'],
	'format' => 'php',
	'overwrite' => false,
	'except' => [
		'/vendor',
		'/runtime',
		'/tests/_output',
		'node_modules',
		'.git',
		'.svn',
		'.hg',
	],

	// This is the key part: map categories
	// (You can start by extracting everything into 'sw' and then split later.)
	'categories' => [
		'sw',
		'sw.a11y',

		// shared app areas (used by both backend & frontend eventually)
		'sw.auth',
		'sw.user',
		'sw.profile',
		'sw.settings',

		// backend-only
		'sw.backend',
		'sw.backend.nav',
		'sw.backend.admin',
		'sw.backend.rbac',
		'sw.backend.audit',
		'sw.backend.demo',

		// frontend-only (reserve now, fill later)
		'sw.frontend',

		// optional
		'sw.tests',
	],
];
