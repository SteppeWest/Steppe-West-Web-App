<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageShared $model */

$this->title = Yii::t('app', 'Update Sw Language Shared: {name}', [
    'name' => $model->pk,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Language Shareds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="swlanguage-shared-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
