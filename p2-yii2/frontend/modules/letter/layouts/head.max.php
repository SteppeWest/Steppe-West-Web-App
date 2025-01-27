<?php
/**
 * @frontend/modules/letter/layouts/head.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $page common\models\SwLanguagePage */
/* @var $slug string */
/* @var $lc string */

$slug = $this->params['slug'];
$lc = $this->params['lc'];
$canonicalUrl = $this->params['canonicalUrl'];
$title = $this->params['title'];
$locale = $this->params['locale'];
$keywords = $this->params['keywords'];
$description = $this->params['description'];
$metaAssetUrl = $this->params['metaAssetUrl'];

$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
// Canonical link
$this->registerLinkTag(['rel' => 'canonical', 'href' => $canonicalUrl]);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
// Meta tags for SEO
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
$this->registerMetaTag(['name' => 'author', 'content' => 'Pedro Plowman for Steppe West']);
// Open Graph Meta Tags
$this->registerMetaTag(['property' => 'og:type', 'content' => 'article']);
$this->registerMetaTag(['property' => 'og:url', 'content' => $canonicalUrl]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
$this->registerMetaTag(['property' => 'og:image', 'content' => $metaAssetUrl . '/img/og_image_01-1200x0630.jpeg']);
$this->registerMetaTag(['property' => 'og:image', 'content' => $metaAssetUrl . '/img/og_image_02-1200x0630.jpeg']);
$this->registerMetaTag(['property' => 'og:updated_time', 'content' => '2024-07-08']);
$this->registerMetaTag(['property' => 'og:locale', 'content' => $locale]);
// Twitter
$this->registerMetaTag(['property' => 'twitter:card', 'content' => 'summary_large_image']);
$this->registerMetaTag(['property' => 'twitter:url', 'content' => $canonicalUrl]);
$this->registerMetaTag(['property' => 'twitter:title', 'content' => $title]);
$this->registerMetaTag(['property' => 'twitter:description', 'content' => $description]);
$this->registerMetaTag(['property' => 'twitter:image', 'content' => $metaAssetUrl . '/img/og_image_01-1200x0630.jpeg']);
$this->registerMetaTag(['property' => 'twitter:image', 'content' => $metaAssetUrl . '/img/og_image_02-1200x0630.jpeg']);
// Favicon
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
