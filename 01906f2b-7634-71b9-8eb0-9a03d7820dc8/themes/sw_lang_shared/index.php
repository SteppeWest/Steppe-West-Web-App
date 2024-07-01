<?php

use app\models\SWLanguageShared;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageSharedSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Sw Language Shareds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-shared-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sw Language Shared'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pk',
            'code:ntext',
            'locale:ntext',
            'lang:ntext',
            'origin:ntext',
            //'footer_yaml:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SWLanguageShared $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pk' => $model->pk]);
                 }
            ],
        ],
    ]); ?>


</div>
