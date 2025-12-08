<?php
/**
 * @backend/views/permission/_form.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View $this
 * @var Da\User\Model\Permission $model
 * @var string[] $unassignedItems
 */
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
		'prompt' => Yii::t('usuario', 'Select rule...'),
	]
) ?>

<?= $form->field($model, 'children')->listBox(
	$unassignedItems,
	[
		'id' => 'children',
		'multiple' => true,
		'class' => 'form-select',
		'size' => min(15, max(5, count($unassignedItems))), // adjusts height sensibly
	]
) ?>

<?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success btn-block']) ?>

<?php ActiveForm::end() ?>
