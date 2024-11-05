<?php
/* @var $this yii\web\View */
/* @var $page common\models\LanguagePage */

$this->title = $page->title ?? 'Introduction Page';
?>

<h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
<p>This is the SW Language Page for the introduction.</p>
