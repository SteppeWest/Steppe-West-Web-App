<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWPage $model */

$this->title = 'Create Sw Page';
$this->params['breadcrumbs'][] = ['label' => 'Sw Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swpage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
