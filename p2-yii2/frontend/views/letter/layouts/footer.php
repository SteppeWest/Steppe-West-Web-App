<?php
/**
 * @frontend/modules/letter/layouts/footer.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @var \yii\web\View $this
 */
?>
<footer class="bg-dark py-4">
	<div class="container">
		<?php if (!empty($this->params['footer'])): ?>
			<?= $this->params['footer'] ?>
		<?php else: ?>
			<!-- Fallback footer content if YAML is empty or parsing failed -->
			<p class="m-0 text-center text-white">Steppe West acknowledges the <a class="link-info link-opacity-75-hover text-decoration-none" href="https://gubbigubbidyungungoo.com/" title="Gubbi Gubbi" target="_blank">Gubbi Gubbi</a> (also known as the <a class="link-info link-opacity-75-hover text-decoration-none" href="https://gubbigubbidyungungoo.com/explanation-of-the-gubbi-gubbi-language/" title="Kabi Kabi" target="_blank">Kabi Kabi</a>) peoples, on whose land we are based.</p>
			<p class="m-0 text-center text-white">Steppe West is, &amp; always will be, a not for profit enterprise.</p>
			<p class="m-0 text-center text-white">Steppe West stands with 🇺🇦 Ukraine &amp; 🇵🇸 Palestine.</p>
			<p class="m-0 text-center text-white">Copyright © Steppe West 2024.</p>
		<?php endif; ?>
	</div>
</footer>
