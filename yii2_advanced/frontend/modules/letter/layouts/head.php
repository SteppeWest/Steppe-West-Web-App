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
?><meta charset="<?= Yii::$app->charset ?>"><link href="<?= $canonicalUrl ?>"rel="canonical"><meta content="width=device-width,initial-scale=1,shrink-to-fit=no"name="viewport"><meta content="<?= $description ?>"name="description"><meta content="<?= $keywords ?>"name="keywords"><meta content="Pedro Plowman for Steppe West"name="author"><meta content="article"property="og:type"><meta content="<?= $canonicalUrl ?>"property="og:url"><meta content="<?= $title ?>"property="og:title"><meta content="<?= $description ?>"property="og:description"><meta content="<?= $metaAssetUrl ?>/img/og_image_01-1200x0630.jpeg"property="og:image"><meta content="<?= $metaAssetUrl ?>/img/og_image_02-1200x0630.jpeg"property="og:image"><meta content="2024-07-08"property="og:updated_time"><meta content="<?= $locale ?>"property="og:locale"><meta content="summary_large_image"property="twitter:card"><meta content="<?= $canonicalUrl ?>"property="twitter:url"><meta content="<?= $title ?>"property="twitter:title"><meta content="<?= $description ?>"property="twitter:description"><meta content="<?= $metaAssetUrl ?>/img/og_image_01-1200x0630.jpeg"property="twitter:image"><meta content="<?= $metaAssetUrl ?>/img/og_image_02-1200x0630.jpeg"property="twitter:image"><link href="<?= $metaAssetUrl ?>/ico/apple-touch-icon.png"rel="apple-touch-icon"sizes="180x180"><link href="<?= $metaAssetUrl ?>/ico/favicon-32x32.png"rel="icon"sizes="32x32"type="image/png"><link href="<?= $metaAssetUrl ?>/ico/favicon-16x16.png"rel="icon"sizes="16x16"type="image/png"><link href="<?= $metaAssetUrl ?>/ico/site.webmanifest"rel="manifest"><link href="<?= $metaAssetUrl ?>/ico/safari-pinned-tab.svg"rel="mask-icon"color="#5bbad5"><link href="<?= $metaAssetUrl ?>/ico/favicon.ico"rel="shortcut icon"><meta content="#da532c"name="msapplication-TileColor"><meta content="<?= $metaAssetUrl ?>/ico/browserconfig.xml"name="msapplication-config"><meta content="#ffffff"name="theme-color"><title><?= $title ?></title><?php $this->registerCsrfMetaTags() ?><?php $this->head() ?>
