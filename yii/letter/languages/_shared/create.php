<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWLanguageShared $model */

$this->title = 'Create Sw Language Shared';
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Shareds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-shared-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
