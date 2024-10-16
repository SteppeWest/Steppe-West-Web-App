<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var letter\models\SWLanguagePage $model */

$this->title = 'Update Sw Language Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="swlanguage-page-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
