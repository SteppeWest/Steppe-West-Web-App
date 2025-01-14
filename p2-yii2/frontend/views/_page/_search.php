<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LanguagePageSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="language-page-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'pk') ?>

	<?= $form->field($model, 'lang_pk') ?>

	<?= $form->field($model, 'page_lang') ?>

	<?= $form->field($model, 'slug') ?>

	<?= $form->field($model, 'title') ?>

	<?php // echo $form->field($model, 'subtitle') ?>

	<?php // echo $form->field($model, 'description') ?>

	<?php // echo $form->field($model, 'keywords') ?>

	<?php // echo $form->field($model, 'lead') ?>

	<?php // echo $form->field($model, 'origin') ?>

	<?php // echo $form->field($model, 'origin_link') ?>

	<?php // echo $form->field($model, 'body_content') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
