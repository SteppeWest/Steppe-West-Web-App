<?php
/**
 * @backend/views/site/error.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var yii\web\ErrorAction $exception */

$exception = Yii::$app->errorHandler->exception;
$code = $exception ? $exception->statusCode ?? 500 : 500;

$this->title = Yii::t('sw', 'Error {code}', ['code' => $code]);
?>
<div id="steppe-west-hq-error" class="container-fluid ps-md-0">
	<div class="row g-0">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		<div class="col-md-8 col-lg-6">
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">
							<div class="site-error">

								<h1><?= Html::encode($this->title) ?></h1>

								<div class="alert alert-danger">
									<?= nl2br(Html::encode($message)) ?>
								</div>

								<p>
									The above error occurred while the Web server was processing your request.
								</p>
								<p>
									Please contact us if you think this is a server error. Thank you.
								</p>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
