<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap5\Alert;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var \yii\web\View $this */
/** @var string[] $availableItems */
/** @var Da\User\Model\Assignment $model */


?>

<?php if ($model->updated): ?>

	<?= Alert::widget(
		[
			'options' => [
				'class' => 'alert-success',
			],
			'body' => Yii::t('usuario', 'Assignments have been updated'),
		]
	) ?>

<?php endif ?>

<?php $form = ActiveForm::begin(
	[
		'enableClientValidation' => false,
		'enableAjaxValidation' => false,
	]
) ?>

<?= Html::activeHiddenInput($model, 'user_id') ?>

<?= $form->field($model, 'items')->listBox(
	$availableItems,
	[
		'multiple' => true,
		// optional: control height
		'size' => min(15, max(5, count($availableItems))),
		'class' => 'form-select', // Bootstrap 5 styling
	]
) ?>
<div class="d-grid gap-2">
	<?= Html::submitButton(Yii::t('usuario', 'Update assignments'), ['class' => 'btn btn-success  mt-3']) ?>
</div>
<?php ActiveForm::end() ?>
