<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageCode $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'native')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'flag')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'label')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
