<?php
/**
 * @backend/views/permission/create.php
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
 * @var Da\User\Model\Permission $model
 * @var string[] $unassignedItems
 * @var \Da\User\Module $module
 */

$this->title = Yii::t('usuario', 'Create new permission');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>

<?= $this->render(
	'/permission/_form',
	[
		'model' => $model,
		'unassignedItems' => $unassignedItems,
	]
) ?>

<?php $this->endContent() ?>
