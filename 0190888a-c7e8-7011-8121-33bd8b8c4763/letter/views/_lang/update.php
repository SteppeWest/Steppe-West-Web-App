<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWLanguage $model */

$this->title = 'Update Sw Language: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sw Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swlanguage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
