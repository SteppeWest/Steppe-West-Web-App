<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Substitution $model */

$this->title = 'Create Sw Substitution';
$this->params['breadcrumbs'][] = ['label' => 'Sw Substitutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Substitution-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
