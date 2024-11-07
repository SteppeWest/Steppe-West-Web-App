<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SwLanguage $model */

$this->title = 'Create Sw Language';
$this->params['breadcrumbs'][] = ['label' => 'Sw Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sw-language-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
