<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SWCurrentLanguage $model */

$this->title = Yii::t('app', 'Create Sw Current Language');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sw Current Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swcurrent-language-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
