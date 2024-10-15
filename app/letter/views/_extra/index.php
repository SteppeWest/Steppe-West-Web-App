<?php

use letter\models\SWLanguageExtra;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageExtraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Language Extras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-extra-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sw Language Extra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pk',
            'code',
            'locale',
            'lang',
            'footer_yaml:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SWLanguageExtra $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pk' => $model->pk]);
                 }
            ],
        ],
    ]); ?>


</div>
