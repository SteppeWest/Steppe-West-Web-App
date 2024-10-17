<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var language\models\SWLanguageExtra $model */

$this->title = 'Update Sw Language Extra: ' . $model->extra_pk;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->extra_pk, 'url' => ['view', 'extra_pk' => $model->extra_pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swlanguage-extra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
