<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageCode $model */

$this->title = 'Create Sw Language Code';
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
