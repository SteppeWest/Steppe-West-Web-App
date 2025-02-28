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
use common\widgets\SwSubstitution;
use common\widgets\SwYaml;
use common\models\LanguagePage;
use common\models\LanguageFaq;
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

		// Fetch the FAQ content for the invite page
		if ($slug === 'invite') {
			$faq = $this->processFaqContent($lc);
		}

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
		$rawContent = SwYaml::parseYamlItem($page->body_content);
		$this->view->params['bodyContent'] = $this->processBodyContent($rawContent, $letterAsset);

		// Pass the FAQ to the view
		$faq = $this->processFaqContent($page->pk);
		$this->view->params['faq'] = $faq;

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

	/**
	 * Custom functions
	 */

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

	protected function processBodyContent(array $rawContent, LetterAsset $letterAsset): ?array
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
		foreach ($rawContent as $contentItem) {
			if (!is_array($contentItem)) {
				continue;
			}

			$processedContent[] = [
				'content' => $this->processContentItem($contentItem),
				'image' => $this->addCircleImage($letterAsset, $circleFolders, $folderIndex),
			];
		}

		return $processedContent;
	}

	protected function processContentItem(array $contentItem): string
	{
		$htmlContent = '';

		// Loop through each nested item
		foreach ($contentItem as $key => $text) {
			// Process each key-value pair within the nested item
			if ($key === 'heading') {
				$htmlContent .= Html::tag('h4', $text);
			}
			elseif ($key === 'lead') {
				$htmlContent .= Html::tag('p', $text, ['class' => 'lead']);
			}
			else {
				$htmlContent .= Html::tag('p', $text);
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

	protected function processFaqContent($pagePk): ?array
	{
		// Fetch FAQ records from the LanguageFaq model
		$faqRecords = LanguageFaq::find()
			->where(['page_pk' => $pagePk, 'active' => 1]) // Filter by page_id and active status
			->orderBy(['position' => SORT_ASC]) // Optional: If there's an `order` column
			->all();

		// If no records found, return null
		if (empty($faqRecords)) {
			return null;
		}

		$faqHtml = '<div class="accordion accordion-flush" id="innerFAQaccordion">';

		// Process each FAQ record
		foreach ($faqRecords as $index => $faq) {
			$faqHtml .= $this->processFaqItem($index, $faq);
		}

		$faqHtml .= '</div>';

		// Use a generic title or dynamically set from some source
		$faqTitle = 'Frequently Asked Questions';

		return [
			'title' => $faqTitle,
			'content' => $faqHtml,
		];
	}

	protected function processFaqItem(int $index, LanguageFaq $faq): string
	{
		$id = 'faqItem' . $index;
		$collapsed = $index === 0 ? '' : ' collapsed';
		$show = $index === 0 ? ' show' : '';

		$faqHtml = '<div class="accordion-item">';
		$faqHtml .= '<h4 class="accordion-header">';
		$faqHtml .= '<button class="accordion-button';
		$faqHtml .= $collapsed;
		$faqHtml .= ' fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#';
		$faqHtml .= $id;
		$faqHtml .= '" aria-expanded="false" aria-controls="';
		$faqHtml .= $id;
		$faqHtml .= '"><i class="bi bi-play-fill"></i>&nbsp;';
		$faqHtml .= Html::encode($faq->question); // Escape question text
		$faqHtml .= '</button>';
		$faqHtml .= '</h4>';
		$faqHtml .= '<div id="';
		$faqHtml .= $id;
		$faqHtml .= '" class="accordion-collapse collapse';
		$faqHtml .= $show;
		$faqHtml .= '" data-bs-parent="#innerFAQaccordion">';
		$faqHtml .= '<div class="accordion-body p-0">'; // Remove padding with Bootstrap class
		$faqHtml .= SwSubstitution::applySubstitutions($faq->answer);
		$faqHtml .= '</div>';
		$faqHtml .= '</div>';
		$faqHtml .= '</div>';

		return $faqHtml;
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

