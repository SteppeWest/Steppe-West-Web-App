<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SWCurrentLanguage $model */

$this->title = Yii::t('app', 'Update Sw Current Language: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Current Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="swcurrent-language-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
