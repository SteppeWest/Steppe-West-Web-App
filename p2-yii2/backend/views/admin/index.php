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
use common\widgets\Alert;
use p2m\helpers\BI;
use p2m\assets\P2DataTablesResponsiveAsset;

P2DataTablesResponsiveAsset::register($this);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Da\User\Search\UserSearch $searchModel
 * @var Da\User\Module $module
 */

$this->title = Yii::t('admin.rbac', 'Manage Users');
$this->params['breadcrumbs'][] = $this->title;

$iconSwitch = BI::i('person-bounding-box')
	->l(Yii::t('admin.a11y', 'Switch Identity'))
	->t(Yii::t('admin.a11y', 'Switch Identity'))
	->f();

$iconView = BI::i('eye')
	->l(Yii::t('admin.a11y', 'View User'))
	->t(Yii::t('admin.a11y', 'View User'))
	->f();

$iconUpdate = BI::i('pencil-square')
	->l(Yii::t('admin.a11y', 'Update User'))
	->t(Yii::t('admin.a11y', 'Update User'))
	->f();

$iconReset = BI::i('lightning-charge')
	->l(Yii::t('admin.a11y', 'Reset Password'))
	->t(Yii::t('admin.a11y', 'Reset Password'))
	->f();

$iconBlock = BI::i('slash-circle')
	->l(Yii::t('admin.a11y', 'Block User'))
	->t(Yii::t('admin.a11y', 'Block User'))
	->f();

$iconDelete = BI::i('trash')
	->l(Yii::t('admin.a11y', 'Delete User'))
	->t(Yii::t('admin.a11y', 'Delete User'))
	->f();

$iconConfirmed = function (bool $status) {
	$icon = '';
	$title = '';
	$color = '';

	if ($status) {
		$icon = 'check';
		$title = Yii::t('admin.a11y', 'User confirmed');
		$color = P2Icons::SUCCESS;
	}
	else {
		$icon = 'x';
		$title = Yii::t('admin.a11y', 'User not confirmed');
		$color = P2Icons::DANGER;
	}

	return BI::i($icon)->l($title)->t($title)->c($color);

	/**
		'Blocked'
		'Not Blocked'
	 */


};

$disabledIcon = function ($icon, string $btnClass) {
	return Html::tag(
		'span',
		$icon->h(), // icon is decorative here
		[
			'class' => $btnClass . ' disabled',
			'aria-disabled' => 'true',
		]
	);
};
?>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>
	<?= Html::a(
		BI::i('plus-circle') . ' ' . Yii::t('admin.rbac', 'Add User'),
		['create'],
		['class' => 'btn btn-primary']
	) ?>
</div>

<?= $this->render('/partials/breadcrumbs') ?>
<?= Alert::widget() ?>

<div class="table-responsive">
	<table class="table table-bordered display"
		id="usersTable" data-p2-datatables="1">
		<thead>
			<tr>
				<th><?= Yii::t('admin', 'Username') ?></th>
				<th><?= Yii::t('admin', 'Email') ?></th>
				<th><?= Yii::t('admin.rbac', 'Confirmed') ?></th>
				<th><?= Yii::t('admin.rbac', 'Blocked') ?></th>
				<th><?= Yii::t('admin', 'Created') ?></th>
				<th><?= Yii::t('admin', 'Actions') ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($dataProvider->getModels() as $user): ?>
			<tr>
				<td><?= Html::encode($user->username) ?></td>
				<td><?= Html::encode($user->email) ?></td>
				<td><?= $user->confirmed_at ? Yii::t('admin', 'Yes') : Yii::t('admin', 'No') ?></td>
				<td><?= $user->blocked_at ? Yii::t('admin', 'Yes') : Yii::t('admin', 'No') ?></td>
				<td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
				<td>
					<div class="btn-group btn-group-sm" role="group"
					     aria-label="<?= Yii::t('admin.a11y', 'User Actions') ?>">

						<?php $isSelf = Yii::$app->user->id === $user->id; ?>

						<!-- Switch identity -->
						<?= $isSelf
							? $disabledIcon($iconSwitch, 'btn btn-secondary')
							: Html::a(
								$iconSwitch,
								['switch-identity', 'id' => $user->id],
								[
									'class' => 'btn btn-secondary',
									'aria-label' => Yii::t('admin.a11y', 'Switch Identity'),
								]
							)
						?>

						<!-- View -->
						<?= Html::a(
							$iconView,
							['profile/show', 'id' => $user->id],
							[
								'class' => 'btn btn-secondary',
								'aria-label' => Yii::t('admin.a11y', 'View User'),
							]
						) ?>

						<!-- Update -->
						<?= Html::a(
							$iconUpdate,
							['update', 'id' => $user->id],
							[
								'class' => 'btn btn-primary',
								'aria-label' => Yii::t('admin.a11y', 'Update User'),
							]
						) ?>

						<!-- Reset password -->
						<?= Html::a(
							$iconReset,
							['password-reset', 'id' => $user->id],
							[
								'class' => 'btn btn-warning',
								'aria-label' => Yii::t('admin.a11y', 'Reset Password'),
							]
						) ?>

						<!-- Block -->
						<?= $isSelf
							? $disabledIcon($iconBlock, Yii::t('admin.a11y', 'Block User'), 'btn btn-danger')
							: Html::a(
								$iconBlock,
								['block', 'id' => $user->id],
								[
									'class' => 'btn btn-danger',
									'aria-label' => Yii::t('admin.a11y', 'Block User'),
									'data' => [
										'confirm' => Yii::t('admin', 'Are you sure?'),
										'method' => 'post',
									],
								]
							)
						?>

						<!-- Delete -->
						<?= $isSelf
							? $disabledIcon($iconDelete, Yii::t('admin.a11y', 'Delete User'), 'btn btn-danger')
							: Html::a(
								$iconDelete,
								['delete', 'id' => $user->id],
								[
									'class' => 'btn btn-danger',
									'aria-label' => Yii::t('admin.a11y', 'Delete User'),
									'data' => [
										'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
										'method' => 'post',
									],
								]
							)
						?>

					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<!-- empty table footer as contingency -->
		<!--
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			<tr>
		</tfoot>
		-->
	</table>
</div>
