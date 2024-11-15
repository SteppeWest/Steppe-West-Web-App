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
use yii\base\Theme;
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
		$this->view->params['origin'] = $this->setOriginLink($page);

		// Process body content
		$rawBodyContent = $this->parseYamlItem($page->body_content);
		$this->view->params['faqLink'] = $this->generateFaqLink($rawBodyContent, $lc);
		$this->view->params['bodyContent'] = $this->processBodyContent($rawBodyContent, $lc, $letterAsset);

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

	protected function setOriginLink($page): ?string
	{
		$origin = null;
		if ($page->origin) {
			$origin = SwSubstitution::applySubstitutions($page->origin);

			return Html::tag('div',
				Html::tag('div', $origin, ['class' => 'col-lg-8 text-center']),
				['class' => 'justify-content-center row']
			);
		}
		return null;
	}

	protected function generateFaqLink(array &$rawBodyContent, string $lc): ?string
	{
		// Ensure the first content item exists
		if (empty($rawBodyContent) || !isset($rawBodyContent[0]['content'])) {
			return null;
		}

		// Examine the first content item
		$firstContentItem = $rawBodyContent[0]['content'];

		// Check if it contains an 'faq' key
		foreach ($firstContentItem as $contentItem) {
			if (isset($contentItem['faq'])) {
				// Generate the FAQ link
				$faqLink = Html::a(
					Html::encode($contentItem['faq']),
					Yii::$app->homeUrl . "/faq/" . $lc,
					['class' => 'text-info link-opacity-75-hover text-decoration-none']
				);

				// Wrap the link in necessary divs
				$wrappedLink = Html::tag(
					'div',
					Html::tag('div', $faqLink, ['class' => 'col-lg-8 text-center']),
					['class' => 'justify-content-center row']
				);

				// Remove the first content item from the array
				array_shift($rawBodyContent);

				return $wrappedLink;
			}
		}

		// No 'faq' key found, return null
		return null;
	}

	protected function processBodyContent($rawContent, $lc, $letterAsset): ?array
	{
		// Ensure content exists
		if (empty($rawContent)) {
			return null;
		}

		// Get shuffled list of circle images folders
		$circleFolders = $this->getCirclesFolders($letterAsset);
		$folderIndex = 0; // Initialize folder index

		// Process each content item, adding an image from the current folder
		$processedContent = [];
		foreach ($rawContent as $index => $item) {
			if (!isset($item['content']) || !is_array($item['content'])) {
				continue;
			}

			// Process content item
			$contentItem['content'] = $this->processContentItem($item['content']);
			$contentItem['image'] = $this->addCircleImage($circleFolders, $letterAsset, $folderIndex);

			$processedContent[] = $contentItem;
		}

		return $processedContent;
	}

	protected function getCirclesFolders($letterAsset): array
	{
		$circleFolderPath = $letterAsset->baseUrl . '/img/circles';

		$circlesFolders = array_filter(glob($circleFolderPath . '/*'), 'is_dir');
		if (empty($circlesFolders)) {
			Yii::error("No folders found in $circleFolderPath", __METHOD__);
			return []; // Return empty content if no folders are available
		}

		shuffle($circlesFolders);

		return $circlesFolders;
	}

	protected function processContentItem($rawContentItem): string
	{
		$htmlContent = '';

		foreach ($rawContentItem as $key => $text) {
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
				case 'line':
					$htmlContent .= Html::encode($text) . '<br>';
					break;
			}
		}

		return $htmlContent;
	}

	protected function addCircleImage($circleFolders, $letterAsset, &$folderIndex): string
	{
		// Validate circleFolders array
		if (empty($circleFolders) || !isset($circleFolders[$folderIndex])) {
			Yii::warning("No valid folder found in circleFolders at index $folderIndex", __METHOD__);
			return Html::img(
				$letterAsset->baseUrl . "/img/circles/default.jpg", // Placeholder image
				[
					'class' => 'img-fluid rounded-circle',
					'alt' => 'Central Asian Placeholder Image',
				]
			);
		}

		// Get the folder name and image files
		$folderName = basename($circleFolders[$folderIndex]);
		$imageFiles = glob($circleFolders[$folderIndex] . '/*.jpg');

		// Handle missing images in folder
		if (empty($imageFiles)) {
			Yii::warning("No images found in folder: {$circleFolders[$folderIndex]}", __METHOD__);
			return Html::img(
				$letterAsset->baseUrl . "/img/circles/default.jpg", // Placeholder image
				[
					'class' => 'img-fluid rounded-circle',
					'alt' => 'Central Asian Placeholder Image',
				]
			);
		}

		// Select a random image and generate HTML
		$randomImageFile = $imageFiles[array_rand($imageFiles)];
		$imageFilename = pathinfo($randomImageFile, PATHINFO_FILENAME);
		$title = 'Central Asian ' . ucwords(str_replace('_', ' ', $folderName));

		$circleImage = Html::img(
			$letterAsset->baseUrl . "/img/circles/{$folderName}/{$imageFilename}.jpg",
			[
				'class' => 'img-fluid rounded-circle',
				'alt' => $title,
			]
		);

		// Move to the next folder; if at the end of folders, start again
		$folderIndex = ($folderIndex + 1) % count($circleFolders);

		return $circleImage;
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

