<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Substitution $model */

$this->title = 'Create Substitution';
$this->params['breadcrumbs'][] = ['label' => 'Substitutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="substitution-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
