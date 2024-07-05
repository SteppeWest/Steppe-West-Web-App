<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageSharedSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-shared-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'pk') ?>

	<?= $form->field($model, 'code') ?>

	<?= $form->field($model, 'locale') ?>

	<?= $form->field($model, 'lang') ?>

	<?= $form->field($model, 'origin') ?>

	<?php // echo $form->field($model, 'footer_yaml') ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
