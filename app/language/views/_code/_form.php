<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var language\models\SWLanguageBase $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'base_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prev_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'native')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag_icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ui_label')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
