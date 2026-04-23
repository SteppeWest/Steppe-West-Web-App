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
use frontend\helpers\SwMeta;

/** @var yii\web\View $this */
/** @var string|null  $title */

// App / page title
//$appName   = Yii::$app->name;
//$pageTitle = $this->title ?: '';
//$fullTitle = $pageTitle . ' – ' . $appName;

$options = [];



SwMeta::f($this, $options);

Html::tag('title', $options['title']);
$this->registerCsrfMetaTags();
$this->head();
