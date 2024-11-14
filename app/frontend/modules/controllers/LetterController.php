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
use yii\helpers\Url;
use yii\helpers\Html;
use Symfony\Component\Yaml\Yaml;
use common\widgets\SwSubstitution;
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
		$page = parent::actionView($slug, $lc);

		// Register the letter asset
		$letterAsset = LetterAsset::register($this->view);

		// Set up flags banner
		$this->view->params['flagsBanner'] = Html::img(
			$letterAsset->baseUrl . '/img/flags-banner-200h.png',
			[
				'class' => 'img-fluid',
				'alt' => 'Steppe West 🇰🇿 🇰🇬 🇹🇯 🇹🇲 🇺🇿 🇦🇫 🇦🇿 🇲🇳 🇹🇷',
			],
		);

		// Set up socials buttons
		$socialList = Yii::$app->params['swSocialAccounts'];
		$this->view->params['socialButtons'] = SwSubstitution::applySubstitutions($socialList);

		// Set up origin link
		$origin = null;
		if ($page->origin) {
			$origin = SwSubstitution::applySubstitutions($page->origin);
		}
		$this->view->params['origin'] = $origin !== null
			? Html::tag('div',
				Html::tag('div', $origin, ['class' => 'col-lg-8 text-center']),
				['class' => 'justify-content-center row']
			)
		: null;

		// Process body content
		$processedBody = $this->processBodyContent($page->body_content, $lc, $letterAsset);
		$this->view->params['bodyContent'] = $processedBody['contentArray'];

/*
$this->view->params['lc']
$this->view->params['slug']
$this->view->params['locale']
$this->view->params['footer']
$this->view->params['metaAssetUrl']
$this->view->params['langMenu']
$this->view->params['page']
 */

		// Render the specific view for Letter
		return $this->render('@app/modules/letter/site/index');
	}

	protected function processBodyContent($rawContent, $lc, $letterAsset)
	{
		$parsedContent = [];

		try {
			// Parse YAML from the body content
			$parsedContent = Yaml::parse($rawContent);
		}
		catch (\Exception $e) {
			// Log or handle the YAML parsing error as needed
			Yii::error("Error parsing body content YAML: " . $e->getMessage(), __METHOD__);
			return [];
		}

		$contentArray = [];

		// Process each content section
		foreach ($parsedContent as $index => $item) {
			if (!isset($item['content']) || !is_array($item['content'])) {
				continue;
			}

			// Handle the first content item for 'faq'
			if ($index === 0) {
				$faqLink = $this->generateFaqLink($item['content'], $lc);
				if ($faqLink) {
					$this->view->params['faqLink'] = $faqLink;
					continue; // Skip processing this item as HTML content
				}
			}

			// Process remaining content items
			$htmlContent = '';
			foreach ($item['content'] as $contentItem) {
				foreach ($contentItem as $key => $text) {
					switch ($key) {
						case 'paragraph':
							$htmlContent .= Html::tag('p', Html::encode($text));
							break;
						case 'lead':
							$htmlContent .= Html::tag('p', Html::encode($text), ['class' => 'lead']);
							break;
						case 'heading':
							$htmlContent .= Html::tag('h4', Html::encode($text));
							break;
					}
				}
			}

			$contentArray[] = $htmlContent;
		}

		return $contentArray;
	}
	{
		// Register LetterAsset to get base URL for images
		$letterAsset = LetterAsset::register($this->view);
		$baseFolderPath = Yii::getAlias('@frontend/web') . '/img/circles';

		// Get list of subfolders and shuffle them
		$folders = array_filter(glob($baseFolderPath . '/*'), 'is_dir');
		shuffle($folders);

		// Initialize folder index for cycling through folders if content items exceed folder count
		$folderIndex = 0;
		$contentCount = count($this->view->params['bodyContent']);

		// Process each content item, adding an image from the current folder
		foreach ($this->view->params['bodyContent'] as &$contentItem) {
			// Get the folder name and generate the image URL
			$folderName = basename($folders[$folderIndex]);
			$imageFiles = glob($folders[$folderIndex] . '/*.{jpg,png,jpeg}', GLOB_BRACE);

			// If there are images in the folder, choose a random one
			if (!empty($imageFiles)) {
				$randomImageFile = $imageFiles[array_rand($imageFiles)];
				$imageFilename = pathinfo($randomImageFile, PATHINFO_FILENAME);

				// Convert folder name to title-cased label
				$title = 'Central Asian ' . ucwords(str_replace('_', ' ', $folderName));

				// Generate the HTML image tag with title and URL
				$contentItem['image'] = Html::img(
					$letterAsset->baseUrl . "/img/circles/{$folderName}/{$imageFilename}.jpg",
					[
						'class' => 'img-fluid rounded-circle',
						'alt' => $title,
					]
				);
			}

			// Move to the next folder; if at the end of folders, start again
			$folderIndex = ($folderIndex + 1) % count($folders);
		}

		// Set modified bodyContent to view parameters
		$this->view->params['bodyContent'] = $this->processBodyContent($this->view->params['bodyContent']);

		// Render the main content view
		return $this->render('@app/modules/letter/site/index');
	}

	protected function generateFaqLink($contentItems, $lc)
	{
		foreach ($contentItems as $contentItem) {
			if (isset($contentItem['faq'])) {
				return Html::tag(
					'div',
					Html::tag(
						'div',
						Html::a(
							Html::encode($contentItem['faq']),
							Yii::$app->homeUrl . "/faq/" . Html::encode($lc),
							['class' => 'text-info link-opacity-75-hover text-decoration-none']
						),
						['class' => 'col-lg-8 text-center']
					),
					['class' => 'justify-content-center row']
				);
			}
		}
		return null; // Return null if no FAQ link is found
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



