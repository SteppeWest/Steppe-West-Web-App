<?php

namespace app\controllers;

use app\models\SWLanguageShared;
use app\models\SWLanguageSharedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SWLanguageSharedController implements the CRUD actions for SWLanguageShared model.
 */
class SWLanguageSharedController extends Controller
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
     * Lists all SWLanguageShared models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SWLanguageSharedSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SWLanguageShared model.
     * @param int $pk Pk
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
     * Creates a new SWLanguageShared model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SWLanguageShared();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'pk' => $model->pk]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SWLanguageShared model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $pk Pk
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($pk)
    {
        $model = $this->findModel($pk);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pk' => $model->pk]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SWLanguageShared model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $pk Pk
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($pk)
    {
        $this->findModel($pk)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SWLanguageShared model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $pk Pk
     * @return SWLanguageShared the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pk)
    {
        if (($model = SWLanguageShared::findOne(['pk' => $pk])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
