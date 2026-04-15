

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

/** @var yii\web\View $this */
/** @var string|null  $title */

// App / page title
$appName   = Yii::$app->name;
$pageTitle = $this->title ?: 'Dashboard';
$fullTitle = $pageTitle . ' – ' . $appName;

$metaAssetUrl  = $this->params['metaAssetUrl'];
$themeAssetUrl = $this->params['themeAssetUrl'];

$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
$this->registerMetaTag([
	'name' => 'viewport',
	'content' => 'width=device-width,
	initial-scale=1, shrink-to-fit=no'
]);
$this->registerMetaTag([
	'name' => 'description',
	'content' => 'Steppe West admin pages'
]);
$this->registerMetaTag([
	'name' => 'author',
	'content' => 'Pedro Plowman for Steppe West'
]);

// Favicon // we probably don't need all of these
$this->registerLinkTag([
	'rel' => 'apple-touch-icon', 'sizes' => '180x180',
	'href' => $metaAssetUrl . '/ico/apple-touch-icon.png'
]);
$this->registerLinkTag([
	'rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32',
	'href' => $metaAssetUrl . '/ico/favicon-32x32.png'
]);
$this->registerLinkTag([
	'rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16',
	'href' => $metaAssetUrl . '/ico/favicon-16x16.png'
]);
$this->registerLinkTag([
	'rel' => 'manifest',
	'href' => $metaAssetUrl . '/ico/site.webmanifest'
]);
$this->registerLinkTag([
	'rel' => 'mask-icon', 'color' => '#5bbad5',
	'href' => $metaAssetUrl . '/ico/safari-pinned-tab.svg'
]);
$this->registerLinkTag([
	'rel' => 'shortcut icon',
	'href' => $metaAssetUrl . '/ico/favicon.ico'
]);
$this->registerMetaTag([
	'name' => 'msapplication-config',
	'content' => $metaAssetUrl . '/ico/browserconfig.xml'
]);
$this->registerMetaTag(['name' => 'msapplication-TileColor', 'content' => '#da532c']);
$this->registerMetaTag(['name' => 'theme-color', 'content' => '#ffffff']);
?>
<title><?= $fullTitle ?></title><!-- DATA -->
<?php
	$this->registerCsrfMetaTags();
	$this->head();
?>



<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php $this->registerCsrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
