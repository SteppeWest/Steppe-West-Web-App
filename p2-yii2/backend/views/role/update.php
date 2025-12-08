<?php
/**
 * @backend/views/role/update.php
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
 * @var string[] $unassignedItems
 * @var \Da\User\Module $module
 */

$this->title = Yii::t('usuario', 'Update role');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>

<?= $this->render(
	'/role/_form',
	[
		'model' => $model,
		'unassignedItems' => $unassignedItems,
	]
) ?>

<?php $this->endContent() ?>
