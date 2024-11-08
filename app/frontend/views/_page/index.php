<?php

use common\models\SwLanguagePage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SwLanguagePageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Language Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sw-language-page-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Sw Language Page', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
			['class' => 'yii\grid\SerialColumn'],

            'pk',
            'page_lang',
            'slug',
            'title:ntext',
            'subtitle:ntext',
            //'description:ntext',
            //'keywords:ntext',
            //'lead:ntext',
            //'origin:ntext',
            //'origin_link:ntext',
            //'body_content:ntext',
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, SwLanguagePage $model, $key, $index, $column) {
					return Url::toRoute([$action, 'pk' => $model->pk]);
				 }
			],
		],
	]); ?>


</div>
