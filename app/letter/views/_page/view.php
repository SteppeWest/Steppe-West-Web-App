<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SWPage $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sw Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="swpage-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'pk' => $model->pk], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'pk' => $model->pk], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'pk',
			'key_pk',
			'code:ntext',
			'page:ntext',
			'title:ntext',
			'subtitle:ntext',
			'body_yaml:ntext',
		],
	]) ?>

</div>
