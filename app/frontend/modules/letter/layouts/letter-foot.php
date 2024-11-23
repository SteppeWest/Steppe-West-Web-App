<?php
/**
 * @frontend/modules/letter/layouts/letter-foot.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */
?>
<div class="container my-4">
	<div class="justify-content-center row">
		<div class="col-lg-8">
			<?= $this->params['flagsBanner'] ?>
		</div>
	</div>
	<div class="justify-content-center row align-items-end">
		<div class="col-lg-4">
			<p class="float-start">Email: pedro@steppewest.com<br>WhatsApp, Telegram, Viber: +61400473376</p>
		</div>
		<div class="col-lg-4 float-end">
			<p class="float-end fs-2">
				<?= $this->params['socialButtons'] ?>
			</p>
		</div>
	</div>
	<?= $this->params['origin'] ?>
</div>
