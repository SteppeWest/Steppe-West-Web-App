<?php
/**
 * SWSubstitutionController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\controllers;

use common\models\SWSubstitution;
use common\models\SWSubstitutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SWSubstitutionController implements the CRUD actions for SWSubstitution model.
 */
class SWSubstitutionController extends Controller
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
	 * Lists all SWSubstitution models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new SWSubstitutionSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SWSubstitution model.
	 * @param int $pk PK
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
	 * Finds the SWSubstitution model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $pk PK
	 * @return SWSubstitution the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($pk)
	{
		if (($model = SWSubstitution::findOne(['pk' => $pk])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
