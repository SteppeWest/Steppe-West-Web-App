<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\LanguagePage $model */

$this->title = 'Create Language Page';
$this->params['breadcrumbs'][] = ['label' => 'Language Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-page-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
