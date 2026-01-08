<?php
/**
 * @backend/views/layouts/auth.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use common\assets\SwMetaAsset;
use common\assets\SwAlternateAsset;

$this->params['metaAssetUrl']  = SwMetaAsset::register($this)->baseUrl;
$this->params['themeAssetUrl'] = SwAlternateAsset::register($this)->baseUrl;

/** @var \yii\web\View $this */
/** @var string $content */

/**
	// Store variables in $this->params to make them available in partials
		$this->params['page'] = $page;
		$this->params['asset'] = $asset;
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<?= $this->render('/partials/head.php') ?>
</head>
<body data-bs-theme="dark">
<!-- <body class="bg-dark"> -->
	<?php $this->beginBody(); ?>
		<?= $content ?>
	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
