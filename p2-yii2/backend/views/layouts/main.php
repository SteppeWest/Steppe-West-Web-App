<?php
/**
 * @backend/views/layouts/main.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use common\helpers\SwAssetHelper;

SwAssetHelper::registerAssets(SwAssetHelper::LAYOUT_MAIN);

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
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
	<?= $this->render('@backend/views/partials/head.php') ?>
</head>
<body id="steppe-west-hq" class="sb-nav-fixed">
	<?php $this->beginBody() ?>
	<?= $this->render('@backend/views/partials/nav-top.php') ?>
	<div id="layoutSidenav">
		<?= $this->render('@backend/views/partials/nav-side.php') ?>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">
					<?= $content ?>
				</div>
			</main>
			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid px-4">
					<div class="d-flex align-items-center justify-content-between small">
						<!-- footer - not used -->
					</div>
				</div>
			</footer>
		</div>
	</div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
