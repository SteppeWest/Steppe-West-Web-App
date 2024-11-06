<?php
/**
 * SWLanguageController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\controllers;

use common\models\SWLanguage;
use common\models\SWLanguageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SWLanguageController implements the CRUD actions for SWLanguage model.
 */
class SWLanguageController extends Controller
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
	 * Lists all SWLanguage models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new SWLanguageSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SWLanguage model.
	 * @param int $pk Language PK
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($pk)
	{
		return $this->render('view', [
			'model' => $this->findModel($pk),
		]);
	}

	/**
	 * Finds the SWLanguage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $pk Language PK
	 * @return SWLanguage the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($pk)
	{
		if (($model = SWLanguage::findOne(['pk' => $pk])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
