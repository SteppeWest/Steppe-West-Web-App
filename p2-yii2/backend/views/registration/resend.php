<?php
/**
 * @backend/views/registration/resend.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

// Ensure we use the auth layout even if controller forgot (belt + braces)
$this->context->layout = 'alternate';

$this->title = Yii::t('usuario', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<div id="form-wrapper">
	<h3 class="login-heading mb-4"><?= Html::encode($this->title) ?></h3>
	<?php $form = ActiveForm::begin(
		[
			'id' => $model->formName(),
			'enableAjaxValidation' => true,
			'enableClientValidation' => false,
		]
	); ?>

	<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

	<?= Html::submitButton(
		Yii::t('usuario', 'Continue'), [
			'class' => 'btn btn-primary btn-login text-uppercase fw-bold mb-2 w-100'
		]
	) ?>

	<?php ActiveForm::end(); ?>
</div>
