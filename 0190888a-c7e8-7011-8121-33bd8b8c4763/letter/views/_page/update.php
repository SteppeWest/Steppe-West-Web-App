<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWPage $model */

$this->title = 'Update Sw Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sw Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swpage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
