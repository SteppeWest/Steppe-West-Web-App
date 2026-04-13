<?php
/**
 * @backend/views/admin/_assignments.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use Da\User\Widget\AssignmentsWidget;

/** @var yii\web\View $this */
/** @var Da\User\Model\User $user */
/** @var string[] $params */
/** @var \Da\User\Module $module */
?>

<?php $this->beginContent($module->viewPath. '/admin/update.php', ['user' => $user]) ?>

<?= yii\bootstrap5\Alert::widget(
	[
		'options' => [
			'class' => 'alert-info alert-dismissible',
		],
		'body' => Yii::t('usuario', 'You can assign multiple roles or permissions to user by using the form below'),
	]
) ?>

<?= AssignmentsWidget::widget(['userId' => $user->id, 'params' => $params]) ?>

<?php $this->endContent() ?>
