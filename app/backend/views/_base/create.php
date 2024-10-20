<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWLanguageBase $model */

$this->title = 'Create Sw Language Base';
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
