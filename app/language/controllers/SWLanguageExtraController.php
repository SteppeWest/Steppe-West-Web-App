<?php

namespace language\controllers;

use language\models\SWLanguageExtra;
use language\models\SWLanguageExtraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SWLanguageExtraController implements the CRUD actions for SWLanguageExtra model.
 */
class SWLanguageExtraController extends Controller
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
     * Lists all SWLanguageExtra models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SWLanguageExtraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SWLanguageExtra model.
     * @param int $extra_pk Extra PK
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($extra_pk)
    {
        return $this->render('view', [
            'model' => $this->findModel($extra_pk),
        ]);
    }

    /**
     * Creates a new SWLanguageExtra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SWLanguageExtra();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'extra_pk' => $model->extra_pk]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SWLanguageExtra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $extra_pk Extra PK
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($extra_pk)
    {
        $model = $this->findModel($extra_pk);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'extra_pk' => $model->extra_pk]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SWLanguageExtra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $extra_pk Extra PK
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($extra_pk)
    {
        $this->findModel($extra_pk)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SWLanguageExtra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $extra_pk Extra PK
     * @return SWLanguageExtra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($extra_pk)
    {
        if (($model = SWLanguageExtra::findOne(['extra_pk' => $extra_pk])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
