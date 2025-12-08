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

/* @var $this yii\web\View */

// App / page title
$appName   = Yii::$app->name ?: 'Steppe West HQ';
$pageTitle = $title ?: ($this->title ?: 'Dashboard');
$fullTitle = $pageTitle . ' – ' . $appName;
$metaAssetUrl = $this->params['metaAssetUrl'];

$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Steppe West admin pages']);
$this->registerMetaTag(['name' => 'author', 'content' => 'Pedro Plowman for Steppe West']);

// Favicon // we probably don't need all of these
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => $metaAssetUrl . '/ico/apple-touch-icon.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => $metaAssetUrl . '/ico/favicon-32x32.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => $metaAssetUrl . '/ico/favicon-16x16.png']);
$this->registerLinkTag(['rel' => 'manifest', 'href' => $metaAssetUrl . '/ico/site.webmanifest']);
$this->registerLinkTag(['rel' => 'mask-icon', 'href' => $metaAssetUrl . '/ico/safari-pinned-tab.svg', 'color' => '#5bbad5']);
$this->registerLinkTag(['rel' => 'shortcut icon', 'href' => $metaAssetUrl . '/ico/favicon.ico']);
$this->registerMetaTag(['name' => 'msapplication-TileColor', 'content' => '#da532c']);
$this->registerMetaTag(['name' => 'msapplication-config', 'content' => $metaAssetUrl . '/ico/browserconfig.xml']);
$this->registerMetaTag(['name' => 'theme-color', 'content' => '#ffffff']);
?>
<title><?= $title ?></title><!-- DATA -->
<?php $this->registerCsrfMetaTags() ?>
<?php $this->head() ?>
