<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguageExtra $model */

$this->title = 'Update Sw Language Extra: ' . $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swlanguage-extra-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
