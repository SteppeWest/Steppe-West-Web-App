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

SwMeta::f($this, $options);

echo Html::tag('title', $options['title']);
$this->registerCsrfMetaTags();
$this->head();
