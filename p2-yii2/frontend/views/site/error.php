<?php
/**
 * @frontend/views/site/error.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use Yii;
use yii\bootstrap5\Html;

use frontend\helpers\SwSocials;
use common\helpers\SwBanner;

$homeTitle   = Yii::t('sw.frontend.error', 'Steppe West: Stories from Central Asia, Shared with the World');
$inviteTitle = Yii::t('sw.frontend.error', 'An Invitation to Share Your Stories with the World');

$homeUrl   = ['/site/index'];
$inviteUrl = ['/site/index', 'slug' => 'invite'];

$landscapeCredit = Yii::t('sw.frontend.error', 'Photo by {photographer} on {source}.', [
	'photographer' => Html::a('Julia Volk', 'https://www.pexels.com/@julia-volk/', [
		'target' => '_blank',
		'rel' => 'noopener noreferrer',
	]),
	'source' => Html::a('Pexels', 'https://www.pexels.com/', [
		'target' => '_blank',
		'rel' => 'noopener noreferrer',
	]),
]);

$portraitCredit = Yii::t('sw.frontend.error', 'Photo by {photographer} on {source}.', [
	'photographer' => Html::a('Imad Clicks', 'https://www.pexels.com/@imad-clicks/', [
		'target' => '_blank',
		'rel' => 'noopener noreferrer',
	]),
	'source' => Html::a('Pexels', 'https://www.pexels.com/', [
		'target' => '_blank',
		'rel' => 'noopener noreferrer',
	]),
]);

$this->title = Yii::t('sw.frontend.error', 'Steppe West 404 Lost on the Steppe');
?>
<main class="sw-error-page" role="main">
	<div class="sw-error-stage">
		<div class="row">
			<div class="col-12">
				<h1 class="sw-error-title">
					<?= Yii::t('sw.frontend.error', 'It looks like you’ve become lost on the Great Steppe...') ?>
				</h1>
			</div>
		</div>

		<div class="row sw-error-middle">
			<div class="col-lg-6"></div>
			<div class="col-lg-6">
				<nav class="sw-error-links" aria-label="<?= Yii::t('sw.frontend.error', 'Suggested pages') ?>">
					<ul>
						<li><?= Html::a(Html::encode($homeTitle), $homeUrl, ['encode' => false]) ?></li>
						<li><?= Html::a(Html::encode($homeTitle), $homeUrl, ['encode' => false]) ?></li>
					</ul>
				</nav>

				<div class="sw-error-socials"><?= SwSocials::b() ?></div>
			</div>
		</div>

		<div class="row sw-error-bottom">
			<div class="col-12">
				<div class="sw-error-banner"><?= SwBanner::b() ?></div>

				<p class="sw-error-credit sw-error-credit-landscape">
					<?= $landscapeCredit ?>
				</p>
				<p class="sw-error-credit sw-error-credit-portrait">
					<?= $portraitCredit ?>
				</p>
			</div>
		</div>
	</div>
</main>
