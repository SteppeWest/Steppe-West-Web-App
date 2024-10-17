<?php

use language\models\SWCurrentLanguage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var language\models\SWCurrentLanguageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Current Languages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swcurrent-language-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sw Current Language', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'page_pk',
            'page_code',
            'page_tag',
            'title:ntext',
            'subtitle:ntext',
            //'description:ntext',
            //'keywords:ntext',
            //'lead:ntext',
            //'origin:ntext',
            //'origin_link:ntext',
            //'body_yaml:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SWCurrentLanguage $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'page_pk' => $model->page_pk]);
                 }
            ],
        ],
    ]); ?>


</div>
