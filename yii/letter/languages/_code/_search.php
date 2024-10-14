<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SWLanguageSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'prev') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'native') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'label') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
