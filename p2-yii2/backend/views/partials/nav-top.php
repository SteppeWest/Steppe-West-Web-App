<?php
/**
 * @backend/views/partials/nav-top.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use p2m\helpers\BI;
use p2m\helpers\FI;

/* @var $this yii\web\View */

$metaAssetUrl      = $this->params['metaAssetUrl'];
$languages         = Yii::$app->params['swUiLanguages'];
$currentLang       = Yii::$app->language;
$searchPlaceholder = Yii::t('admin', 'Search') . '...';
$searchAriaLabel   = Yii::t('admin', 'Search');
?>
<div id="top-navigation">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="<?= Url::to(['/site/index']) ?>" aria-label="<?= Yii::$app->name ?>">
			<?= Html::img(
				$metaAssetUrl . '/img/flags-banner-180w.png',
				[
					'alt' => Yii::$app->name,
					'class' => 'sb-topnav-brand-img',
				]
			) ?>
		</a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
				id="sidebarToggle"
				aria-label="<?= Yii::t('admin.a11y', 'Toggle Navigation') ?>"
				type="button">
			<?= BI::i('list')->size(3) ?>
		</button>
		<!-- Navbar Search (placeholder for future search widget) -->
		<?= $this->render('/partials/nav-search.php') ?>
		<!-- Navbar: user menu -->
		<?= $this->render('/partials/nav-user.php') ?>
	</nav>
</div>
