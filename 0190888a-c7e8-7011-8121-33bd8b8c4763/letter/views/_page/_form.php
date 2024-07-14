<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SWPage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swpage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key_pk')->textInput() ?>

    <?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'page')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subtitle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body_yaml')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
