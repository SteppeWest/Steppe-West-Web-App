<?php
/**
 * @frontend/modules/letter/site/index.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Main view for displaying letter content.
 *
 * @var yii\web\View $this
 * @var array $bodyContent Contains the processed content items
 * @var string|null $faqLink FAQ link generated from body content
 */

$bodyContent = $this->params['bodyContent'];
$faq = $this->params['faq'];

/*
var_dump($this->params['rawContent']);
var_dump($this->params['rawItem']);
var_dump($this->params['htmlContent']);
var_dump($bodyContent);
var_dump($this->params['assetUrl']);
var_dump($this->params['basePath']);
var_dump($this->params['basename']);
var_dump($this->params['frontend']);
 */
?>
<section class="py-1">
	<?= $this->render('@app/modules/letter/layouts/languages.php') ?>

	<div class="container my-4">
		<!-- Loop through body content and alternate layouts -->
		<?php foreach ($bodyContent as $index => $contentItem): ?>
			<?php
				// Choose the layout based on index (alternate left and right)
				$layoutFile = $index % 2 === 0
					? '@app/modules/letter/layouts/letter-row-left.php'
					: '@app/modules/letter/layouts/letter-row-right.php';
			?>
			<?= $this->render($layoutFile, [
				'contentItem' => $contentItem['content'],
				'image' => $contentItem['image'],
			]) ?>
		<?php endforeach; ?>

		<?php if (isset($faq) && is_array($faq)): ?>
			<div class="row align-items-center mt-4">
				<div class="col-md-8 offset-md-2">
					<div class="accordion" id="outerFAQaccordion">
						<div class="accordion-item">
							<h3 class="accordion-header">
								<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#outerFAQcollapse" aria-expanded="false" aria-controls="outerFAQcollapse">
									<?= $faq['title'] ?>
								</button>
							</h3>
							<div id="outerFAQcollapse" class="accordion-collapse collapse" data-bs-parent="#outerFAQaccordion">
								<div class="accordion-body p-0">
									<?= $faq['content'] ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</div>

	<?= $this->render('@app/modules/letter/layouts/letter-foot.php') ?>
</section>
