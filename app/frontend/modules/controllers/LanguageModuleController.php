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
use Symfony\Component\Yaml\Yaml;
use common\assets\SwMetaAsset;
use common\widgets\SwFlagSelector;
use common\widgets\SwSubstitution;
use frontend\models\Language;
use frontend\models\LanguagePage;

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
		$lc = $lc ?? Yii::$app->params['swDefaultLanguage'];
		$this->view->params['lc'] = $lc;
		$this->view->params['slug'] = $slug;

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
		$this->view->params['locale'] = 'en_AU';
		$this->view->params['footer'] = null;
		if ($lang) {
			if ($lang->html_lang) {
				Yii::$app->language = $lang->html_lang;
			}
			if ($lang->locale) {
				$this->view->params['locale'] = $lang->locale;
			}
			if ($lang->footer_content) {
				$this->view->params['footer'] = $this->processFooterContent($lang->footer_content);
			}
		}

		// Register the meta asset
		$this->view->params['metaAssetUrl'] = SwMetaAsset::register($this->view);

		// Create the language menu
		$this->view->params['langMenu'] = $this->createLanguageMenu($slug, $lc);

		return $page;
	}

	protected function createLanguageMenu($slug, $lc)
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
			$isActive = ($language->lang_code === $lc);

			// Add to menu items
			$menuItems[] = [
				'label' => $label,
				'url' => $newUrl,
				'active' => $isActive, // Set active if this is the current language
			];
		}

		return $menuItems;
	}

	/**
	 * Processes footer content by parsing YAML and applying substitutions.
	 *
	 * @param string|null $footerContent Raw YAML string from the database
	 * @return array Processed footer content as an array of text strings
	 */
	protected function processFooterContent($footerContent)
	{
		$parsedContent = [];
		try {
			// Parse YAML from the footer content
			$parsedContent = Yaml::parse($footerContent);
		} catch (\Exception $e) {
			// Log or handle the YAML parsing error as needed
			Yii::error("Error parsing footer content YAML: " . $e->getMessage(), __METHOD__);
			return [];
		}

		// Extract text fields from parsed content and apply substitutions
		$processedContent = '';
		if (is_array($parsedContent)) {
			foreach ($parsedContent as $contentItem) {
				if (isset($contentItem['text'])) {
					// Apply substitutions to each text item
					$contentTemp = SwSubstitution::applySubstitutions($contentItem['text']);
					$processedContent .= Html::tag(
						'p', $contentTemp, ['class' => 'm-0 text-center text-white']
					);
				}
			}
		}

		return $processedContent;
	}
}

/*
 */

