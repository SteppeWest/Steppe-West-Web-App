<?php
/**
 * @frontend/views/letter/partials/footer.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Generates footer content with substitutions applied.
 *
 * @var \yii\web\View $this
 * @var array $lang Contains the `footer_content` field to be parsed as YAML
 */

use yii\bootstrap5\Html;
use common\widgets\SwSubstitution;
use Symfony\Component\Yaml\Yaml;

$lang = $this->params['lang'];
$footerContent = $lang->footer_content;

if ($footerContent) {
	// Parse YAML from the footer content
	try {
		$parsedContent = Yaml::parse($footerContent);
	} catch (\Exception $e) {
		// Handle YAML parsing error (if any)
		echo "<p class='text-center text-danger'>Error loading footer content.</p>";
		$parsedContent = [];
	}

	// Extract text fields from parsed content and apply substitutions
	$footerContent = [];
	if (is_array($parsedContent)) {
		foreach ($parsedContent as $contentItem) {
			if (isset($contentItem['text'])) {
				// Apply substitutions to each text item
				$footerContent[] = SwSubstitution::applySubstitutions($contentItem['text']);
			}
		}
	}
}

?>
<footer class="bg-dark py-4">
	<div class="container">
		<?php if (!empty($footerContent)): ?>
			<p class="m-0 text-center text-white"><?= $footerContent[0] ?></p>
			<p class="m-0 text-center text-white"><?= $footerContent[1] ?> <?= $footerContent[2] ?></p>
			<p class="m-0 text-center text-white"><?= $footerContent[3] ?></p>
		<?php else: ?>
			<!-- Fallback footer content if YAML is empty or parsing failed -->
			<p class="m-0 text-center text-white">## Steppe West acknowledges the <a class="link-info link-opacity-75-hover text-decoration-none" href="https://gubbigubbidyungungoo.com/" title="Gubbi Gubbi" target="_blank">Gubbi Gubbi</a> (also known as the <a class="link-info link-opacity-75-hover text-decoration-none" href="https://gubbigubbidyungungoo.com/explanation-of-the-gubbi-gubbi-language/" title="Kabi Kabi" target="_blank">Kabi Kabi</a>) peoples, on whose land we are based.</p>
			<p class="m-0 text-center text-white">Steppe West is, &amp; always will be, a not for profit enterprise. Steppe West stands with 🇺🇦 Ukraine &amp; 🇵🇸 Palestine.</p>
			<p class="m-0 text-center text-white">Copyright © Steppe West 2024.</p>
		<?php endif; ?>
	</div>
</footer>
