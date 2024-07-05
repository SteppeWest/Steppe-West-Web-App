<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SWLanguagePageSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-page-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'pk') ?>

	<?= $form->field($model, 'code') ?>

	<?= $form->field($model, 'page') ?>

	<?= $form->field($model, 'title') ?>

	<?= $form->field($model, 'subtitle') ?>

	<?php // echo $form->field($model, 'description') ?>

	<?php // echo $form->field($model, 'keywords') ?>

	<?php // echo $form->field($model, 'lead') ?>

	<?php // echo $form->field($model, 'body_yaml') ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
