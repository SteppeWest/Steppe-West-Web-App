<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SWLanguageBaseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk') ?>

    <?= $form->field($model, 'lang_code') ?>

    <?= $form->field($model, 'prev_code') ?>

    <?= $form->field($model, 'menu_position') ?>

    <?= $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'lang_name') ?>

    <?php // echo $form->field($model, 'native_name') ?>

    <?php // echo $form->field($model, 'flag_icon') ?>

    <?php // echo $form->field($model, 'ui_label') ?>

    <?php // echo $form->field($model, 'locale') ?>

    <?php // echo $form->field($model, 'html_lang') ?>

    <?php // echo $form->field($model, 'footer_json') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
