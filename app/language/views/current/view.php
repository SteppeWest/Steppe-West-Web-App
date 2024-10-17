<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var language\models\SWCurrentLanguage $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sw Current Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="swcurrent-language-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'page_pk' => $model->page_pk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'page_pk' => $model->page_pk], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'page_pk',
            'page_code',
            'page_tag',
            'title:ntext',
            'subtitle:ntext',
            'description:ntext',
            'keywords:ntext',
            'lead:ntext',
            'origin:ntext',
            'origin_link:ntext',
            'body_yaml:ntext',
        ],
    ]) ?>

</div>
