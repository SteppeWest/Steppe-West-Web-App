<?php
/**
 * @frontend/modules/letter/layouts/languages.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @var \yii\web\View $this
 * @var array $langMenu Array of language menu items passed from the controller
 */

use yii\bootstrap5\Html;

$langMenu = $this->params['langMenu'];
?>
<div class="container my-1">
	<div class="justify-content-center row">
		<div class="col-lg-8 fw-bolder text-center">
			<div class="btn-group">
				<?php foreach ($langMenu as $item): ?>
					<?= Html::a(
						$item['label'],          // Display the label with the flag and language code
						$item['url'],            // Link URL
						[
							'class' => 'btn btn-sm btn-secondary' . ($item['active'] ? ' active' : ''), // Add 'active' class if the language is active
							'role' => 'button'
						]
					) ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
