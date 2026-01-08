<?php
/**
 * @backend/views/settings/account.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use p2m\helpers\BI;

/**
 * @var yii\web\View               $this
 * @var yii\widgets\ActiveForm     $form
 * @var \Da\User\Form\SettingsForm $model
 */

$this->title = Yii::t('admin.settings', 'Account Settings');
$this->params['breadcrumbs'][] = $this->title;

/** @var \Da\User\Module $module */
$module = Yii::$app->getModule('user');
?>

<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>
</div>

<?= $this->render('/partials/breadcrumbs') ?>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="card">
	<div class="card-header">
		<?= $this->render('/partials/user-menu') ?>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<?= $this->render('/partials/user-gravatar') ?>
			</div>
			<div class="col-md-9" id="sw-user-settings">
				<!-- BEGIN USER FORM CONTENT -->

				<?php $form = ActiveForm::begin([
					'id' => $model->formName(),
					'layout' => 'horizontal',
					'enableAjaxValidation' => true,
					'enableClientValidation' => false,
					'validateOnBlur' => false,
					// Label column width + nowrap
					'fieldConfig' => [
						'labelOptions' => [
							'class' => 'col-sm-4 col-form-label text-sm-end sw-form-label',
						],
						'wrapperOptions' => [
							'class' => 'col-sm-8',
						],
						'template' => "{label}\n<div class=\"col-sm-8\">{input}\n{hint}\n{error}</div>",
					],
				]); ?>

				<?= $form->field($model, 'email') ?>

				<?= $form->field($model, 'username') ?>

				<?= $form->field($model, 'new_password')->passwordInput() ?>

				<?= $form->field($model, 'current_password')->passwordInput() ?>

				<div class="form-group">
					<div class="offset-sm-2 col-lg-10">
						<div class="d-grid">
							<?= Html::submitButton(
								Yii::t('admin', 'Save'),
								['class' => 'btn btn-success']
							) ?>
						</div>
					</div>
				</div>

				<?php ActiveForm::end(); ?>
				<!-- / END USER FORM CONTENT -->

				<?php if ($module->enableTwoFactorAuthentication): ?>
					<div class="card  mt-4">
						<div class="card-header">
							<h3 class="m-0"><?= Yii::t('admin.settings', 'Two Factor Authentication (2FA)') ?></h3>
						</div>
						<div class="card-body">
							<p>
								<?= Yii::t('admin.settings', 'Two factor authentication protects you in case of stolen credentials') ?>.
							</p>
							<?php if ($model->getUser()!==  null && !$model->getUser()->auth_tf_enabled):
								$validators = $module->twoFactorAuthenticationValidators;
								$theFirstFound = false;
								$checked = '';
								foreach( $validators as $name => $validator ) {
									if($validator[ "enabled" ]){
										// I want to check in the radio field the first validator I get
										if(!$theFirstFound){
											$checked = 'checked';
											$theFirstFound = true;
										}
										$description = $validator[ "description" ];
										?>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="2famethod" id="<?= $name?>" value="<?= $name?>" <?= $checked?>>
											<label class="form-check-label" for="<?= $name?>">
												<?= $description?>
											</label>
											</div>
										<?php
										$checked = '';
									}
								} ;
							?>

								<?php
								Modal::begin([
									'id' => 'tfmodal',
									'title' =>Yii::t('admin.settings', 'Two Factor Authentication (2FA)'),
									'toggleButton' => [
										'id' => 'enable_tf_btn',
										'label' => Yii::t('admin.settings', 'Enable two factor authentication'),
										'class' => 'btn btn-light',
									],
								]);
								?>
								...
								<?php Modal::end(); ?>

							<?php else:
								 ?>
									<p>
										<?php
											$method = $model->getUser()->auth_tf_type;
											$message = '';
											switch ($method) {
												case 'email':
													$message = Yii::t('admin.settings', 'The email address set is: "{0}".', [ $model->getUser()->email] );
													break;
												case 'sms':
													$message = Yii::t('admin.settings', 'The phone number set is: "{0}".', [ $model->getUser()->auth_tf_mobile_phone]);
													break;
											}
										?>
										<?= Yii::t('admin.settings', 'Your two factor authentication method is based on "{0}".', [$method]) . ' account.php' . $message ?>
									</p>
									<div class="text-right">
									<?= Html::a(
										Yii::t('admin.settings', 'Disable two factor authentication'),
										['two-factor-disable', 'id' => $model->getUser()->id],
										[
											'id' => 'disable_tf_btn',
											'class' => 'btn btn-light ',
											'data-method' => 'post',
											'data-confirm' => Yii::t('admin.settings', 'This will disable two factor authentication. Are you sure?'),
										]
									) ?>
								   </div>
							<?php
							endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ($model->module->allowAccountDelete): ?>
					<div class="card bg-danger mt-4">
						<div class="card-header">
							<h3 class="m-0"><?= Yii::t('admin.settings', 'Delete account') ?></h3>
						</div>
						<div class="card-body">
							<p>
								<?= Yii::t('admin.settings', 'Once you delete your account, there is no going back') ?>.
								<?= Yii::t('admin.settings', 'It will be deleted forever') ?>.
								<?= Yii::t('admin.settings', 'Please be certain') ?>.
							</p>
							<div class="text-right">
								<?= Html::a(
									Yii::t('admin.settings', 'Delete account'),
									['delete'],
									[
										'class' => 'btn btn-light',
										'data-method' => 'post',
										'data-confirm' => Yii::t('admin.settings', 'Are you sure? There is no going back'),
									]
								) ?>
							</div>
						</div>
					</div>
				<?php endif ?>

			</div>
		</div>
	</div>

</div>
<?php if ($module->enableTwoFactorAuthentication): ?>
	<?php
	// This script should be in fact in a module as an external file
	// consider overriding this view and include your very own approach
	$uri = Url::to(['two-factor', 'id' => $model->getUser()->id]);
	$verify = Url::to(['two-factor-enable', 'id' => $model->getUser()->id]);
	$mobilePhoneRegistration = Url::to(['two-factor-mobile-phone', 'id' => $model->getUser()->id]);
	$js = <<<JS
	var choice = '';
	$('#tfmodal')
	.on('show.bs.modal', function(){
		console.log("show");
		var element = document.getElementsByName('2famethod');
		for(i = 0; i < element.length; i++) {
			if(element[i].checked)
				choice = element[i].value;
		}
		if(!$('img#qrCode').length) {
			$(this).find('.modal-body').load('{$uri}', {choice: choice});
		} else {
			$('input#tfcode').val('');
		}
	});



$(document)
	.on('click', '.btn-submit-code', function(e) {
		e.preventDefault();
		var btn = $(this);
		btn.prop('disabled', true);
		var choice = '';
		var element = document.getElementsByName('2famethod');
		for(i = 0; i < element.length; i++) {
			if(element[i].checked)
				choice = element[i].value;
		}

		$.getJSON('{$verify}', {code: $('#tfcode').val(), choice: choice}, function(data){
			btn.prop('disabled', false);
			if(data.success) {
				$('#enable_tf_btn, #disable_tf_btn').toggleClass('hide');
				$('#tfmessage').removeClass('alert-danger').addClass('alert-success').find('p').text(data.message);
				setTimeout(function() { $('#tfmodal').modal('hide'); }, 2000);
				window.location.reload();
			} else {
				$('input#tfcode').val('');
				$('#tfmessage').removeClass('alert-info').addClass('alert-danger').find('p').text(data.message);
			}
		}).fail(function(){ btn.prop('disabled', false); });
	})
	.on('click', '.btn-submit-mobile-phone', function(e) {
		e.preventDefault();
		var btn = $(this);
		btn.prop('disabled', true);

		$.getJSON('{$mobilePhoneRegistration}', {mobilephone: $('#mobilephone').val()}, function(data){
			btn.prop('disabled', false);
			if(data.success) {
				btn.prop('disabled', true);
				$('#smssection').toggleClass('hide');
				$('#sendnewcode').toggleClass('hide');
				$('#tfmessagephone').removeClass('alert-danger').addClass('alert-success').find('p').text(data.message);
			} else {
				$('input#phonenumber').val('');
				$('#tfmessagephone').removeClass('alert-info').addClass('alert-danger').find('p').text(data.message);
			}
		}).fail(function(){ btn.prop('disabled', false); });

	})
JS;

	$this->registerJs($js);
	?>
<?php endif; ?>
