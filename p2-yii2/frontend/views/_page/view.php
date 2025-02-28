<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\LanguagePage $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Language Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="language-page-view">

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
			'lang_pk',
			'page_lang',
			'slug',
			'title:ntext',
			'subtitle:ntext',
			'description:ntext',
			'keywords:ntext',
			'lead:ntext',
			'origin:ntext',
			'origin_link:ntext',
			'body_content:ntext',
		],
	]) ?>

</div>
