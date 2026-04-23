<?php
/**
 * @frontend/views/partials/_head_error.php
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

$errorAssetUrl = $this->params['errorAssetUrl'];

SwMeta::e($this);

Html::tag('title', 'Lost on the steppe: Steppe West 404 Error');
$this->registerCsrfMetaTags();
$this->head();
?>
