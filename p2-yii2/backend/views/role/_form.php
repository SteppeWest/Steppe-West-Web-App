<?php
/**
 * @backend/views/role/_form.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

/**
 * @var yii\web\View $this
 * @var \Da\User\Model\Role $model
 */

use Da\User\Helper\AuthHelper;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$unassignedItems = Yii::$container->get(AuthHelper::class)->getUnassignedItems($model);
?>

<?php $form = ActiveForm::begin(
	[
		'enableClientValidation' => false,
		'enableAjaxValidation' => true,
	]
) ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'description') ?>

<?= $form->field($model, 'rule')->dropDownList(
	ArrayHelper::map(Yii::$app->getAuthManager()->getRules(), 'name', 'name'),
	[
		'prompt' => 'Select rule...',
	]
) ?>

<?= $form->field($model, 'children')->listBox(
	$unassignedItems,
	[
		'id' => 'children',
		'multiple' => true,
		'class' => 'form-select',
		'size' => min(15, max(5, count($unassignedItems))),
	]
) ?>

<?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success btn-block']) ?>

<?php ActiveForm::end() ?>




use yii\helpers\ArrayHelper;
use Yii;

// ...

echo $form->field($model, 'rule')->dropDownList(
	ArrayHelper::map(Yii::$app->getAuthManager()->getRules(), 'name', 'name'),
	[
		'prompt' => 'Select rule...',
	]
);
