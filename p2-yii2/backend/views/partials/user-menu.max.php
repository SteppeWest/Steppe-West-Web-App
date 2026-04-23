<?php
/**
 * @backend/views/partials/user-menu.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;

$currentRoute = Yii::$app->requestedRoute;

$items = [
	[
		'label' => Yii::t('sw', 'Profile'),
		'url'   => ['/user/profile'],
		'route' => 'user/profile/show',
	],
	[
		'label' => Yii::t('sw', 'Profile Settings'),
		'url'   => ['/user/settings/profile'],
		'route' => 'user/settings/profile',
	],
	[
		'label' => Yii::t('sw', 'Account Settings'),
		'url'   => ['/user/settings/account'],
		'route' => 'user/settings/account',
	],
];
?>

<nav aria-label="<?= Yii::t('sw.a11y', 'User Settings Navigation') ?>">
	<ul class="nav nav-pills card-header-pills">
		<?php foreach ($items as $item): ?>
			<?php $isActive = ($currentRoute === $item['route']); ?>
			<li class="nav-item">
				<?php if ($isActive): ?>
					<span
						class="nav-link active"
						aria-current="page">
						<?= Html::encode($item['label']) ?>
					</span>
				<?php else: ?>
					<?= Html::a(
						$item['label'],
						$item['url'],
						['class' => 'nav-link']
					) ?>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
