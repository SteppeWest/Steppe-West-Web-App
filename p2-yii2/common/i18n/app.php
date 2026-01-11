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
	// string, required, root directory of all source files
	//'sourcePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
	'sourcePath'     => dirname(__DIR__, 2),       // points at project root-ish; adjust if needed

	// Root directory containing message translations.
	//'messagePath' => __DIR__,
	'messagePath'    => __DIR__ . '/messages',

	// array, required, list of language codes that the extracted messages
	// should be translated to. For example, ['zh-CN', 'de'].
	'languages'      => ['ru', 'kk', 'ky', 'tg', 'uz'],
	'sourceLanguage' => 'en',

	// string, the name of the function for translating messages.
	// Defaults to 'Yii::t'. This is used as a mark to find the messages to be
	// translated. You may use a string for single function name or an array for
	// multiple function names.
	'translator' => ['\Yii::t', 'Yii::t'],

	// boolean, whether to sort messages by keys when merging new messages
	// with the existing ones. Defaults to false, which means the new (untranslated)
	// messages will be separated from the old (translated) ones.
	//'sort' => false,
	'sort'           => true,

	// 'php' output format is for saving messages to php files.
	'format'         => 'php',

	// boolean, whether the message file should be overwritten with the merged messages
	'overwrite'      => true,

	// boolean, whether to remove messages that no longer appear in the source code.
	// Defaults to false, which means these messages will NOT be removed.
	'removeUnused'   => false,                     // I’d keep false while refactoring

	// boolean, whether to mark messages that no longer appear in the source code.
	// Defaults to true, which means each of these messages will be enclosed with a pair of '@@' marks.
	'markUnused'     => true,                      // optional

	// array, list of patterns that specify which files (not directories) should be processed.
	// If empty or not set, all files will be processed.
	// See helpers/FileHelper::findFiles() for pattern matching rules.
	// If a file/directory matches both a pattern in "only" and "except", it will NOT be processed.
	'only' => ['*.php'],

	// Categories to extract (app + package)
	// Not found in template
	'categories' => [
		'sw',
		'sw.*',
		'p2m.rbac',
		'p2m.rbac.*',
	],

	// Not found in template
	'onlyFileTypes' => ['php'],

	// array, list of patterns that specify which files/directories should NOT be processed.
	// If empty or not set, all files/directories will be processed.
	// See helpers/FileHelper::findFiles() for pattern matching rules.
	// If a file/directory matches both a pattern in "only" and "except", it will NOT be processed.
	/**
	'except' => [
		'.*',
		'/.*',
		'/messages',
		'/tests',
		'/runtime',
		'/vendor',
		'/BaseYii.php',
	],
	 */
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

	// Message categories to ignore
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
