<?php
/**
 * @backend/views/admin/_profile.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/**
 * @var yii\web\View           $this
 * @var \Da\User\Model\User    $user
 * @var \Da\User\Model\Profile $profile
 * @var \Da\User\Module $module
 */
?>

<?php $this->beginContent($module->viewPath. '/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin(
	[
		'layout' => 'horizontal',
		'enableAjaxValidation' => true,
		'enableClientValidation' => false,
	]
); ?>

<?= $form->field($profile, 'name') ?>
<?= $form->field($profile, 'public_email') ?>
<?= $form->field($profile, 'website') ?>
<?= $form->field($profile, 'location') ?>
<?= $form->field($profile, 'gravatar_email') ?>
<?= $form->field($profile, 'bio')->textarea() ?>


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
