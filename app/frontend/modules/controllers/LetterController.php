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

use Yii;
use yii\base\Theme; // Add this to create a Theme instance
use frontend\modules\assets\LetterAsset;

/**
 * Default controller for the `SwLetterModule` module
 */
class LetterController extends LanguageModuleController
{
	public function init()
	{
		parent::init();

		// Set a more specific path map for the theme
		Yii::$app->view->theme = new Theme([
			'pathMap' => [
				'@app/views/layouts' => '@app/modules/letter/layouts',
				'@app/views/partials' => '@app/modules/letter/partials',
			],
		]);

		// Specify the layout explicitly for this controller
		$this->layout = '@app/modules/letter/layouts/main';
	}

	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Renders the view for the module
	 * @return string
	 */
	public function actionView($slug = 'intro', $lc = null)
	{
		// Run shared logic from the parent
		parent::actionView($slug, $lc);

		// Register the specific asset
		$letterAsset = LetterAsset::register($this->view);
		$this->view->params['letterAsset'] = $letterAsset;

		// Render the specific view for Letter
		return $this->render('@app/modules/letter/site/index');
	}
}

/*
 */

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

