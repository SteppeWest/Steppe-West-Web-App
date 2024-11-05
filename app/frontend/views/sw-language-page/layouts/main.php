<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\SWLetterAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

SWLetterAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
	<?= $this->render('//letter/partials/head.php') ?>
</head>
<body>
	<?= $this->beginBody() ?>
	<?= $this->render('//letter/partials/header.php') ?>
	<?= $content ?>
	<?= $this->render('//letter/partials/footer.php') ?>
	<?= $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
