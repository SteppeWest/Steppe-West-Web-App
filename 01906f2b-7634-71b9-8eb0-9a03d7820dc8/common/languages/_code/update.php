<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageCode $model */

$this->title = Yii::t('app', 'Update Sw Language Code: {name}', [
	'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Language Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="swlanguage-code-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
