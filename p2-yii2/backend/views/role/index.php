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
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\widgets\Alert;
use p2m\helpers\BI;
use p2m\assets\P2SimpleDatatablesAsset;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Da\User\Search\UserSearch $searchModel
 * @var Da\User\Module $module
 */

P2SimpleDatatablesAsset::register($this);

$this->title = Yii::t('usuario', 'Manage roles');
?>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>
	<?= Html::a(
		BI::i('plus-circle') . ' Add Role',
		['create'],
		['class' => 'btn btn-primary']
	) ?>
</div>
<?= Alert::widget() ?>
<?php Pjax::begin() ?>
<div class="table-responsive">
<?= GridView::widget(
	[
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'layout' => "{items}\n{pager}",
		'columns' => [
			[
				'attribute' => 'name',
				'header' => Yii::t('usuario', 'Name'),
				'options' => [
					'style' => 'width: 20%',
				],
			],
			[
				'attribute' => 'description',
				'header' => Yii::t('usuario', 'Description'),
				'options' => [
					'style' => 'width: 55%',
				],
			],
			[
				'attribute' => 'rule_name',
				'header' => Yii::t('usuario', 'Rule name'),
				'options' => [
					'style' => 'width: 20%',
				],
			],
			[
				'class' => ActionColumn::class,
				'template' => '{update} {delete}',
				'urlCreator' => function ($action, $model) {
					return Url::to(['/user/role/' . $action, 'name' => $model['name']]);
				},
				'options' => [
					'style' => 'width: 5%',
				],
			],
		],
	]
) ?>
</div>
<?php Pjax::end() ?>
