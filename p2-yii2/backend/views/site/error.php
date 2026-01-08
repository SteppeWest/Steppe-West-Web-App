<?php
/**
 * @backend/views/site/error.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\helpers\Url;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var yii\web\ErrorAction $exception */

$exception = Yii::$app->errorHandler->exception;
$code = $exception ? $exception->statusCode ?? 500 : 500;

$this->title = Yii::t('admin.error', 'Error {code}', ['code' => $code]);

$backUrl = Yii::$app->user->isGuest
	? Url::to(['/user/security/login'])
	: Url::to(['/site/index']); // your SB Admin-wrapped dashboard

$backLabel = Yii::$app->user->isGuest
	? Yii::t('admin', 'Back to Login')
	: Yii::t('admin.nav', 'Dashboard');
?>
<div id="steppe-west-hq-error" class="container-fluid ps-md-0">
	<div class="row g-0">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		<div class="col-md-8 col-lg-6">
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">
							<div class="card shadow-sm site-error">
								<div class="card-header">
									<h1 class="h4 mb-0"><?= Html::encode($this->title) ?></h1>
								</div>

								<div class="card-body">
									<div role="alert" aria-live="polite">
										<p class="mb-2">
											<?= Html::encode($exception?->getMessage() ?: Yii::t('admin.error', 'An unexpected error occurred.')) ?>
										</p>

										<?php if (YII_DEBUG && $exception): ?>
											<pre class="small mb-0"><code><?= Html::encode((string)$exception) ?></code></pre>
										<?php endif; ?>
									</div>

									<div class="d-grid mt-3">
										<?= Html::a(
											$backLabel,
											$backUrl,
											['class' => 'btn btn-primary']
										) ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
