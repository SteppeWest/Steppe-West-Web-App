<?php
/**
 * @backend/views/layouts/main.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

/** @var \yii\web\View $this */
/** @var string $content */
/** @var frontend\assets\SwLetterAsset $asset */

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
	<?= $this->render('@backend/views/partials/head.php') ?>
</head>
<body class="sb-nav-fixed">
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
	];
	if (Yii::$app->user->isGuest) {
		$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
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
<?php $this->endPage(); ?>

<body>
	<?= $this->beginBody() ?>
	<?= $this->render('@app/modules/letter/layouts/header.php') ?>
	<?= $content ?>
	<?= $this->render('@app/modules/letter/layouts/footer.php') ?>
	<?= $this->endBody() ?>
</body>
