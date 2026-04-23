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
use frontend\common\SwBanner;

/* @var $this yii\web\View */

$languages         = Yii::$app->params['swUiLanguages'];
$currentLang       = Yii::$app->language;
$searchPlaceholder = Yii::t('sw', 'Search') . '...';
$searchAriaLabel   = Yii::t('sw', 'Search');
?>
<div id="top-navigation">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="<?= Url::to(['/site/index']) ?>" aria-label="<?= Yii::$app->name ?>">
			<?= SwBanner::b()->s(6) ?>
		</a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
				id="sidebarToggle"
				aria-label="<?= Yii::t('sw.a11y', 'Toggle Navigation') ?>"
				type="button">
			<?= BI::i('list')->size(3) ?>
		</button>
		<!-- Navbar Search (placeholder for future search widget) -->
		<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
			action="#" role="search">
			<div class="input-group">
				<input class="form-control"
					type="search"
					placeholder="<?= $searchPlaceholder ?>"
					aria-label="<?= $searchAriaLabel ?>"
					aria-describedby="btnNavbarSearch"
					disabled>
				<button class="btn btn-primary" id="btnNavbarSearch" type="button" disabled>
					<?= BI::i('search') ?>
				</button>
			</div>
		</form>
		<!-- Navbar: user menu -->
		<?= $this->render('/partials/nav-top-user.php') ?>
	</nav>
</div>
