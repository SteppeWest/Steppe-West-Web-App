<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageShared $model */

$this->title = $model->pk;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Language Shareds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="swlanguage-shared-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'pk' => $model->pk], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'pk' => $model->pk], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'pk',
			'code:ntext',
			'locale:ntext',
			'lang:ntext',
			'origin:ntext',
			'footer_yaml:ntext',
		],
	]) ?>

</div>
