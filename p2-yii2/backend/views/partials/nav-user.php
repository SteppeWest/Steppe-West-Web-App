<?php
/**
 * @backend/views/partials/nav-user.php
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
<!-- Navbar: user menu -->
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle"
		   id="navbarDropdown"
		   href="#"
		   role="button"
		   data-bs-toggle="dropdown"
		   data-bs-auto-close="outside"
		   aria-expanded="false"
		   aria-label="<?= Yii::t('admin.a11y', 'User Menu') ?>">
			<?= BI::i('person-circle')->size(4) ?>
		</a>
		<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

			<li>
				<a class="dropdown-item" data-bs-toggle="collapse"
				   href="#langMenu" role="button" type="button"
				   aria-label="<?= Yii::t('admin.a11y', 'Select Language') ?>"
				   aria-expanded="false" aria-controls="langMenu">
					<?= BI::i('translate') . ' ' . Yii::t('admin.nav', 'Language') ?>
				</a>
				<div class="collapse" id="langMenu">
					<ul class="list-unstyled mb-0">
						<?php
							foreach ($languages as $code => $meta) {
								echo Html::a(
									'<span>' . FI::i($meta['flag']) . ' ' . $meta['label'] . '</span>' .
									($code === $currentLang ? BI::i('check') : ''),
									['/site/set-language', 'lang' => $code],
									[
										'class' => 'dropdown-item ps-4 d-flex justify-content-between align-items-center',
										'encode' => false,
										'data-sw-lang' => '1',
									],
								);
							}
						?>
					</ul>
				</div>
			</li>

			<li><hr class="dropdown-divider"></li>
			<li>
				<a class="dropdown-item" href="#!" aria-label="<?= Yii::t('admin.nav', 'Settings') ?>">
					<?= BI::i('gear') . ' ' . Yii::t('admin.nav', 'Settings') ?>
				</a>
			</li>
			<li>
				<a class="dropdown-item" href="#!" aria-label="<?= Yii::t('admin.nav', 'Activity Log') ?>">
					<?= BI::i('activity') . ' ' . Yii::t('admin.nav', 'Activity Log') ?>
				</a>
			</li>
			<li><hr class="dropdown-divider"></li>
			<li>
				<?= Html::a(
					BI::i('box-arrow-left') . ' ' . Yii::t('admin.nav', 'Logout'),
					['/user/security/logout'],
					[
						'class' => 'dropdown-item',
						'encode' => false,
						'aria-label' => Yii::t('admin.nav', 'Logout'),
						'data' => ['method' => 'post'],
					]
				) ?>
			</li>
		</ul>
	</li>
</ul>
