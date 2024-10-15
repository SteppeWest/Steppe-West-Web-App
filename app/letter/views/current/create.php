<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var letter\models\SWCurrentLanguage $model */

$this->title = 'Create Sw Current Language';
$this->params['breadcrumbs'][] = ['label' => 'Sw Current Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swcurrent-language-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
