<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var language\models\SWLanguagePageSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'page_pk') ?>

    <?= $form->field($model, 'page_lang') ?>

    <?= $form->field($model, 'page_slug') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'subtitle') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'lead') ?>

    <?php // echo $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'origin_link') ?>

    <?php // echo $form->field($model, 'body_yaml') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
