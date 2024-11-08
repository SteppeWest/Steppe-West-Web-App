<?php
/**
 * @frontend/views/letter/layouts/main.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use common\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

/** @var \yii\web\View $this */
/** @var string $content */
/** @var frontend\assets\SwLetterAsset $asset */

/**
// Store variables in $this->params to make them available in partials
$this->params['slug'] = $slug;
$this->params['lc'] = $lc;
$this->params['page'] = $page;
$this->params['lang'] = $lang;
$this->params['asset'] = $asset;
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
	<?= $this->render('//letter/partials/head.min.php') ?>
</head>
<body>
	<?= $this->beginBody() ?>
	<?= $this->render('//letter/partials/header.min.php') ?>
	<?= $content ?>
	<?= $this->render('//letter/partials/footer.min.php') ?>
	<?= $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
