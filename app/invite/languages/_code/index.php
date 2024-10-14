<?php

use common\models\SWLanguage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SWLanguageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Languages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sw Language', ['create'], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, SWLanguage $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pk' => $model->pk]);
                 }
            ],
        ],
    ]); ?>


</div>
