<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageCodeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-code-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'pk') ?>

	<?= $form->field($model, 'code') ?>

	<?= $form->field($model, 'position') ?>

	<?= $form->field($model, 'name') ?>

	<?= $form->field($model, 'native') ?>

	<?php // echo $form->field($model, 'flag') ?>

	<?php // echo $form->field($model, 'label') ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
