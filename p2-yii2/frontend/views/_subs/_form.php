<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Substitution $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="substitution-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'external')->textInput() ?>

	<?= $form->field($model, 'social')->textInput() ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
