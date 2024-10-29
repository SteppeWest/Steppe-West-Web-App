<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\SWLetterAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

SWAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
	<?= $this->render('//partials/head.min.php') ?>
</head>
<body>
	<?= $this->beginBody() ?>
	<?= $this->render('//partials/header.min.php') ?>
	<?= $content ?>
	<?= $this->render('//partials/footer.min.php') ?>
	<?= $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
