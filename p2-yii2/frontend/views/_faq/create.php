<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LanguageFaq $model */

$this->title = 'Create Language Faq';
$this->params['breadcrumbs'][] = ['label' => 'Language Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-faq-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
