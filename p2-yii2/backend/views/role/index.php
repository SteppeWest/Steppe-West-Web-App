<?php
/**
 * @backend/views/role/index.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\bootstrap5\Html;
use common\widgets\Alert;
use p2m\helpers\BI;
use p2m\assets\P2DataTablesResponsiveAsset;

P2DataTablesResponsiveAsset::register($this);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Da\User\Search\RoleSearch $searchModel
 * @var Da\User\Module $module
 */

$this->title = Yii::t('admin.rbac', 'Manage Roles');
$this->params['breadcrumbs'][] = $this->title;

$iconUpdate = BI::i('pencil-square')
	->l(Yii::t('admin.a11y', 'Edit Role'))
	->t(Yii::t('admin.a11y', 'Edit Role'))
	->f();

$iconDelete = BI::i('trash')
	->l(Yii::t('admin.a11y', 'Delete Role'))
	->t(Yii::t('admin.a11y', 'Delete Role'))
	->f();
?>

<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>

	<?= Html::a(
		BI::i('plus-circle') . ' ' . Yii::t('admin.rbac', 'Add Role'),
		['create'],
		['class' => 'btn btn-primary', 'encode' => false]
	) ?>
</div>

<?= $this->render('/partials/breadcrumbs') ?>
<?= Alert::widget() ?>

<div class="table-responsive">
	<table class="table table-bordered display"
		id="rolesTable" data-p2-datatables="1"
		data-p2-datatables-options='{"searching":false,"pageLength":25}'>
		<thead>
			<tr>
				<th><?= Yii::t('admin', 'Name') ?></th>
				<th><?= Yii::t('admin', 'Description') ?></th>
				<th><?= Yii::t('admin.rbac', 'Rule Name') ?></th>
				<th class="text-center" data-orderable="false">
					<?= Yii::t('admin', 'Actions') ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($dataProvider->getModels() as $role): ?>
			<tr>
				<td><?= Html::encode($role->name) ?></td>
				<td><?= Html::encode($role->description) ?></td>
				<td><?= Html::encode($role->rule_name) ?></td>
				<td>
					<div class="btn-group btn-group-sm" role="group" aria-label="<?= Yii::t('admin.a11y', 'Role Actions') ?>">
						<!-- Update -->
						<?= Html::a(
							$iconUpdate,
							['update', 'name' => $role->name],
							['class' => 'btn btn-primary']
						) ?>

						<!-- Delete -->
						<?= Html::a(
							$iconDelete,
							['delete', 'name' => $role->name],
							[
								'class' => 'btn btn-danger',
								'data' => [
									'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
									'method' => 'post',
								],
							]
						) ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
