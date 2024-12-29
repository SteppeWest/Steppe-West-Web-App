<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LanguageFaq $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="language-faq-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'page_pk')->textInput() ?>

	<?= $form->field($model, 'active')->textInput() ?>

	<?= $form->field($model, 'position')->textInput() ?>

	<?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
