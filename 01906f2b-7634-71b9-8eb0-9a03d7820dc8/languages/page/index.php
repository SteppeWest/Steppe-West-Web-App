<?php
/**
 * languages/page/index.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use app\models\SWLanguagePage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SWLanguagePageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Sw Language Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-page-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Create Sw Language Page'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'pk',
			'code:ntext',
			'page:ntext',
			'title:ntext',
			'subtitle:ntext',
			//'description:ntext',
			//'keywords:ntext',
			//'lead:ntext',
			//'body_yaml:ntext',
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, SWLanguagePage $model, $key, $index, $column) {
					return Url::toRoute([$action, 'pk' => $model->pk]);
				 }
			],
		],
	]); ?>


</div>
