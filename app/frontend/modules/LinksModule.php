<?php
/**
 * LetterModule.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\modules;

use frontend\modules\LanguageModule;

/**
 * SwLinks module definition class
 */
class LinksModule extends LanguageModule
{
	/**
	 * {@inheritdoc}
	public $controllerNamespace = 'frontend\modules\controllers';
	 */

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();

		// custom initialization code goes here
	}
}
