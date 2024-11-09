<?php
/**
 * LetterController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\modules\controllers;

/**
 * Default controller for the `SwLetterModule` module
 */
class LetterController extends \frontend\modules\controllers\LanguageModuleController
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}


}

/*
sw-language
frontend\modules\LanguageModule
frontend\modules\controllers\LanguageController
sw-letter
frontend\modules\LetterModule
frontend\modules\controllers\LetterController
sw-links
frontend\modules\LinksModule
frontend\modules\controllers\LinksController
 */
