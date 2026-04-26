<?php
/**
 * @app/i18n/config.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

return [
	'sourcePath'     => dirname(__DIR__, 2),       // points at project root-ish; adjust if needed
	'messagePath'    => __DIR__ . '/messages',
	'languages'      => ['ru','kk','ky','tg','tk','uz','az','mn','tr'], // message extraction targets, not page availability
	'sourceLanguage' => 'en',
	'translator'     => ['\Yii::t', 'Yii::t'],
	'sort'           => true,
	'format'         => 'php',
	'overwrite'      => true,
	'removeUnused'   => false,                     // I’d keep false while refactoring
	'markUnused'     => true,                      // optional
	'only'           => ['*.php'],
	'except' => [
		'/vendor/',
		'/runtime/',
		'/tests/_output/',
		'/node_modules/',
		'/.git/',
		'/.svn/',
		'/.hg/',
		'/i18n/',
		'/i18n/messages/', // avoid scanning generated files
	],
	'ignoreCategories' => [
		'usuario',
	],

	// Additional items provided but commented out...

	/*
	// File header used in generated messages files
	'phpFileHeader' => '',
	// PHPDoc used for array of messages with generated messages files
	'phpDocBlock' => null,
	*/

	/*
	// 'db' output format is for saving messages to database.
	'format' => 'db',
	// Connection component to use. Optional.
	'db' => 'db',
	// Custom source message table. Optional.
	// 'sourceMessageTable' => '{{%source_message}}',
	// Custom name for translation message table. Optional.
	// 'messageTable' => '{{%message}}',
	*/

	/*
	// 'po' output format is for saving messages to gettext po files.
	'format' => 'po',
	// Root directory containing message translations.
	'messagePath' => __DIR__ . DIRECTORY_SEPARATOR . 'messages',
	// Name of the file that will be used for translations.
	'catalog' => 'messages',
	// boolean, whether the message file should be overwritten with the merged messages
	'overwrite' => true,
	*/
];
