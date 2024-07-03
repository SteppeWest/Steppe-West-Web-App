<?php
/**
 * languages/page/update.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SWLanguagePage $model */

$this->title = Yii::t('app', 'Update Sw Language Page: {name}', [
	'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Language Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'pk' => $model->pk]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="swlanguage-page-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
