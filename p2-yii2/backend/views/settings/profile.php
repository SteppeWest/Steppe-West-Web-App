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
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use p2m\helpers\BI;

/**
 * @var yii\web\View           $this
 * @var yii\widgets\ActiveForm $form
 * @var \Da\User\Model\Profile $model
 * @var TimezoneHelper         $timezoneHelper
 */

$this->title = Yii::t('sw', 'Profile Settings');
$this->params['breadcrumbs'][] = $this->title;
$timezoneHelper = $model->make(TimezoneHelper::class);

/**
$attributeLabels = [
	'username'            => Yii::t('sw', 'Username'),
	'email'               => Yii::t('sw', 'Email'),

	// Account / security related
	'password'            => Yii::t('sw', 'Password'),
	'unconfirmed_email'   => Yii::t('sw', 'New Email'),

	// Audit / system fields (admin-wide)
	'registration_ip'     => Yii::t('sw', 'Registration IP'),
	'created_at'          => Yii::t('sw', 'Created'),
	'confirmed_at'        => Yii::t('sw', 'Confirmed'),
	'last_login_at'       => Yii::t('sw', 'Last Login'),
	'last_login_ip'       => Yii::t('sw', 'Last Login IP'),

	// Optional / advanced (can be hidden in UI)
	'password_changed_at' => Yii::t('sw', 'Password Changed'),
	'password_age'        => Yii::t('sw', 'Password Age'),

	'user_id'    => Yii::t('sw', 'User'),
	'session_id' => Yii::t('sw', 'Session'),
	'user_agent' => Yii::t('sw', 'User Agent'),
	'ip'         => Yii::t('sw', 'IP Address'),
	'created_at' => Yii::t('sw', 'Started'),
	'updated_at' => Yii::t('sw', 'Last Activity'),

	'name'           => Yii::t('sw',          'Name'),
	'public_email'   => Yii::t('sw', 'Public Email'),
	'website'        => Yii::t('sw', 'Website'),
	'location'       => Yii::t('sw', 'Location'),
	'timezone'       => Yii::t('sw', 'Timezone'),
	'gravatar_email' => Yii::t('sw', 'Gravatar Email'),
	'bio'            => Yii::t('sw', 'Bio'),
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
							Yii::t('sw', 'Change your avatar at Gravatar.com'),
							'https://gravatar.com',
							['target' => '_blank']
						)
					) ?>

				<?= $form->field($model, 'bio')->textarea() ?>

				<div class="form-group">
					<div class="offset-sm-2 col-lg-10">
						<div class="d-grid">
							<?= Html::submitButton(
								Yii::t('sw', 'Save'),
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
