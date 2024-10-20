<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWLanguageBase $model */

$this->title = 'Update Sw Language Base: ' . $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swlanguage-base-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
