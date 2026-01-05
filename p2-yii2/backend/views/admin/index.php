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

$this->title = Yii::t('admin.users', 'Manage Users');
$this->params['breadcrumbs'][] = $this->title;

$iconSwitch = BI::i('person-bounding-box')
	->title(Yii::t('admin.a11y', 'Switch Identity'))
	->ariaLabel(Yii::t('admin.a11y', 'Switch Identity'))
	->focusable();

$iconView = BI::i('eye')
	->title(Yii::t('admin.a11y', 'View User'))
	->ariaLabel(Yii::t('admin.a11y', 'View User'))
	->focusable();

$iconEdit = BI::i('pencil-square')
	->title(Yii::t('admin.a11y', 'Update User'))
	->ariaLabel(Yii::t('admin.a11y', 'Update User'))
	->focusable();

$iconReset = BI::i('lightning-charge')
	->title(Yii::t('admin.a11y', 'Reset Password'))
	->ariaLabel(Yii::t('admin.a11y', 'Reset Password'))
	->focusable();

$iconBlock = BI::i('slash-circle')
	->title(Yii::t('admin.a11y', 'Block User'))
	->ariaLabel(Yii::t('admin.a11y', 'Block User'))
	->focusable();

$iconDelete = BI::i('trash')
	->title(Yii::t('admin.a11y', 'Delete User'))
	->ariaLabel(Yii::t('admin.a11y', 'Delete User'))
	->focusable();

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
		BI::i('plus-circle') . ' ' . Yii::t('admin.users', 'Add User'),
		['create'],
		['class' => 'btn btn-primary']
	) ?>
</div>

<?= $this->render('/partials/breadcrumbs') ?>
<?= Alert::widget() ?>

<div class="table-responsive">
	<table class="table table-bordered" id="usersTable">
		<thead>
			<tr>
				<th><?= Yii::t('admin', 'Username') ?></th>
				<th><?= Yii::t('admin', 'Email') ?></th>
				<th><?= Yii::t('admin.users', 'Confirmed') ?></th>
				<th><?= Yii::t('admin.users', 'Blocked') ?></th>
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
							$iconEdit,
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
										'confirm' => Yii::t('admin', 'Are you sure?'),
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
	</table>
</div>
