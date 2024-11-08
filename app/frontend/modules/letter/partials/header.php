<?php
/**
 * @frontend/views/letter/partials/header.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

$page = $this->params['page'];
$lang = $this->params['lang'];

$title = Html::encode($page->title);
?>
<header>
	<?php
	NavBar::begin([
		'brandLabel' => Yii::$app->name,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar navbar-dark bg-dark navbar-expand-lg',
		],
	]);
	?>
	<div class="container">
		<button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php
			$menuItems = [
				['label' => '🇬🇧 EN', 'url' => ['/site/index/EN']],
				['label' => '🇷🇺 RU', 'url' => ['/site/index/RU']],
				['label' => '🇰🇬 KG', 'url' => ['/site/index/KG']],
				['label' => '🇰🇿 KZ', 'url' => ['/site/index/KZ']],
				['label' => '🇹🇯 TJ', 'url' => ['/site/index/TJ']],
				['label' => '🇹🇲 TM', 'url' => ['/site/index/TM']],
				['label' => '🇺🇿 UZ', 'url' => ['/site/index/UZ']],
				['label' => '🇦🇿 AZ', 'url' => ['/site/index/AZ']],
				['label' => '🇲🇳 MN', 'url' => ['/site/index/MN']],
			];

			echo Nav::widget([
				'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-lg-0'],
				'items' => $menuItems,
			]);
			?>
		</div>
	</div>
	<?php
	NavBar::end();
	?>
	<div class="my-5 text-center">
		<div id="title">
			<h1 class="fw-bolder mb-0 text-white fs-2"><?= $title ?></h1>
			<h2 class="fw-bolder mb-0 text-white fs-3">Join us on a journey of cultural exchange and discovery</h2>
		</div>
	</div>
</header>
