<?php

use language\models\SWLanguageBase;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var language\models\SWLanguageBaseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Language Bases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swlanguage-base-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Sw Language Base', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'lang_pk',
			'lang_code',
			'prev_code',
			'menu_position',
			'lang_name',
			//'native_name',
			//'flag_icon',
			//'ui_label',
			//'locale',
			//'html_lang',
			//'footer_yaml:ntext',
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, SWLanguageBase $model, $key, $index, $column) {
					return Url::toRoute([$action, 'lang_pk' => $model->lang_pk]);
				 }
			],
		],
	]); ?>


</div>
