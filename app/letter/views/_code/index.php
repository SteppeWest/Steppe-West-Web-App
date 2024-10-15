<?php

use letter\models\SWLanguageCode;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageCodeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Language Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-code-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sw Language Code', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pk',
            'code',
            'prev',
            'position',
            'name',
            //'native',
            //'flag',
            //'label',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SWLanguageCode $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pk' => $model->pk]);
                 }
            ],
        ],
    ]); ?>


</div>
