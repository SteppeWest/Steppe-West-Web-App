<?php
/**
 * languages/shared/_form.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SWLanguageShared $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="swlanguage-shared-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'locale')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'lang')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'origin')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'footer_yaml')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
