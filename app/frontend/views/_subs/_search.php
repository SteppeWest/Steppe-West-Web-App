<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\SubstitutionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="substitution-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    <?= $form->field($model, 'pk') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'external') ?>

    <?php // echo $form->field($model, 'social') ?>

    <?php // echo $form->field($model, 'description') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
