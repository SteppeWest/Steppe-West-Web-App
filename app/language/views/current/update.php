<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var language\models\SWCurrentLanguage $model */

$this->title = 'Update Sw Current Language: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sw Current Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'page_pk' => $model->page_pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swcurrent-language-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
