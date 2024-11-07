<?php

use common\models\SwSubstitution;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SwSubstitutionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sw Substitutions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sw-substitution-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Sw Substitution', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
			['class' => 'yii\grid\SerialColumn'],

            'pk',
            'name',
            'value:ntext',
            'description:ntext',
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, SwSubstitution $model, $key, $index, $column) {
					return Url::toRoute([$action, 'pk' => $model->pk]);
				 }
			],
		],
	]); ?>


</div>
