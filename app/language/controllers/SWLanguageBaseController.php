<?php

namespace language\controllers;

use language\models\SWLanguageBase;
use language\models\SWLanguageBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SWLanguageBaseController implements the CRUD actions for SWLanguageBase model.
 */
class SWLanguageBaseController extends Controller
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
     * Lists all SWLanguageBase models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SWLanguageBaseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SWLanguageBase model.
     * @param int $lang_pk Language PK
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($lang_pk)
    {
        return $this->render('view', [
            'model' => $this->findModel($lang_pk),
        ]);
    }

    /**
     * Creates a new SWLanguageBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SWLanguageBase();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'lang_pk' => $model->lang_pk]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SWLanguageBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $lang_pk Language PK
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($lang_pk)
    {
        $model = $this->findModel($lang_pk);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lang_pk' => $model->lang_pk]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SWLanguageBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $lang_pk Language PK
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($lang_pk)
    {
        $this->findModel($lang_pk)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SWLanguageBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $lang_pk Language PK
     * @return SWLanguageBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($lang_pk)
    {
        if (($model = SWLanguageBase::findOne(['lang_pk' => $lang_pk])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
