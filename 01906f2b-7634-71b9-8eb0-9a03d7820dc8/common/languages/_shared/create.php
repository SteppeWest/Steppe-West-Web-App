<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageShared $model */

$this->title = Yii::t('app', 'Create Sw Language Shared');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Language Shareds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-shared-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
