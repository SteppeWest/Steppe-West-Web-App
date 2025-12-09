<?php
/**
 * @backend/views/partials/head.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use common\helpers\SwAssetHelper;

/** @var yii\web\View $this */
/** @var string|null  $title */

// App / page title
$appName   = Yii::$app->name;
$pageTitle = $this->title ?: 'Dashboard';
$fullTitle = $pageTitle . ' – ' . $appName;

$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Steppe West admin pages']);
$this->registerMetaTag(['name' => 'author', 'content' => 'Pedro Plowman for Steppe West']);

// Favicon // we probably don't need all of these
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => SwAssetHelper::fileURL('/ico/apple-touch-icon.png')]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => SwAssetHelper::fileURL('/ico/favicon-32x32.png')]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => SwAssetHelper::fileURL('/ico/favicon-16x16.png')]);
$this->registerLinkTag(['rel' => 'manifest', 'href' => SwAssetHelper::fileURL('/ico/site.webmanifest')]);
$this->registerLinkTag(['rel' => 'mask-icon', 'href' => SwAssetHelper::fileURL('/ico/safari-pinned-tab.svg'), 'color' => '#5bbad5']);
$this->registerLinkTag(['rel' => 'shortcut icon', 'href' => SwAssetHelper::fileURL('/ico/favicon.ico')]);
$this->registerMetaTag(['name' => 'msapplication-TileColor', 'content' => '#da532c']);
$this->registerMetaTag(['name' => 'msapplication-config', 'content' => SwAssetHelper::fileURL('/ico/browserconfig.xml')]);
$this->registerMetaTag(['name' => 'theme-color', 'content' => '#ffffff']);
?>
<title><?= $fullTitle ?></title><!-- DATA -->
<?php $this->registerCsrfMetaTags() ?>
<?php $this->head() ?>
