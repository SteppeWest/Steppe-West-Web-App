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
	if ($status) {
		$msg = Yii::t('admin.a11y', 'User confirmed');
		return BI::i('check-circle') // 'check-circle' or 'check'
			->l($msg)->t($msg)
			->c(BI::SUCCESS)->s(5);
	}

	$msg = Yii::t('admin.a11y', 'User not confirmed');
	return BI::i('x-circle') // 'x-circle' or 'x'
		->l($msg)->t($msg)
		->c(BI::DANGER)->s(5);
};

$iconBlocked = function (bool $status) {
	if ($status) {
		$msg = Yii::t('admin.a11y', 'User is blocked');
		return BI::i('lock') // 'slash-circle' or 'lock'
			->l($msg)->t($msg)
			->c(BI::DANGER)->s(5);
	}

	$msg = Yii::t('admin.a11y', 'User is not blocked');
	return BI::i('unlock') // 'unlock' or 'shield-check'
		->l($msg)->t($msg)
		->c(BI::SUCCESS)->s(5);
};

$disabledIcon = function ($icon, string $label, string $btnClass) {
	return Html::tag(
		'span',
		$icon->h(), // icon is decorative here
		[
			'class' => $btnClass . ' disabled',
			'aria-disabled' => 'true',
			'title' => $label,
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
	<table class="table table-bordered"
		id="usersTable" data-p2-datatables="1"
		data-p2-datatables-options='{"searching":false,"pageLength":25}'>
		<thead>
			<tr>
				<th>ID</th>
				<th><?= Yii::t('admin', 'Username') ?></th>
				<th><?= Yii::t('admin', 'Email') ?></th>
				<th class="text-center"><?= Yii::t('admin.rbac', 'Confirmed') ?></th>
				<th class="text-center"><?= Yii::t('admin.rbac', 'Blocked') ?></th>
				<th><?= Yii::t('admin', 'Created') ?></th>
				<th class="text-center" data-orderable="false">
					<?= Yii::t('admin', 'Actions') ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($dataProvider->getModels() as $user): ?>
			<?php
				$confirmed = (bool)$user->confirmed_at;
				$blocked   = (bool)$user->blocked_at;
			?>
			<tr>
				<td><?= Html::encode($user->id) ?></td>
				<td><?= Html::encode($user->username) ?></td>
				<td><?= Html::encode($user->email) ?></td>
				<td class="text-center" data-order="<?= (int)$confirmed ?>"><!-- use (int)!$confirmed to flip sorting order -->
					<?= $iconConfirmed($confirmed) ?>
				</td>
				<td class="text-center" data-order="<?= (int)!$blocked ?>"><!-- use (int)$blocked to flip sorting order -->
					<?= $iconBlocked($blocked) ?>
				</td>
				<td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
				<td>
					<div class="btn-group btn-group-sm" role="group"
					     aria-label="<?= Yii::t('admin.a11y', 'User Actions') ?>">

						<?php $isSelf = Yii::$app->user->id === $user->id; ?>

						<!-- Switch identity -->
						<?= $isSelf
							? $disabledIcon($iconSwitch, Yii::t('admin.a11y', 'Switch Identity'), 'btn btn-secondary')
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
