<?php
/**
 * @backend/views/security/login.php
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
use Da\User\Widget\ConnectWidget;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

// Ensure we use the auth layout even if controller forgot (belt + braces)
$this->context->layout = 'auth';

$this->title = Yii::t('usuario', 'Steppe West HQ – Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<div class="site-login">
	<div class="mt-5 offset-lg-3 col-lg-6">
		<h1><?= Html::encode($this->title) ?></h1>

		<!-- Sign In Form -->
		<?php $form = ActiveForm::begin([
			'id' => $model->formName(),
			'enableAjaxValidation'   => true,
			'enableClientValidation' => false,
			'validateOnBlur'         => false,
			'validateOnType'         => false,
			'validateOnChange'       => false,
		]) ?>

		<?= $form->field($model, 'login', ['inputOptions' => [
			'autofocus' => 'autofocus',
			'class' => 'form-control',
			'tabindex' => '1']
		]) ?>

		<?= $form->field($model, 'password', ['inputOptions' => [
			'class' => 'form-control',
			'tabindex' => '2'
		]])->passwordInput()->label(Yii::t('usuario', 'Password')
			. ($module->allowPasswordRecovery ? ' ('
			. Html::a(Yii::t('usuario', 'Forgot password?'),
			['/user/recovery/request'],
			['tabindex' => '5']
		) . ')' : '')) ?>

		<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

		<?= Html::submitButton(Yii::t('usuario', 'Sign in'), [
			'class' => 'btn btn-primary btn-login text-uppercase fw-bold mb-2 w-100',
			'tabindex' => '3'
		]) ?>

		<?php ActiveForm::end(); ?>

		<hr>

		<?php if ($module->enableEmailConfirmation): ?>
			<p class="text-center">
				<?= Html::a(
					Yii::t('usuario', 'Didn\'t receive confirmation message?'),
					['/user/registration/resend']
				) ?>
			</p>
		<?php endif ?>
		<?= ConnectWidget::widget([
			'baseAuthUrl' => ['/user/security/auth'],
		]) ?>

	</div>
</div>

<div id="form-wrapper">
	<h3 class="login-heading mb-4"><?= Html::encode($this->title) ?></h3>

</div>




<?php
/**
 * @backend/views/site/login.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div class="site-login">
	<div class="mt-5 offset-lg-3 col-lg-6">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please fill out the following fields to login:</p>

		<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

			<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

			<?= $form->field($model, 'password')->passwordInput() ?>

			<?= $form->field($model, 'rememberMe')->checkbox() ?>

			<div class="form-group">
				<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
