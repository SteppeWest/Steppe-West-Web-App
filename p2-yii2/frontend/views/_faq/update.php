<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LanguageFaq $model */

$this->title = 'Update Language Faq: ' . $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Language Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="language-faq-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
