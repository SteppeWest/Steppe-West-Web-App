<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var language\models\SWLanguageBaseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'base_pk') ?>

    <?= $form->field($model, 'base_code') ?>

    <?= $form->field($model, 'prev_code') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'native') ?>

    <?php // echo $form->field($model, 'flag_icon') ?>

    <?php // echo $form->field($model, 'ui_label') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
