<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LanguageFaqSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="language-faq-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'pk') ?>

	<?= $form->field($model, 'page_pk') ?>

	<?= $form->field($model, 'active') ?>

	<?= $form->field($model, 'position') ?>

	<?= $form->field($model, 'question') ?>

	<?php // echo $form->field($model, 'answer') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
