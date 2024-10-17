<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var language\models\SWLanguagePage $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="swlanguage-page-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'page_pk' => $model->page_pk], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'page_pk' => $model->page_pk], [
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
			'page_pk',
			'page_lang',
			'page_slug',
			'title:ntext',
			'subtitle:ntext',
			'description:ntext',
			'keywords:ntext',
			'lead:ntext',
			'origin:ntext',
			'origin_link:ntext',
			'body_yaml:ntext',
		],
	]) ?>

</div>
