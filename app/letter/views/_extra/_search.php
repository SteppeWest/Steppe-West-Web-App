<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageExtraSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-extra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'locale') ?>

    <?= $form->field($model, 'lang') ?>

    <?= $form->field($model, 'footer_yaml') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
