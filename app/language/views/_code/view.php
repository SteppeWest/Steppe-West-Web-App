<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var language\models\SWLanguageBase $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="swlanguage-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'base_pk' => $model->base_pk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'base_pk' => $model->base_pk], [
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
            'base_pk',
            'base_code',
            'prev_code',
            'position',
            'name',
            'native',
            'flag_icon',
            'ui_label',
        ],
    ]) ?>

</div>
