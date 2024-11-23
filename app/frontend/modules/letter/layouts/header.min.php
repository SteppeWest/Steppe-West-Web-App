<?php
/**
 * @frontend/modules/letter/layouts/header.php
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
?><header><?php NavBar::begin([
		'brandLabel' => Yii::$app->name,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar navbar-dark bg-dark navbar-expand-lg',
		],
	]); ?><div class="container"><button aria-controls="navbarSupportedContent"aria-expanded="false"aria-label="Toggle navigation"class="navbar-toggler"data-bs-target="#navbarSupportedContent"data-bs-toggle="collapse"type="button"><span class="navbar-toggler-icon"></span></button><div class="collapse navbar-collapse"id="navbarSupportedContent"><?php echo Nav::widget(['options'=>['class'=>'navbar-nav ms-auto mb-2 mb-lg-0'],'items'=>$this->params['langMenu'],'activateItems'=>true,]); ?></div></div><?php NavBar::end(); ?><div class="my-5 text-center"><div id="title"><h1 class="fw-bolder mb-0 text-white fs-2"><?= $this->params['title'] ?></h1><?php if (!empty($this->params['subtitle'])): ?><h2 class="fw-bolder mb-0 text-white fs-3"><?= $this->params['subtitle'] ?></h2><?php endif; ?></div></div></header>
