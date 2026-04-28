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

use common\helpers\SwBanner;
use frontend\helpers\SwSocials;

$this->title = Yii::t('sw.frontend.error', 'Lost on the Steppe – Steppe West 404');
?>

<main role="main" class="sw-error-page">
	<section class="sw-error-content">
		<div class="row">
			<div class="col-12">
			</div>
		</div>
		<div class="row">
			<div class="col">
			</div>
		</div>
		<div class="row">
			<div class="col-12">
			</div>
		</div>

		<h1>
			<?= Html::encode(Yii::t('sw.frontend.error', 'It looks like you’ve become lost on the Great Steppe...')) ?>
		</h1>

		<p class="lead">
			Steppe West <?= Html::encode(Yii::t('sw.frontend.error', '404')) ?>
		</p>

		<nav class="sw-error-links" aria-label="<?= Html::encode(Yii::t('sw.frontend.error', 'Suggested pages')) ?>">
			<ul>
				<li>
					<?= Html::a(
						Html::encode(Yii::t('sw.frontend.error', 'Steppe West: Stories from Central Asia, Shared with the World')),
						['/site/index'],
						['encode' => false]
					) ?>
				</li>
				<li>
					<?= Html::a(
						Html::encode(Yii::t('sw.frontend.error', 'An Invitation to Share Your Stories with the World')),
						['/site/index', 'slug' => 'invite'],
						['encode' => false]
					) ?>
				</li>
			</ul>
		</nav>

		<?= SwSocials::b() ?>
	</section>

	<section class="sw-error-brand">
		<?= SwBanner::b() ?>
		<p class="sw-error-credit sw-error-credit-landscape">
			<?= Yii::t('sw.frontend.error', 'Photo by {photographer} on {source}.', [
				'photographer' => Html::a('Julia Volk', 'https://www.pexels.com/photo/wild-camel-in-sunny-winter-day-5110944/', [
					'target' => '_blank',
					'rel' => 'noopener noreferrer',
				]),
				'source' => Html::a('Pexels', 'https://www.pexels.com/', [
					'target' => '_blank',
					'rel' => 'noopener noreferrer',
				]),
			]) ?>
		</p>
		<p class="sw-error-credit sw-error-credit-portrait">
			<?= Yii::t('sw.frontend.error', 'Photo by {photographer} on {source}.', [
				'photographer' => Html::a('Imad Clicks', 'https://www.pexels.com/photo/camel-eating-grass-in-mountain-valley-13652197/', [
					'target' => '_blank',
					'rel' => 'noopener noreferrer',
				]),
				'source' => Html::a('Pexels', 'https://www.pexels.com/', [
					'target' => '_blank',
					'rel' => 'noopener noreferrer',
				]),
			]) ?>
		</p>
	</section>
</main>
<!--
Steppe West: Stories from Central Asia, Shared with the World
	Exploring life, culture, and stories from Central Asia — together
An Invitation to Share Your Stories with the World
	We publish and promote stories from Central Asia for English-speaking audiences
 -->
