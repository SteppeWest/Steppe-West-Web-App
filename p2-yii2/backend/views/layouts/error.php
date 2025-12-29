<?php
/**
 * @backend/views/layouts/error.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use common\assets\SwMetaAsset;
use p2m\admin\assets\P2SBAdminAsset;

$this->params['metaAssetUrl'] = SwMetaAsset::register($this)->baseUrl;
$this->params['themeAssetUrl'] = P2SBAdminAsset::register($this)->baseUrl;

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
	<?= $this->render('@backend/views/partials/head.php') ?>
</head>
<body>
<!-- <body class="bg-dark"> -->
	<?php $this->beginBody(); ?>

	<?= $content ?>

	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
