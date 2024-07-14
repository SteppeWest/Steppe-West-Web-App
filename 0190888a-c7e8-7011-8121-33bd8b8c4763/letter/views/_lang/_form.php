<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SWLanguage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'native')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'locale')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lang')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'flag')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'label')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'origin')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'footer_yaml')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
