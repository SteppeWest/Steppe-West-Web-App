<?php
/**
 * @frontend/views/partials/main.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
	<?= $this->render('_head.php') ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
	<?php
	NavBar::begin([
		'brandLabel' => Yii::$app->name,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
		],
	]);
	$menuItems = [
		['label' => 'Home', 'url' => ['/site/index']],
		['label' => 'About', 'url' => ['/site/about']],
		['label' => 'Contact', 'url' => ['/site/contact']],
	];
	if (Yii::$app->user->isGuest) {
		$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
	}

	echo Nav::widget([
		'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
		'items' => $menuItems,
	]);
	if (Yii::$app->user->isGuest) {
		echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
	} else {
		echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
			. Html::submitButton(
				'Logout (' . Yii::$app->user->identity->username . ')',
				['class' => 'btn btn-link logout text-decoration-none']
			)
			. Html::endForm();
	}
	NavBar::end();
	?>
</header>

<main role="main" class="flex-shrink-0">
	<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</main>

<footer class="footer mt-auto py-3 text-muted">
	<div class="container">
		<p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
		<p class="float-end"><?= Yii::powered() ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
?>



<?php
/**
 * @backend/views/layouts/main.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use common\assets\SwMetaAsset;
use p2m\admin\assets\P2SBAdminAsset;

$this->params['themeAssetUrl'] = P2SBAdminAsset::register($this)->baseUrl;

/** @var \yii\web\View $this */
/** @var string $content */

/**
	// Store variables in $this->params to make them available in partials
		$this->params['page'] = $page;
		$this->params['asset'] = $asset;
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
</head>
<body id="steppe-west-hq" class="sb-nav-fixed">
	<?php $this->beginBody() ?>
	<?= $this->render('/partials/nav-top.php') ?>
	<div id="layoutSidenav">
		<?= $this->render('/partials/nav-side.php') ?>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">
					<?= $content ?>
				</div>
			</main>
			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid px-4">
					<div class="d-flex align-items-center justify-content-between small">
						<!-- footer - not used -->
					</div>
				</div>
			</footer>
		</div>
	</div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
