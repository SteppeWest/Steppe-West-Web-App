<?php
/**
 * @backend/views/role/index.php
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

$this->title = Yii::t('admin.roles', 'Manage Roles');
$this->params['breadcrumbs'][] = $this->title;

$updateIcon = BI::i('pencil-square')
	->l(Yii::t('admin.a11y', 'Edit Role'))
	->t(Yii::t('admin.a11y', 'Edit Role'))
	->f();

$deleteIcon = BI::i('trash')
	->ariaLabel(Yii::t('admin.a11y', 'Delete Role'))
	->title(Yii::t('admin.a11y', 'Delete Role'))
	->focusable();
?>

<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>

	<?= Html::a(
		BI::i('plus-circle') . ' ' . Yii::t('admin.roles', 'Add Role'),
		['create'],
		['class' => 'btn btn-primary', 'encode' => false]
	) ?>
</div>

<?= $this->render('/partials/breadcrumbs') ?>
<?= Alert::widget() ?>

<div class="table-responsive">
	<table class="table table-bordered" id="rolesTable">
		<thead>
			<tr>
				<th><?= Yii::t('admin', 'Name') ?></th>
				<th><?= Yii::t('admin', 'Description') ?></th>
				<th><?= Yii::t('admin.roles', 'Rule Name') ?></th>
				<th><?= Yii::t('admin', 'Actions') ?></th>
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
						<?= Html::a(
							$updateIcon,
							['update', 'name' => $role->name],
							['class' => 'btn btn-primary']
						) ?>
						<?= Html::a(
							$deleteIcon,
							['delete', 'name' => $role->name],
							[
								'class' => 'btn btn-danger',
								'data' => [
									'confirm' => Yii::t('admin', 'Are you sure?'),
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
