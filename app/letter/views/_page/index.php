<?php

use common\models\SWPage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SWPageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swpage-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Sw Page', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'pk',
			'key_pk',
			'code:ntext',
			'page:ntext',
			'title:ntext',
			//'subtitle:ntext',
			//'body_yaml:ntext',
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, SWPage $model, $key, $index, $column) {
					return Url::toRoute([$action, 'pk' => $model->pk]);
				 }
			],
		],
	]); ?>


</div>
