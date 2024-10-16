<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageExtra $model */

$this->title = $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="swlanguage-extra-view">

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
			'code',
			'locale',
			'lang',
			'footer_yaml:ntext',
		],
	]) ?>

</div>
