<?php
/**
 * @backend/views/partials/user-gravatar.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\helpers\Html;
use p2m\rbac\helpers\P2GravatarHelper;

/** @var \yii\web\View $this */

$user = Yii::$app->user->identity;
?>

<div class="text-center">
	<?= P2GravatarHelper::img($user, [
		'class' => 'img-fluid rounded-circle mb-2',
	], 200) ?>
	<div class="fs-4 mb-0">
		<strong><?= Html::encode($user->username) ?></strong>
	</div>
</div>
