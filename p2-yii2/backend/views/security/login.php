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
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use Da\User\Widget\ConnectWidget;
use common\helpers\SwLanguageUiHelper;
use p2m\helpers\FI;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

// Belt + braces (prefer setting this in SwSecurityController)
$this->context->layout = 'auth';

$appName = Yii::$app->name;
$pageTitle = Yii::t('sw', 'Login');
$this->title = $appName . ' – ' . $pageTitle;

// Nice for screen readers + browser tabs
$this->params['breadcrumbs'] = []; // ensure no crumbs on auth pages, if relevant
?>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="site-login" role="main" aria-label="<?= Html::encode($pageTitle) ?>">

	<?= SwLanguageUiHelper::buttonGroup([
		'languages' => Yii::$app->params['swUiLanguages'],
	]) ?>

	<div class="card shadow-sm">

		<div class="card-header">
			<h1 class="fs-3 mb-1 text-center">
				<?= Html::encode($this->title) ?>
			</h1>
		</div>

		<div class="card-body">

			<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

			<!-- your form goes here -->
			<?php $form = ActiveForm::begin([
				'id' => $model->formName(),
				'enableAjaxValidation'   => true,
				'enableClientValidation' => false,
				'validateOnBlur'         => false,
				'validateOnType'         => false,
				'validateOnChange'       => false,
			]); ?>

			<?= $form->field($model, 'login', [
				'inputOptions' => [
					'autofocus'    => true,
					'class'        => 'form-control',
					'tabindex'     => 1,
					'autocomplete' => 'username',
					'aria-label'   => Yii::t('sw', 'Username or Email'),
				],
			])->label(Yii::t('sw', 'Username or Email')) ?>

			<?php
				$forgotUrl = Url::to(['/user/recovery/request']);
				$forgotLink = $module->allowPasswordRecovery
					? Html::a(
						Yii::t('sw', 'Forgot password?'),
						$forgotUrl,
						['tabindex' => 5]
					)
					: '';
			?>

			<?= $form->field($model, 'password', [
				'inputOptions' => [
					'class'        => 'form-control',
					'tabindex'     => 2,
					'autocomplete' => 'current-password',
					'aria-label'   => Yii::t('sw', 'Password'),
				],
			])->passwordInput()
			  ->label(Yii::t('sw', 'Password'))
			  ->hint($forgotLink, ['class' => 'form-text']) ?>

			<?= $form->field($model, 'rememberMe')->checkbox([
				'tabindex' => 4,
				'label' => Yii::t('sw', 'Remember me next time'),
			]) ?>

			<?= Html::submitButton(Yii::t('sw', 'Login'), [
				'class' => 'btn btn-primary btn-login text-uppercase fw-bold mb-2 w-100',
				'tabindex' => 3,
				'aria-label' => Yii::t('sw.a11y', 'Submit login form'),
			]) ?>

			<?php ActiveForm::end(); ?>

			<hr class="my-4">

			<?php if ($module->enableEmailConfirmation): ?>
				<p class="text-center mb-3">
					<?= Html::a(
						Yii::t('sw', 'Didn’t receive a confirmation message?'),
						['/user/registration/resend'],
						['aria-label' => Yii::t('sw.a11y', 'Resend confirmation email')]
					) ?>
				</p>
			<?php endif; ?>

			<?= ConnectWidget::widget([
				'baseAuthUrl' => ['/user/security/auth'],
			]) ?>

		</div>
	</div>
</div>


