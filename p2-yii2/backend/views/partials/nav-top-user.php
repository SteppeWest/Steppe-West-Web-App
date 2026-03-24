<?php
/**
 * @backend/views/partials/nav-top-user.php
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
use p2m\rbac\helpers\P2GravatarHelper;
use common\helpers\SwLanguageUiHelper;

/* @var $this yii\web\View */

$metaAssetUrl = $this->params['metaAssetUrl'];
$languages    = Yii::$app->params['swUiLanguages'];
$currentLang  = Yii::$app->language;
$user = Yii::$app->user->identity;

// only use gravatar if a dedicated gravatar_email is set
$gravatarEmail = $user->profile->gravatar_email ?? null;
?>
<!-- Navbar: user menu -->
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center"
		   id="navbarDropdown"
		   href="#"
		   role="button"
		   data-bs-toggle="dropdown"
		   data-bs-auto-close="outside"
		   aria-expanded="false"
		   aria-label="<?= Yii::t('sw.a11y', 'User Menu') ?>">
			<?php if ($gravatarEmail): ?>
				<?= P2GravatarHelper::imgByEmail($gravatarEmail, [
					'class' => 'rounded-circle',
					'style' => 'width: 32px; height: 32px; object-fit: cover;',
				], 64) ?>
			<?php else: ?>
				<?= BI::i('person-circle')->size(4) ?>
			<?php endif; ?>
		</a>
		<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
			<li>
				<?= SwLanguageUiHelper::dropdownCollapse([
					'languages' => Yii::$app->params['swUiLanguages'],
				]) ?>
			</li>
			<li><hr class="dropdown-divider"></li>
			<li>
				<?= Html::a(
					BI::i('person') . ' ' . Yii::t('sw', 'Profile'),
					['/user/profile'],
					[
						'class' => 'dropdown-item',
						'encode' => false,
						'aria-label' => Yii::t('sw', 'Profile'),
					]
				) ?>
			</li>
			<li>
				<?= Html::a(
					BI::i('gear') . ' ' . Yii::t('sw', 'Settings'),
					['/user/settings'],
					[
						'class' => 'dropdown-item',
						'encode' => false,
						'aria-label' => Yii::t('sw', 'Settings'),
					]
				) ?>
			</li>
			<li>
				<a class="dropdown-item" href="#!" aria-label="<?= Yii::t('sw', 'Activity Log') ?>">
					<?= BI::i('activity') . ' ' . Yii::t('sw', 'Activity Log') ?>
				</a>
			</li>
			<li><hr class="dropdown-divider"></li>
			<li>
				<?php
					echo Html::beginForm(['/user/security/logout'], 'post', [
						'class' => 'm-0', // keep it tidy in dropdown
					]);

					echo Html::submitButton(
						BI::i('box-arrow-left') . ' ' . Yii::t('sw', 'Logout'),
						[
							'class' => 'dropdown-item',
							'encode' => false,
							'aria-label' => Yii::t('sw', 'Logout'),
						]
					);

					echo Html::endForm();
				?>
			</li>
		</ul>
	</li>
</ul>
