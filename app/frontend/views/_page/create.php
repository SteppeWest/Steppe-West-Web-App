<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LanguagePage $model */

$this->title = 'Create Sw Language Page';
$this->params['breadcrumbs'][] = ['label' => 'Sw Language Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Language-page-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
