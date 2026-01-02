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

$this->title = Yii::t('admin.nav', 'Manage Users');
$this->params['breadcrumbs'][] = $this->title;?>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= Html::encode($this->title) ?></h1>

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
				<th><?= Yii::t('admin.users', 'Username') ?></th>
				<th><?= Yii::t('admin.users', 'Email') ?></th>
				<th><?= Yii::t('admin.users', 'Confirmed') ?></th>
				<th><?= Yii::t('admin.users', 'Blocked') ?></th>
				<th><?= Yii::t('admin.users', 'Created') ?></th>
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
					<div class="btn-group btn-group-sm">
						<?= Html::a(Yii::t('admin.users', 'View'), ['profile/show', 'id' => $user->id], ['class' => 'btn btn-outline-secondary']) ?>
						<?= Html::a(Yii::t('admin.users', 'Update'), ['update', 'id' => $user->id], ['class' => 'btn btn-outline-primary']) ?>
						<?= Html::a(Yii::t('admin.users', 'Delete'), ['delete', 'id' => $user->id], [
							'class' => 'btn btn-outline-danger',
							'data' => [
								'confirm' => Yii::t('admin', 'Are you sure?'),
								'method' => 'post',
							],
						]) ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
