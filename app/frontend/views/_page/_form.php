<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SwLanguagePage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sw-language-page-form">

	<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page_lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subtitle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lead')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'origin')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'origin_link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body_json')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
