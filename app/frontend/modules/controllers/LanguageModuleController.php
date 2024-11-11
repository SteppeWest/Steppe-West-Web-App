<?php
/**
 * LanguageModuleController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\modules\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Language;
use frontend\models\LanguagePage;
use frontend\assets\SwMetaAsset;
use common\widgets\SwFlagSelector;

/**
 * Default controller for the `SwLanguageModule` module
 */
class LanguageModuleController extends Controller
{
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
		$defaultLc = Yii::$app->params['swDefaultLanguage'];

		$lc = $lc ?? $defaultLc;

		// Retrieve the language page based on slug and language code
		$page = LanguagePage::find()
			->where(['slug' => $slug, 'page_lang' => $lc])
			->one();

		if (!$page) {
			throw new NotFoundHttpException('Page not found.');
		}

		// Retrieve the language settings from Language
		$lang = Language::find()
			->where(['lang_code' => $page->page_lang])
			->one();

		// Set Yii::$app->language if Language and html_lang are found
		if ($lang && $lang->html_lang) {
			Yii::$app->language = $lang->html_lang;
		}

		// Register the meta asset
		$metaAsset = SwMetaAsset::register($this->view);

		// Create the language menu items
		$langMenuItems = $this->createLanguageMenuItems($slug, $defaultLc);

		// Set view parameters for use in the layout and views
		$this->view->params['slug']          = $slug;
		$this->view->params['lc']            = $lc;
		$this->view->params['page']          = $page;
		$this->view->params['lang']          = $lang;
		$this->view->params['langMenuItems'] = $langMenuItems;
		$this->view->params['metaAsset']     = $metaAsset;

		// Register asset and render view in child classes
	}

	protected function getFlagIcon($flagIcon)
	{
		// To be modified to return an SVG if there is no emoji
		$codePoints = [
			127397 + ord($flagIcon[0]),
			127397 + ord($flagIcon[1])
		];
		return mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
	}

	protected function createLanguageMenuItems($slug, $defaultLc)
	{
		// Fetch active languages ordered by menu_position
		$languages = Language::find()
			->where(['active' => true])
			->orderBy(['menu_position' => SORT_ASC])
			->all();

		// Get current URL segments
		$path = Yii::$app->request->pathInfo;
		$path = trim($path, '/');
		$segments = explode('/', $path);

		// Get current language code based on the presence of a slug
		$currentLangCode = $slug ? ($segments[1] ?? $defaultLc) : ($segments[0] ?? $defaultLc);

		$menuItems = [];
		$menuUrlBase = Yii::$app->homeUrl . '/';
		if ($slug) {
			$menuUrlBase .= $slug . '/';
		}

		foreach ($languages as $language) {
			// Generate the label with the flag emoji and UI label
			$flagIcon = SwFlagSelector::getFlagIcon($language->flag_icon);
			$label = $flagIcon . ' ' . Html::encode($language->ui_label);

			// Construct the URL
			$newUrl = $menuUrlBase . $language->lang_code;

			// Check if this is the active item
			$isActive = ($language->lang_code === $currentLangCode);

			// Add to menu items
			$menuItems[] = [
				'label' => $label,
				'url' => $newUrl,
				'active' => $isActive, // Set active if this is the current language
			];
		}

		return $menuItems;
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

