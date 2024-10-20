<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWCurrentLanguage $model */

$this->title = 'Update Sw Current Language: ' . $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Sw Current Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swcurrent-language-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
