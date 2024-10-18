<?php

namespace language\controllers;

use language\models\SWLanguagePage;
use language\models\SWLanguagePageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
						'delete' => ['POST'],
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
	 * @param int $page_pk Page PK
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($page_pk)
	{
		return $this->render('view', [
			'model' => $this->findModel($page_pk),
		]);
	}

	/**
	 * Creates a new SWLanguagePage model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return string|\yii\web\Response
	 */
	public function actionCreate()
	{
		$model = new SWLanguagePage();

		if ($this->request->isPost) {
			if ($model->load($this->request->post()) && $model->save()) {
				return $this->redirect(['view', 'page_pk' => $model->page_pk]);
			}
		} else {
			$model->loadDefaultValues();
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing SWLanguagePage model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param int $page_pk Page PK
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($page_pk)
	{
		$model = $this->findModel($page_pk);

		if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
			return $this->redirect(['view', 'page_pk' => $model->page_pk]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing SWLanguagePage model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param int $page_pk Page PK
	 * @return \yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($page_pk)
	{
		$this->findModel($page_pk)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the SWLanguagePage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $page_pk Page PK
	 * @return SWLanguagePage the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($page_pk)
	{
		if (($model = SWLanguagePage::findOne(['page_pk' => $page_pk])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
