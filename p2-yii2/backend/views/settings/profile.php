<?php
/**
 * @backend/views/settings/profile.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use Da\User\Helper\TimezoneHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use p2m\helpers\BI;

/**
 * @var yii\web\View           $this
 * @var yii\widgets\ActiveForm $form
 * @var \Da\User\Model\Profile $model
 * @var TimezoneHelper         $timezoneHelper
 */

$this->title = Yii::t('admin.settings', 'Profile Settings');
$this->params['breadcrumbs'][] = $this->title;
$timezoneHelper = $model->make(TimezoneHelper::class);

/**
$attributeLabels = [
	'username'            => Yii::t('admin', 'Username'),
	'email'               => Yii::t('admin', 'Email'),

	// Account / security related
	'password'            => Yii::t('admin.settings', 'Password'),
	'unconfirmed_email'   => Yii::t('admin.settings', 'New Email'),

	// Audit / system fields (admin-wide)
	'registration_ip'     => Yii::t('admin', 'Registration IP'),
	'created_at'          => Yii::t('admin', 'Created'),
	'confirmed_at'        => Yii::t('admin.rbac', 'Confirmed'),
	'last_login_at'       => Yii::t('admin', 'Last Login'),
	'last_login_ip'       => Yii::t('admin', 'Last Login IP'),

	// Optional / advanced (can be hidden in UI)
	'password_changed_at' => Yii::t('admin.settings', 'Password Changed'),
	'password_age'        => Yii::t('admin.settings', 'Password Age'),

	'user_id'    => Yii::t('admin.audit', 'User'),
	'session_id' => Yii::t('admin.audit', 'Session'),
	'user_agent' => Yii::t('admin.audit', 'User Agent'),
	'ip'         => Yii::t('admin.audit', 'IP Address'),
	'created_at' => Yii::t('admin.audit', 'Started'),
	'updated_at' => Yii::t('admin.audit', 'Last Activity'),

	'name'           => Yii::t('admin',          'Name'),
	'public_email'   => Yii::t('admin.settings', 'Public Email'),
	'website'        => Yii::t('admin.settings', 'Website'),
	'location'       => Yii::t('admin.settings', 'Location'),
	'timezone'       => Yii::t('admin.settings', 'Timezone'),
	'gravatar_email' => Yii::t('admin.settings', 'Gravatar Email'),
	'bio'            => Yii::t('admin.settings', 'Bio'),
];
 */
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

				<?= $form->field($model, 'name') ?>

				<?= $form->field($model, 'public_email') ?>

				<?= $form->field($model, 'website') ?>

				<?= $form->field($model, 'location') ?>

				<?= $form
					->field($model, 'timezone')
					->dropDownList(ArrayHelper::map($timezoneHelper->getAll(), 'timezone', 'name'));
				?>
				<?= $form
					->field($model, 'gravatar_email')
					->hint(
						Html::a(
							Yii::t('admin.settings', 'Change your avatar at Gravatar.com'),
							'https://gravatar.com',
							['target' => '_blank']
						)
					) ?>

				<?= $form->field($model, 'bio')->textarea() ?>

				<div class="form-group">
					<div class="offset-sm-2 col-lg-10">
						<div class="d-grid">
							<?= Html::submitButton(
								Yii::t('admin', 'Save'),
								['class' => 'btn btn-success']
							) ?>
						</div>
						<br>
					</div>
				</div>

				<?php ActiveForm::end(); ?>
				<!-- / END USER FORM CONTENT -->
			</div>
		</div>
	</div>
</div>
