<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Substitution $model */

$this->title = 'Update Sw Substitution: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sw Substitutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Substitution-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
