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

$this->title = Yii::t('usuario', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= Html::encode($this->title) ?></h1>

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

<div class="table-responsive">
	<table class="table table-bordered" id="usersTable">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Confirmed</th>
				<th>Blocked</th>
				<th>Created</th>
				<th style="width: 160px;">Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($dataProvider->getModels() as $user): ?>
			<tr>
				<td><?= Html::encode($user->username) ?></td>
				<td><?= Html::encode($user->email) ?></td>
				<td><?= $user->confirmed_at ? 'Yes' : 'No' ?></td>
				<td><?= $user->blocked_at ? 'Yes' : 'No' ?></td>
				<td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
				<td>
					<div class="btn-group btn-group-sm">
						<?= Html::a('View', ['profile/show', 'id' => $user->id], ['class' => 'btn btn-outline-secondary']) ?>
						<?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-outline-primary']) ?>
						<?= Html::a('Delete', ['delete', 'id' => $user->id], [
							'class' => 'btn btn-outline-danger',
							'data' => [
								'confirm' => 'Are you sure?',
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
