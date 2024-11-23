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
			],
		]);

		// Specify the layout explicitly for this controller
		$this->layout = '@app/modules/letter/layouts/main';
	}

	/**
	 * Renders the view for the module
	 * @return string
	 */
	public function actionView($slug = 'intro', $lc = null)
	{
		$lc = $lc ?? Yii::$app->params['swDefaultLanguage'];
		// Run shared logic from the parent
		$page = parent::actionView($slug, $lc);

		// Register the letter asset and get the base URL
		$letterAsset = LetterAsset::register($this->view);

		// Meta tags and content setup
		$this->view->params['canonicalUrl'] = rtrim(Yii::$app->homeUrl, '/') . '/' . $slug . '/' . $lc;
		$this->view->params['title'] = Html::encode($page->title);
		$this->view->params['subtitle'] = !empty($page->subtitle) ? Html::encode($page->subtitle) : null;
		$this->view->params['keywords'] = !empty($page->keywords) ? Html::encode($page->keywords) : null;
		$this->view->params['description'] = !empty($page->description) ? Html::encode($page->description) : null;

		// Images, socials, and origin
		$this->view->params['flagsBanner'] = Html::img(
			$letterAsset->baseUrl . '/img/flags-banner-200h.png',
			['class' => 'img-fluid', 'alt' => 'Steppe West 🇰🇿 🇰🇬 🇹🇯 🇹🇲 🇺🇿 🇦🇫 🇦🇿 🇲🇳 🇹🇷']
		);
		$this->view->params['socialButtons'] = SwSubstitution::applySubstitutions(Yii::$app->params['swSocialAccounts']);
		$this->view->params['origin'] = $this->setOriginLink($page);

		// Set up origin link
		$this->view->params['origin'] = $this->setOriginLink($page);

		// Process body content
		$rawContent = $this->parseYamlItem($page->body_content);
		$this->view->params['faqLink'] = $this->generateFaqLink($lc, $rawContent);
		$this->view->params['bodyContent'] = $this->processBodyContent($lc, $rawContent, $letterAsset);

/* view params
$this->params['lc']
$this->params['slug']
$this->params['locale']
$this->params['footer']
$this->params['metaAssetUrl']
$this->params['langMenu']
$this->params['canonicalUrl']
$this->params['title']
$this->params['subtitle']
$this->params['keywords']
$this->params['description']
$this->params['flagsBanner']
$this->params['socialButtons']
$this->params['origin']
$this->params['faqLink']
$this->params['bodyContent']
 */

		// Render the specific view for Letter
		return $this->render('@app/modules/letter/site/index');
	}

	protected function setOriginLink($page): ?string
	{
		$origin = null;
		if (!empty($page->origin)) {
			$origin = SwSubstitution::applySubstitutions($page->origin);
			return Html::tag('div',
				Html::tag('div', $origin, ['class' => 'col-lg-8 text-center']),
				['class' => 'justify-content-center row']
			);
		}
		return null;
	}

	protected function generateFaqLink($lc, array &$rawContent): ?string
	{
		// Ensure the first content item exists
		if (empty($rawContent) || !isset($rawContent[0]['content'])) {
			return null;
		}

		// Examine the first content item
		$firstContentItem = $rawContent[0]['content'];

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
				array_shift($rawContent);

				return $wrappedLink;
			}
		}

		// No 'faq' key found, return null
		return null;
	}

	protected function processBodyContent(string $lc, array $rawContent, LetterAsset $letterAsset): ?array
	{
		// Ensure content exists
		if (empty($rawContent)) {
			return null;
		}

		// Get shuffled list of circle images folders
		$circleFolders = $this->getCircleFolders($letterAsset);
		$folderIndex = 0; // Initialize folder index

		// Process each content item, adding an image from the current folder
		$processedContent = [];
		foreach ($rawContent as $index => $item) {
			if (!isset($item['content']) || !is_array($item['content'])) {
				continue;
			}

			$processedContent[] = [
				'content' => $this->processContentItem($item['content']),
				'image' => $this->addCircleImage($letterAsset, $circleFolders, $folderIndex),
			];;
		}

		return $processedContent;
	}

	protected function processContentItem(array $rawItem): string
	{
		$htmlContent = '';

		// Loop through each nested item
		foreach ($rawItem as $nestedItem) {
			// Ensure the nested item is an array
			if (!is_array($nestedItem)) {
				continue;
			}

			// Process each key-value pair within the nested item
			foreach ($nestedItem as $key => $text) {
				switch ($key) {
					case 'paragraph':
						$htmlContent .= Html::tag('p', $text);
						break;
					case 'lead':
						$htmlContent .= Html::tag('p', $text, ['class' => 'lead']);
						break;
					case 'heading':
						$htmlContent .= Html::tag('h4', $text);
						break;
				}
			}
		}

		return $htmlContent;
	}

	protected function getCircleFolders(LetterAsset $letterAsset): array
	{
		// Use basePath instead of baseUrl to get the filesystem path
		$circleFolderPath = $letterAsset->basePath . '/img/circles';

		// Find subfolders
		$circleFolders = array_filter(glob($circleFolderPath . '/*'), 'is_dir');
		if (empty($circleFolders)) {
			Yii::error("No folders found in $circleFolderPath", __METHOD__);
			return []; // Return empty array if no folders are available
		}

		shuffle($circleFolders);
		return $circleFolders;
	}

	protected function addCircleImage(LetterAsset $letterAsset, array $circleFolders, int &$folderIndex): string
	{
		// Validate circleFolders array
		if (empty($circleFolders) || !isset($circleFolders[$folderIndex])) {
			Yii::warning("No valid folder found in circleFolders at index $folderIndex", __METHOD__);
			return Html::img(
				$letterAsset->baseUrl . "/img/circles/default.jpg", // Placeholder image
				['class' => 'img-fluid rounded-circle', 'alt' => 'Central Asian Placeholder Image']
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
				['class' => 'img-fluid rounded-circle', 'alt' => 'Central Asian Placeholder Image']
			);
		}

		// Select a random image and generate HTML
		$randomImageFile = $imageFiles[array_rand($imageFiles)];
		$imageFilename = pathinfo($randomImageFile, PATHINFO_FILENAME);
		$title = 'Central Asian ' . ucwords(str_replace('_', ' ', $folderName));

		$circleImage = Html::img(
			$letterAsset->baseUrl . "/img/circles/{$folderName}/{$imageFilename}.jpg",
			['class' => 'img-fluid rounded-circle', 'alt' => $title]
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

