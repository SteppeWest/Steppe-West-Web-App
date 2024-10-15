<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageExtra $model */

$this->title = 'Create Sw Language Extra';
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-extra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
