<?php
/**
 * LinksController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\modules\controllers;

use Yii;
use yii\base\Theme; // Add this to create a Theme instance
use frontend\modules\assets\LinksAsset;

/**
 * Default controller for the `SwLinksModule` module
 */
class LinksController extends LanguageModuleController
{
	public function init()
	{
		parent::init();

		// Set a new Theme instance specifically for this controller
		Yii::$app->view->theme = new Theme([
			'pathMap' => [
				'@app/views' => '@app/modules/links',
			],
		]);

		// Specify the layout explicitly for this controller
		$this->layout = '@app/modules/links/layouts/main';
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
		$linksAsset = LinksAsset::register($this->view);
		$this->view->params['linksAsset'] = $linksAsset;

		// Render the specific view for Links
		return $this->render('@app/modules/links/site/index');
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
