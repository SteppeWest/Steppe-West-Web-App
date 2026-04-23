<?php
/**
 * @frontend/views/layouts/main.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

use common\widgets\Alert;
use frontend\assets\AppAsset;

use frontend\helpers\SwMeta;

AppAsset::register($this);

$this->beginPage();

// App / page title
// $appName   = Yii::$app->name;
// $pageTitle = $this->title ?: '';
// $fullTitle = $pageTitle . ' – ' . $appName;

/**
 * $options Data Dictionary
 *
 * All accepted data is a flat dictionary of non-empty string keys
 * and non-empty string values.
 *
 * Data originating from params is treated as safe defaults.
 * Caller-supplied data is filtered before use.
 *
 * Only the keys listed below are consumed by this factory.
 * Unknown keys may be accepted into the merged options array,
 * but are ignored unless explicitly used by the registration logic.
 *
 * 'title'        => 'Page Title',             // from params
 * 'author'       => 'Page Author',            // from params
 * 'contentType'  => 'content-type',           // from params
 * 'description'  => 'Page description.',
 * 'keywords'     => 'Page keywords',
 * 'canonicalUrl' => 'http://steppewest.com/...',
 * 'updatedTime'  => 'timestamp',
 *
 * Override with extreme caution.
 *
 * 'locale'       => 'locale',                 // from params
 * 'viewport'     => 'viewport',               // from params
 */

$options = [];

// Build $options array according to the rules above.
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
<?php
	SwMeta::f($this, $options);
	echo Html::tag('title', $options['title'] ?? 'Steppe West');
	$this->registerCsrfMetaTags();
	$this->head();
?>
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
