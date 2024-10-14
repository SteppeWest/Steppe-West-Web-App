<?php
$rowData = [];
$rowData[] = [
	'content' => '<p class="lead">' . $languageData['lead']
			   . '</p><p>' . $languageData['paragraph1'] . '</p>',
	'image' => 'ui/img/circles/central_asia_04.jpeg',
	'alt' => 'Central Asia 04',
--
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph2'] . '</p>',
	'image' => 'ui/img/circles/central_asia_09.jpeg',
	'alt' => 'Central Asia 09',
--
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph3'] . '</p>',
	'image' => 'ui/img/circles/central_asia_10.jpeg',
	'alt' => 'Central Asia 10',
--
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph4'] . '</p>',
	'image' => 'ui/img/circles/central_asia_19.jpeg',
	'alt' => 'Central Asia 19',
--
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph5'] . '</p>',
	'image' => 'ui/img/circles/central_asia_17.jpeg',
	'alt' => 'Central Asia 17',
--
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph6'] . '</p>',
	'image' => 'ui/img/circles/central_asia_11.jpeg',
	'alt' => 'Central Asia 11',
--
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph7'] . '</p><p>' . $languageData['close']
			   . '</p><p>' . $languageData['pedro'] . '</p>',
	'image' => 'ui/img/circles/central_asia_16.jpeg',
	'alt' => 'Central Asia 16',
--

function imageTag($image, $alt) {
	return '<img class="img-fluid rounded-circle" alt="' . htmlspecialchars($alt)
		 . '" src="' . htmlspecialchars($image) . '">';
}

function renderColumns0($rowData) {
	?>
	<div class="col-lg-1 order-3 order-lg-1">&nbsp;</div>
	<div class="col-lg-6 order-1 order-lg-2">
		<?= $rowData['content'] ?>
	</div>
	<div class="col-lg-3 order-2 order-lg-3">
		<?= imageTag($rowData['image'], $rowData['alt']) ?>
	</div>
	<?php
}

function renderColumns1($rowData) {
	?>
	<div class="col-lg-3 order-2 order-lg-1">
		<?= imageTag($rowData['image'], $rowData['alt']) ?>
	</div>
	<div class="col-lg-6 order-1 order-lg-2">
		<?= $rowData['content'] ?>
	</div>
	<div class="col-lg-1 order-3 order-lg-3">&nbsp;</div>
	<?php
}

function renderColumns($row, $rowData) {
	if ($row % 2 == 0) {
		renderColumns0($rowData[$row]);
	} else {
		renderColumns1($rowData[$row]);
	}
}
?>

<div class="container my-4">
	<?php foreach ($rowData as $index => $data): ?>
		<div class="row align-items-center justify-content-center">
			<?php renderColumns($index, $rowData); ?>
		</div>
	<?php endforeach; ?>
</div>
