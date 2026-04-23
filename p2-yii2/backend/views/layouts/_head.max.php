<?php
/**
 * @backend/views/_head.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use backend\helpers\SwMeta;

/** @var yii\web\View $this */
/** @var string|null  $title */

// App / page title
$appName   = Yii::$app->name;
$pageTitle = $this->title ?: 'Dashboard';
$fullTitle = $pageTitle . ' – ' . $appName;

SwMeta::b($this);

Html::tag('title', $this->title);

$this->registerCsrfMetaTags();
$this->head();
