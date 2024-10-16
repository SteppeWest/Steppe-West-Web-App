<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var letter\models\SWCurrentLanguage $model */

$this->title = 'Update Sw Current Language: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sw Current Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swcurrent-language-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
