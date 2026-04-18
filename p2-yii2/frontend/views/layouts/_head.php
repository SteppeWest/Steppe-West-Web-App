<?php
/**
 * @frontend/views/partials/_head.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var string|null  $title */

// App / page title
//$appName   = Yii::$app->name;
//$pageTitle = $this->title ?: '';
//$fullTitle = $pageTitle . ' – ' . $appName;

//$metaAssetUrl  = $this->params['metaAssetUrl'];
//$errorAssetUrl = $this->params['errorAssetUrl'];

$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
$this->registerMetaTag([
	'name' => 'viewport',
	'content' => 'width=device-width,
	initial-scale=1, shrink-to-fit=no'
]);
Html::tag('title', $this->title);
$this->registerCsrfMetaTags();
$this->head();
?>
