<?php
/**
 * @backend/views/partials/nav-side.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use p2m\helpers\BI;

/* @var $this yii\web\View */

$controller = Yii::$app->controller->id;
$action     = Yii::$app->controller->action->id;

$currentRoute = $controller . '/' . $action;

$mkLink = function (string $label, array|string $route, string $icon = null, bool $active = false) {
	$iconHtml = $icon ? '<div class="sb-nav-link-icon">' . BI::i($icon) . '</div>' : '';
	return Html::a(
		$iconHtml . $label,
		$route,
		[
			'class' => 'nav-link' . ($active ? ' active' : ''),
			'encode' => false,
		]
	);
};

$mkToggle = function (string $label, string $targetId, string $icon = null, bool $expanded = false) {
	$iconHtml = $icon ? '<div class="sb-nav-link-icon">' . BI::i($icon) . '</div>' : '';
	return Html::a(
		$iconHtml
		. $label
		. '<div class="sb-sidenav-collapse-arrow">' . BI::i('chevron-down') . '</div>',
		'#',
		[
			'class' => 'nav-link collapsed',
			'data-bs-toggle' => 'collapse',
			'data-bs-target' => '#' . $targetId,
			'aria-expanded' => $expanded ? 'true' : 'false',
			'aria-controls' => $targetId,
			'aria-label' => $label,
			'encode' => false,
		]
	);
};

// Decide which collapses should be open based on current route
$uiOpen      = in_array($controller, ['layout', 'pages'], true);
$addonsOpen  = in_array($controller, ['charts', 'tables'], true);
?>
<div id="layoutSidenav_nav">
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
		<div class="sb-sidenav-menu">
			<div class="nav">

				<!-- Core -->
				<div class="sb-sidenav-menu-heading"><?= Yii::t('admin.nav', 'Core') ?></div>

				<?= $mkLink(Yii::t('admin.nav', 'Dashboard'), ['/site/index'], 'speedometer2', $controller === 'site' && $action === 'index') ?>

				<!-- Users -->
				<div class="sb-sidenav-menu-heading"><?= Yii::t('admin.nav', 'Users') ?></div>

				<?= $mkLink(Yii::t('admin.nav', 'Users'), ['/user/admin'], 'people', $controller === 'admin' && str_starts_with(Yii::$app->controller->module->id ?? '', 'user')) ?>
				<?= $mkLink(Yii::t('admin.nav', 'Roles'), ['/user/role'], 'person-badge', $controller === 'role') ?>
				<?= $mkLink(Yii::t('admin.nav', 'Permissions'), ['/user/permission'], 'key', $controller === 'permission') ?>
				<?= $mkLink(Yii::t('admin.nav', 'Rules'), ['/user/rule'], 'key', $controller === 'rule') ?>

				<!-- Interface -->
				<div class="sb-sidenav-menu-heading"><?= Yii::t('admin.demo', 'Interface') ?></div>

				<?= $mkToggle(Yii::t('admin.demo', 'Layouts'), 'collapseLayouts', 'columns-gap', $uiOpen) ?>

				<div class="collapse<?= $uiOpen ? ' show' : '' ?>"
				     id="collapseLayouts"
				     data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<?= Html::a(Yii::t('admin.demo', 'Static Navigation'), '#!', ['class' => 'nav-link']) ?>
						<?= Html::a(Yii::t('admin.demo', 'Light Sidenav'), '#!', ['class' => 'nav-link']) ?>
					</nav>
				</div>

				<?= $mkToggle(Yii::t('admin.demo', 'Pages'), 'collapsePages', 'file-earmark-text', $uiOpen) ?>

				<div class="collapse<?= $uiOpen ? ' show' : '' ?>"
				     id="collapsePages"
				     data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
						<?= Html::a(Yii::t('admin.demo', 'Authentication'), '#!', ['class' => 'nav-link']) ?>
						<?= Html::a(Yii::t('admin.demo', 'Error'), '#!', ['class' => 'nav-link']) ?>
					</nav>
				</div>

				<!-- Addons -->
				<div class="sb-sidenav-menu-heading"><?= Yii::t('admin.nav', 'Addons') ?></div>

				<?= $mkLink(Yii::t('admin.demo', 'Charts'), '#!', 'bar-chart-line', $controller === 'charts') ?>
				<?= $mkLink(Yii::t('admin.demo', 'Tables'), '#!', 'table', $controller === 'tables') ?>

			</div>
		</div>

		<div class="sb-sidenav-footer">
			<div class="small"><?= Yii::t('admin', 'Logged in as:') ?></div>
			<?= Yii::$app->user->isGuest ? 'konok' : Html::encode(Yii::$app->user->identity->username) ?>
		</div>
	</nav>
</div>
