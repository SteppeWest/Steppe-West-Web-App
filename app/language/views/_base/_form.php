<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var language\models\SWLanguageBase $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-base-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'lang_code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'prev_code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'menu_position')->textInput() ?>

	<?= $form->field($model, 'active')->textInput() ?>

	<?= $form->field($model, 'lang_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'native_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'flag_icon')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'ui_label')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'locale')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'html_lang')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'footer_yaml')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
