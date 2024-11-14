<?php
/**
 * @frontend/views/letter/partials/content-foot.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */

use yii\bootstrap5\Html;



$origin = $this->params['origin'];
$letterAsset = $this->params['letterAsset'];

$letterAssetUrl = $letterAsset->baseUrl;
?>
<div class="container my-4">
	<div class="justify-content-center row">
		<div class="col-lg-8">
			<img class="img-fluid" alt="Steppe West 🇰🇿 🇰🇬 🇹🇯 🇹🇲 🇺🇿 🇦🇫 🇦🇿 🇲🇳 🇹🇷" src="<?= $letterAssetUrl ?>/img/flags-banner-200h.png">
		</div>
	</div>
	<div class="justify-content-center row align-items-end">
		<div class="col-lg-4">
			<p class="float-start">Email: pedro@steppewest.com<br>WhatsApp, Telegram, Viber: +61400473376</p>
		</div>
		<div class="col-lg-4 float-end">
			<p class="float-end fs-2">
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://steppewest.substack.com" title="Substack" target="_blank"><i class="bi bi-substack"></i></a>
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://facebook.com/SteppeWest" title="Facebook" target="_blank"><i class="bi bi-facebook"></i></a>
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://instagram.com/steppe.west" title="Instagram" target="_blank"><i class="bi bi-instagram"></i></a>
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://x.com/SteppeWest" title="X/Twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://youtube.com/@SteppeWest" title="YouTube" target="_blank"><i class="bi bi-youtube"></i></a>
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://tiktok.com/@steppewest" title="TikTok" target="_blank"><i class="bi bi-tiktok"></i></a>
				<a class="btn btn-secondary btn-circle btn-circle-sm" role="button" href="https://threads.net/@steppe.west" title="Threads" target="_blank"><i class="bi bi-threads"></i></a>
			</p>
		</div>
	</div>
	<?= $origin ?>
</div>
