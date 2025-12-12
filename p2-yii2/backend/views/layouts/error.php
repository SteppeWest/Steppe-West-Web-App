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
use common\helpers\SwAssetHelper;

SwAssetHelper::registerAssets(SwAssetHelper::LAYOUT_ERROR);

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
