<?php
/**
 * LanguagePageController.php
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
use common\models\LanguagePage;
use common\models\LanguagePageSearch;

/**
 * LanguagePageController implements the CRUD actions for LanguagePage model.
 */
class LanguagePageController extends Controller
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
	 * Lists all LanguagePage models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new LanguagePageSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single LanguagePage model.
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
		return "This is the LanguagePage view action.";
    	//return "LanguagePageController is working.";

	/**
		$lc = $lc ?? Yii::$app->params['swDefaultLanguage'];

		// Retrieve the language page based on slug and language code
		$page = LanguagePage::find()
			->where(['slug' => $slug, 'page_lang' => $lc])
			->one();

		if (!$page) {
			throw new NotFoundHttpException('Page not found.');
		}

		// Render the view from language-page
		return $this->render('//language-page/view', ['page' => $page]);
	 */
	}

	/**
	 * Finds the LanguagePage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $pk Page PK
	 * @return LanguagePage the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($pk)
	{
		if (($model = LanguagePage::findOne(['pk' => $pk])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
