<?php
/**
 * @frontend/modules/letter/layouts/letter-row-right.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/** @var \yii\web\View $this */

use yii\bootstrap5\Html;
?>
<div class="row align-items-center">
	<div class="col-md-3 order-2 order-md-1 offset-md-1">
		<?= $image ?>
	</div>
	<div class="col-md-6 order-1 order-md-2">
		<?= $contentItem ?>
	</div>
</div>

