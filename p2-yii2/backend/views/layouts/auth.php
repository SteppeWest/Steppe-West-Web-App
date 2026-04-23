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
	<?= $this->render('_head.php') ?>
</head>
<body data-bs-theme="dark">
	<?php $this->beginBody(); ?>
		<div id="steppe-west-hq-auth" class="container-fluid ps-md-0">
			<div class="row g-0">
				<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
				<div class="col-md-8 col-lg-6">
					<div class="login d-flex align-items-center py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-9 col-lg-8 mx-auto">
									<!-- SITE CONTENT -->
									<?= $content ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
