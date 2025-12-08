<?php
/**
 * @backend/views/admin/_account.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Da\User\Model\User $user */
/** @var \Da\User\Module $module */
?>

<?php $this->beginContent($module->viewPath. '/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin(
	[
		'layout' => 'horizontal',
		'enableAjaxValidation' => true,
		'enableClientValidation' => false,
	]
); ?>

<?= $this->render('/admin/_user', ['form' => $form, 'user' => $user]) ?>

<div class="form-group">
	<div class="offset-sm-2 col-lg-10">
		<div class="d-grid">
			<?= Html::submitButton(
				Yii::t('usuario', 'Update'),
				['class' => 'btn btn-success']
			) ?>
		</div>
	</div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
