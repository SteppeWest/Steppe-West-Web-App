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

/* @var $this yii\web\View */
?>
<div id="top-navigation">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="<?= Url::to(['/site/index']) ?>">
			<?= Html::encode(Yii::$app->name) ?>
		</a>

		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
				id="sidebarToggle"
				type="button">
			<?= BI::i('list')->size(3) ?>
		</button>

		<!-- Navbar Search (placeholder for future search widget) -->
		<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
			action="#" role="search">
			<div class="input-group">
				<input class="form-control"
					type="search"
					placeholder="Search (coming soon)..."
					aria-label="Search (coming soon)..."
					aria-describedby="btnNavbarSearch"
					disabled>
				<button class="btn btn-primary" id="btnNavbarSearch" type="button" disabled>
					<?= BI::i('search') ?>
				</button>
			</div>
		</form>

		<!-- Navbar: user menu -->
		<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle"
				   id="navbarDropdown"
				   href="#"
				   role="button"
				   data-bs-toggle="dropdown"
				   aria-expanded="false">
					<?= BI::i('person-circle')->size(4) ?>
				</a>
				<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
					<li>
						<a class="dropdown-item" href="#!">
							Settings (coming soon)
						</a>
					</li>
					<li>
						<a class="dropdown-item" href="#!">
							Activity Log (coming soon)
						</a>
					</li>
					<li><hr class="dropdown-divider"></li>
					<li>
						<?= Html::a('Logout', ['/user/security/logout'], [ // /user/security/logout or /site/logout
							'class' => 'dropdown-item',
							'data-method' => 'post',
						]) ?>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</div>
