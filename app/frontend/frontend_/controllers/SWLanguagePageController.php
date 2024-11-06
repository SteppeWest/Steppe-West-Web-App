<?php
/**
 * SWLanguagePageController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SWLanguagePage;
use common\models\SWLanguagePageSearch;

/**
 * SWLanguagePageController implements the CRUD actions for SWLanguagePage model.
 */
class SWLanguagePageController extends Controller
{
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
	 * Lists all SWLanguagePage models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new SWLanguagePageSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SWLanguagePage model.
	 * @param int $pk Page PK
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	public function actionView($pk)
	{
		return $this->render('view', [
			'model' => $this->findModel($pk),
		]);
	}
	 */
	public function actionView($slug = 'intro', $lc = null)
	{
		// Sample content for testing purposes
		//return "This is the SWLanguagePage view action.";
    	return "SWLanguagePageController is working.";

	/**
		$lc = $lc ?? Yii::$app->params['swDefaultLanguage'];

		// Retrieve the language page based on slug and language code
		$page = SWLanguagePage::find()
			->where(['slug' => $slug, 'page_lang' => $lc])
			->one();

		if (!$page) {
			throw new NotFoundHttpException('Page not found.');
		}

		// Render the view from sw-language-page
		return $this->render('//sw-language-page/view', ['page' => $page]);
	 */
	}

	/**
	 * Finds the SWLanguagePage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $pk Page PK
	 * @return SWLanguagePage the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($pk)
	{
		if (($model = SWLanguagePage::findOne(['pk' => $pk])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
