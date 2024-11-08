<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\LanguagePage $model */

$this->title = 'Update Language Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Language Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="language-page-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
