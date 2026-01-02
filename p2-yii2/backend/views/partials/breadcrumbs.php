<?php
/**
 * @backend/views/partials/breadcrumbs.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Breadcrumbs;

/** @var yii\web\View $this */

echo Breadcrumbs::widget([
	'homeLink' => [
		'label' => Yii::t('admin.nav', 'Dashboard'),
		'url'   => Yii::$app->homeUrl,
	],
	'links' => $this->params['breadcrumbs'] ?? [],
	//'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
