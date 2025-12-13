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
use yii\helpers\Url;
use p2m\helpers\BI;

/* @var $this yii\web\View */

$controller = Yii::$app->controller->id;
$action     = Yii::$app->controller->action->id;

$currentRoute = $controller . '/' . $action;

$mkLink = function (string $label, array|string $route, string $icon = null, bool $active = false) {
	$iconHtml = $icon ? '<div class="sb-nav-link-icon">' . BI::i($icon) . '</div>' : '';
	return Html::a(
		$iconHtml . Html::encode($label),
		$route,
		['class' => 'nav-link' . ($active ? ' active' : '')]
	);
};

$mkToggle = function (string $label, string $targetId, string $icon = null, bool $expanded = false) {
	$iconHtml = $icon ? '<div class="sb-nav-link-icon">' . BI::i($icon) . '</div>' : '';
	return Html::a(
		$iconHtml
		. Html::encode($label)
		. '<div class="sb-sidenav-collapse-arrow">' . BI::i('chevron-down') . '</div>',
		'#',
		[
			'class' => 'nav-link collapsed',
			'data-bs-toggle' => 'collapse',
			'data-bs-target' => '#' . $targetId,
			'aria-expanded' => $expanded ? 'true' : 'false',
			'aria-controls' => $targetId,
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
				<div class="sb-sidenav-menu-heading">Core</div>

				<?= $mkLink('Dashboard', ['/site/index'], 'speedometer2', $controller === 'site' && $action === 'index') ?>

				<!-- You can start adding real admin items now -->
				<div class="sb-sidenav-menu-heading">Users</div>

				<?= $mkLink('Manage Users', ['/user/admin'], 'people', $controller === 'admin' && str_starts_with(Yii::$app->controller->module->id ?? '', 'user')) ?>
				<?= $mkLink('Roles', ['/user/role'], 'person-badge', $controller === 'role') ?>
				<?= $mkLink('Permissions', ['/user/permission'], 'key', $controller === 'permission') ?>
				<?= $mkLink('Rules', ['/user/rule'], 'key', $controller === 'rule') ?>

				<!-- Interface -->
				<div class="sb-sidenav-menu-heading">Interface</div>

				<?= $mkToggle('Layouts', 'collapseLayouts', 'columns-gap', $uiOpen) ?>

				<div class="collapse<?= $uiOpen ? ' show' : '' ?>"
				     id="collapseLayouts"
				     aria-labelledby="headingLayouts"
				     data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<?= Html::a('Static Navigation', '#!', ['class' => 'nav-link']) ?>
						<?= Html::a('Light Sidenav', '#!', ['class' => 'nav-link']) ?>
					</nav>
				</div>

				<?= $mkToggle('Pages', 'collapsePages', 'file-earmark-text', $uiOpen) ?>

				<div class="collapse<?= $uiOpen ? ' show' : '' ?>"
				     id="collapsePages"
				     aria-labelledby="headingPages"
				     data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

						<!-- Nested (4th-level links) example -->
						<?= Html::a('Authentication (placeholder)', '#!', ['class' => 'nav-link']) ?>
						<?= Html::a('Error (placeholder)', '#!', ['class' => 'nav-link']) ?>

					</nav>
				</div>

				<!-- Addons -->
				<div class="sb-sidenav-menu-heading">Addons</div>

				<?= $mkLink('Charts', '#!', 'bar-chart-line', $controller === 'charts') ?>
				<?= $mkLink('Tables', '#!', 'table', $controller === 'tables') ?>

			</div>
		</div>
		<div class="sb-sidenav-footer">
			<div class="small">Logged in as:</div>
			<?= Html::encode(Yii::$app->user->identity->username) ?>
		</div>
	</nav>
</div>
