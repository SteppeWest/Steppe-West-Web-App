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

$this->title = Yii::t('sw', 'Error {code}', ['code' => $code]);

$backUrl = Yii::$app->user->isGuest
	? Url::to(['/user/security/login'])
	: Url::to(['/site/index']); // your SB Admin-wrapped dashboard

$backLabel = Yii::$app->user->isGuest
	? Yii::t('sw', 'Back to Login')
	: Yii::t('sw', 'Dashboard');
?>
<div class="card shadow-sm site-error">
	<div class="card-header">
		<h1 class="h4 mb-0"><?= Html::encode($this->title) ?></h1>
	</div>

	<div class="card-body">
		<div role="alert" aria-live="polite">
			<p class="mb-2">
				<?= Html::encode($exception?->getMessage() ?: Yii::t('sw', 'An unexpected error occurred.')) ?>
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
