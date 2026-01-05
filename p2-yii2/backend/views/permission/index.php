<?php
/**
 * @backend/views/permission/index.php
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

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

P2DataTablesResponsiveAsset::register($this);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Da\User\Search\UserSearch $searchModel
 * @var Da\User\Module $module
 */

$this->title = Yii::t('admin.permissions', 'Manage Permissions');
$this->params['breadcrumbs'][] = $this->title;

$iconUpdate = BI::i('pencil-square')
	->title(Yii::t('admin.a11y', 'Update Permission'))
	->ariaLabel(Yii::t('admin.a11y', 'Update Permission'))
	->focusable();

$iconDelete = BI::i('trash')
	->title(Yii::t('admin.a11y', 'Delete Permission'))
	->ariaLabel(Yii::t('admin.a11y', 'Delete Permission'))
	->focusable();
?>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>
	<?= Html::a(
		BI::i('plus-circle') . ' ' . Yii::t('admin.permissions', 'Add Permission'),
		['create'],
		['class' => 'btn btn-primary']
	) ?>
</div>

<?= $this->render('/partials/breadcrumbs') ?>
<?= Alert::widget() ?>

<div class="table-responsive">
	<table class="table table-bordered" id="permissionsTable">
		<thead>
			<tr>
				<th><?= Yii::t('admin', 'Name') ?></th>
				<th><?= Yii::t('admin', 'Description') ?></th>
				<th><?= Yii::t('admin.rules', 'Rule Name') ?></th>
				<th><?= Yii::t('admin', 'Actions') ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($dataProvider->getModels() as $permission): ?>
			<tr>
				<td><?= Html::encode($permission->name) ?></td>
				<td><?= Html::encode($permission->description) ?></td>
				<td><?= Html::encode($permission->rule_name) ?></td>
				<td>
					<div class="btn-group btn-group-sm" role="group" aria-label="<?= Yii::t('admin.a11y', 'Permissions Actions') ?>">
						<!-- Update -->
						<?= Html::a(
							$iconUpdate,
							['update', 'name' => $permission->name],
							['class' => 'btn btn-primary']
						) ?>

						<!-- Delete -->
						<?= Html::a(
							$iconDelete,
							['delete', 'name' => $permission->name],
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
