<?php
/**
 * @backend/views/admin/index.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\bootstrap5\Html;
use yii\bootstrap5\Breadcrumbs;
use yii\widgets\Pjax;
use common\widgets\Alert;
use p2m\helpers\BI;
use p2m\assets\P2SimpleDatatablesAsset;
use yii\grid\GridView;

use p2m\assets\datatables\P2DataTablesBootstrap5Asset;
use p2m\assets\datatables\P2DataTablesResponsiveAsset;

P2DataTablesBootstrap5Asset::register($this);
P2DataTablesResponsiveAsset::register($this);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Da\User\Search\UserSearch $searchModel
 * @var Da\User\Module $module
 */

P2SimpleDatatablesAsset::register($this);

$this->registerJs(<<<JS
$(function () {
  const dt = $('#usersTable').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [10, 25, 50, 100],
    order: [[0, 'asc']],
    dom: 'lrtip' // ✅ removes DataTables' own search box
  });

  // Expose to global nav search (see below)
  window.SW_DT = window.SW_DT || {};
  window.SW_DT.current = dt;
});
JS);

$this->title = Yii::t('usuario', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>
	<?= Html::a(
		BI::i('plus-circle') . ' Add User',
		['create'],
		['class' => 'btn btn-primary']
	) ?>
</div>
<?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>

<?php Pjax::begin() ?>
<div class="table-responsive">
<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'layout' => "{items}\n{pager}",
	'columns' => [
		'username',
		'email:email',
		[
			'attribute' => 'registration_ip',
			'value' => function ($model) {
				return $model->registration_ip == null
					? '<span class="not-set">' . Yii::t('usuario', '(not set)') . '</span>'
					: $model->registration_ip;
			},
			'format' => 'html',
			'visible' => !$module->disableIpLogging,
		],
		[
			'attribute' => 'created_at',
			'value' => function ($model) {
				if (extension_loaded('intl')) {
					return Yii::t('usuario', '{0, date, MMM dd, YYYY HH:mm}', [$model->created_at]);
				}

				return date('Y-m-d G:i:s', $model->created_at);
			},
		],
		[
			'attribute' => 'last_login_at',
			'value' => function ($model) {
				if (!$model->last_login_at || $model->last_login_at == 0) {
					return Yii::t('usuario', 'Never');
				} elseif (extension_loaded('intl')) {
					return Yii::t('usuario', '{0, date, MMM dd, YYYY HH:mm}', [$model->last_login_at]);
				} else {
					return date('Y-m-d G:i:s', $model->last_login_at);
				}
			},
		],
		[
			'attribute' => 'last_login_ip',
			'value' => function ($model) {
				return $model->last_login_ip == null
					? '<span class="not-set">' . Yii::t('usuario', '(not set)') . '</span>'
					: $model->last_login_ip;
			},
			'format' => 'html',
			'visible' => !$module->disableIpLogging,
		],
		[
			'header' => Yii::t('usuario', 'Confirmation'),
			'value' => function ($model) {
				if ($model->isConfirmed) {
					return '<div class="text-center">
							<span class="text-success">' . Yii::t('usuario', 'Confirmed') . '</span>
						</div>';
				}

				return Html::a(
					Yii::t('usuario', 'Confirm'),
					['confirm', 'id' => $model->id],
					[
						'class' => 'btn btn-xs btn-success btn-block',
						'data-method' => 'post',
						'data-confirm' => Yii::t('usuario', 'Are you sure you want to confirm this user?'),
					]
				);
			},
			'format' => 'raw',
			'visible' => $module->enableEmailConfirmation,
		],
		'password_age',
		[
			'header' => Yii::t('usuario', 'Block status'),
			'value' => function ($model) {
				if ($model->isBlocked) {
					return Html::a(
						Yii::t('usuario', 'Unblock'),
						['block', 'id' => $model->id],
						[
							'class' => 'btn btn-xs btn-success btn-block',
							'data-method' => 'post',
							'data-confirm' => Yii::t('usuario', 'Are you sure you want to unblock this user?'),
						]
					);
				}

				return Html::a(
					Yii::t('usuario', 'Block'),
					['block', 'id' => $model->id],
					[
						'class' => 'btn btn-xs btn-danger btn-block',
						'data-method' => 'post',
						'data-confirm' => Yii::t('usuario', 'Are you sure you want to block this user?'),
					]
				);
			},
			'format' => 'raw',
		],
		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{switch} {reset} {force-password-change} {update} {delete}',
			'buttons' => [
				'switch' => function ($url, $model) use ($module) {
					if ($model->id != Yii::$app->user->id && $module->enableSwitchIdentities) {
						return Html::a(
							'<i class="bi-person-fill"></i>',
							['/user/admin/switch-identity', 'id' => $model->id],
							[
								'title' => Yii::t('usuario', 'Impersonate this user'),
								'data-confirm' => Yii::t(
									'usuario',
									'Are you sure you want to switch to this user for the rest of this Session?'
								),
								'data-method' => 'POST',
							]
						);
					}

					return null;
				},
				'reset' => function ($url, $model) use ($module) {
					if($module->allowAdminPasswordRecovery) {
						return Html::a(
							'<i class="bi-lightning-charge-fill"></i>',
							['/user/admin/password-reset', 'id' => $model->id],
							[
								'title' => Yii::t('usuario', 'Send password recovery email'),
								'data-confirm' => Yii::t(
									'usuario',
									'Are you sure you wish to send a password recovery email to this user?'
								),
								'data-method' => 'POST',
							]
						);
					}

					return null;
				},
				'force-password-change' => function ($url, $model) use ($module) {
					if (is_null($module->maxPasswordAge)) {
						return null;
					}
					return Html::a(
						'<i class="fas fa-stopwatch"></i>',
						['/user/admin/force-password-change', 'id' => $model->id],
						[
							'title' => Yii::t('usuario', 'Force password change at next login'),
							'data-confirm' => Yii::t(
								'usuario',
								'Are you sure you wish the user to change their password at next login?'
							),
							'data-method' => 'POST',
						]
					);
				},
			]
		],
	],
]); ?>
</div>
<?php Pjax::end() ?>
