<?php
/**
 * @frontend/views/layouts/error.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Html;
use frontend\assets\SwErrorAsset;
use frontend\helpers\SwMeta;

SwErrorAsset::register($this);

$pageTitle = $this->title ?? 'Lost on the Steppe – Steppe West 404';

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Html::encode(Yii::$app->params['swDefaultLocale'] ?? 'en-AU') ?>" class="h-100">
<head>
<?php
SwMeta::e($this);
$this->registerCsrfMetaTags();
$this->head();
?>
<title><?= Html::encode($pageTitle) ?></title>
</head>
<body>
<?php
$this->beginBody();
echo $content;
$this->endBody();
?>
</body>
</html>
<?php $this->endPage(); ?>
