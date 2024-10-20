<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SWSingleton $model */

$this->title = 'Create Sw Singleton';
$this->params['breadcrumbs'][] = ['label' => 'Sw Singletons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swsingleton-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
