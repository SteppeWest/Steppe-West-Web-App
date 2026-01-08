<?php
/**
 * @backend/views/site/login.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div id="steppe-west-hq-auth" class="container-fluid ps-md-0">
	<div class="row g-0">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		<div class="col-md-8 col-lg-6">
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">

							<div class="site-login">
								<div class="mt-5 offset-lg-3 col-lg-6">
									<h1><?= Html::encode($this->title) ?></h1>

									<p>Please fill out the following fields to login:</p>

									<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

										<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

										<?= $form->field($model, 'password')->passwordInput() ?>

										<?= $form->field($model, 'rememberMe')->checkbox() ?>

										<div class="form-group">
											<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
										</div>

									<?php ActiveForm::end(); ?>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
