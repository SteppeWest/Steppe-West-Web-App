<?php
/**
 * @frontend/views/letter/partials/head.php
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
$page = $this->params['page'];
$lang = $this->params['lang'];
$asset = $this->params['asset'];

// Canonical URL and Open Graph/Twitter Image Paths
$canonicalUrl = Yii::$app->homeUrl . "{$slug}/{$lc}";
$locale = $lang->locale ?? 'en_AU';
$title = Html::encode($page->title);
$keywords = Html::encode($page->keywords);
$description = Html::encode($page->description);
$imageUrl = $asset->baseUrl . '/img';
$iconUrl = $asset->baseUrl . '/ico';
?>

<meta charset="<?= Yii::$app->charset ?>">
<!-- Canonical link -->
<link rel="canonical" href="<?= $canonicalUrl ?>"><!-- DATA -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Meta tags for SEO -->
<meta name="description" content="<?= $description ?>"><!-- DATA -->
<meta name="keywords" content="<?= $keywords ?>"><!-- DATA -->
<meta name="author" content="Pedro Plowman for Steppe West">
<!-- Open Graph Meta Tags -->
<meta property="og:type" content="article"><!-- DATA -->
<meta property="og:url" content="<?= $canonicalUrl ?>"><!-- DATA -->
<meta property="og:title" content="<?= $title ?>"><!-- DATA -->
<meta property="og:description" content="<?= $description ?>"><!-- DATA -->
<meta property="og:image" content="<?= $imageUrl ?>/og_image_01-1200x0630.jpeg">
<meta property="og:image" content="<?= $imageUrl ?>/og_image_02-1200x0630.jpeg">
<meta property="og:updated_time" content="2024-07-08"><!-- DATA -->
<meta property="og:locale" content="<?= $locale ?>"><!-- DATA -->

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $canonicalUrl ?>"><!-- DATA -->
<meta property="twitter:title" content="<?= $title ?>"><!-- DATA -->
<meta property="twitter:description" content="<?= $description ?>"><!-- DATA -->
<meta property="twitter:image" content="<?= $imageUrl ?>/og_image_01-1200x0630.jpeg">
<meta property="twitter:image" content="<?= $imageUrl ?>/og_image_02-1200x0630.jpeg">

<!-- Favicon-->
<link rel="apple-touch-icon" sizes="180x180" href="<?= $iconUrl ?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= $iconUrl ?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $iconUrl ?>/favicon-16x16.png">
<link rel="manifest" href="<?= $iconUrl ?>/site.webmanifest">
<link rel="mask-icon" href="<?= $iconUrl ?>/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="<?= $iconUrl ?>/favicon.ico">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="<?= $iconUrl ?>/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<title><?= $title ?></title><!-- DATA -->

<?php $this->registerCsrfMetaTags() ?>
<?php $this->head() ?>
