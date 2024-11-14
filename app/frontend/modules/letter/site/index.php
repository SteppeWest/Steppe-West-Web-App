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
//var_dump($bodyContent);
?>
<section class="py-1">
	<?= $this->render('@app/modules/letter/layouts/languages.min.php') ?>

	<div class="container my-4">
		<?= $this->params['faqLink'] ?>

		<!-- Loop through body content and alternate layouts -->
		<?php foreach ($bodyContent as $index => $contentItem): ?>
			<?php
				// Choose the layout based on index (alternate left and right)
				$layoutFile = $index % 2 === 0
					? '@app/modules/letter/layouts/letter-row-left.min.php'
					: '@app/modules/letter/layouts/letter-row-right.min.php';
			?>
			<?= $this->render($layoutFile, [
				'contentItem' => $contentItem['content'],
				'image' => $contentItem['image'],
			]) ?>
		<?php endforeach; ?>

		<?= $this->params['faqLink'] ?>
	</div>

	<?= $this->render('@app/modules/letter/layouts/letter-foot.min.php') ?>
</section>
