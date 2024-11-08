<?php
/**
 * SwLanguagePageController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\controllers;

use \Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\Theme; // Add this to create a Theme instance
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\SwLanguagePage;
use common\models\SwLanguagePageSearch;
use common\models\SwLanguage;
use common\models\SwLanguageSearch;
use frontend\assets\SwLetterAsset;

/**
 * SwLanguagePageController implements the CRUD actions for SwLanguagePage model.
 */
class SwLanguagePageController extends Controller
{
	public function init()
	{
		parent::init();

		// Set a new Theme instance specifically for this controller
		Yii::$app->view->theme = new Theme([
			'pathMap' => [
				'@app/views' => '@app/views/letter',
			],
		]);

		// Specify the layout explicitly for this controller
		$this->layout = '@app/views/letter/layouts/main';
	}

	/**
	 * @inheritDoc
	 */
	public function behaviors()
	{
		return array_merge(
			parent::behaviors(),
			[
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
					],
				],
			]
		);
	}

	/**
	 * Lists all SwLanguagePage models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new SwLanguagePageSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SwLanguagePage model.
	 * @param int $pk Page PK
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($slug = 'intro', $lc = null)
	{
		$lc = $lc ?? Yii::$app->params['swDefaultLanguage'];

		// Retrieve the language page based on slug and language code
		$page = SwLanguagePage::find()
			->where(['slug' => $slug, 'page_lang' => $lc])
			->one();

		if (!$page) {
			throw new NotFoundHttpException('Page not found.');
		}

		// Register SwLetterAsset to pass it to the layout
		$asset = SwLetterAsset::register($this->view);

		// Retrieve the language settings from SwLanguage
		$lang = SwLanguage::find()
			->where(['lang_code' => $page->page_lang])
			->one();

		// Set Yii::$app->language if SwLanguage and html_lang are found
		if ($lang && $lang->html_lang) {
			Yii::$app->language = $lang->html_lang;
		}

		// Call createMenuItems to build the menu based on active languages
		$menuItems = $this->createMenuItems();

		$this->view->params['slug'] = $slug;
		$this->view->params['lc'] = $lc;
		$this->view->params['page'] = $page;
		$this->view->params['lang'] = $lang;
		$this->view->params['asset'] = $asset;
		$this->view->params['menuItems'] = $menuItems;

		// Render the main content view located at views/letter/site/index.php
		return $this->render('@app/views/letter/site/index');
	}

	/**
	 * Finds the SwLanguagePage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $pk Page PK
	 * @return SwLanguagePage the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($pk)
	{
		if (($model = SwLanguagePage::findOne(['pk' => $pk])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	private function getFlagIcon($flagIcon)
	{
		$codePoints = [
			127397 + ord($flagIcon[0]),
			127397 + ord($flagIcon[1])
		];
		return mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
	}

	private function createMenuItems()
	{
		// Get the current URL components
		$currentUrl = Url::current();
		$parsedUrl = parse_url($currentUrl);

		// Fetch active languages ordered by menu_position
		$languages = SwLanguage::find()
			->where(['active' => true])
			->orderBy(['menu_position' => SORT_ASC])
			->all();

		$menuItems = [];

		foreach ($languages as $language) {
			// Generate the label with the flag emoji and UI label
			$flagEmoji = $this->getFlagIcon($language->flag_icon);
			$label = $flagEmoji . ' ' . Html::encode($language->ui_label);

			// Construct the new URL path by replacing or appending the language code
			$path = isset($parsedUrl['path']) ? trim($parsedUrl['path'], '/') : '';
			$segments = explode('/', $path);

			// If `lc` is already in the URL, replace it with the current language code
			if (isset($segments[1])) {
				$segments[1] = $language->lang_code;
			} else {
				// Otherwise, append the language code as a new segment
				$segments[] = $language->lang_code;
			}

			// Reconstruct the path and generate the URL
			$newUrl = '/' . implode('/', $segments);

			// Add to menuItems
			$menuItems[] = [
				'label' => $label,
				'url' => $newUrl,
			];
		}

		return $menuItems;
	}
}
	/**
	 */
