<?php
$rowData = [];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading0']
			   . '</h4><p>' . $languageData['paragraph0'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_04.jpeg',
	'alt' => 'Central Asia 04',
];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading1']
			   . '</h4><p>' . $languageData['paragraph1'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_09.jpeg',
	'alt' => 'Central Asia 09',
];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading2']
			   . '</h4><p>' . $languageData['paragraph2'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_10.jpeg',
	'alt' => 'Central Asia 10',
];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading3']
			   . '</h4><p>' . $languageData['paragraph3'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_19.jpeg',
	'alt' => 'Central Asia 19',
];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading4']
			   . '</h4><p>' . $languageData['paragraph4'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_17.jpeg',
	'alt' => 'Central Asia 17',
];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading5']
			   . '</h4><p>' . $languageData['paragraph5'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_11.jpeg',
	'alt' => 'Central Asia 11',
];
$rowData[] = [
	'content' => '<h4>' . $languageData['heading6']
			   . '</h4><p>' . $languageData['paragraph6'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_16.jpeg',
	'alt' => 'Central Asia 16',
];
$rowData[] = [
	'content' => '<p>' . $languageData['paragraph7']
			   . '</p><p>' . $languageData['close'] . '</h4>',
	'image' => 'ui/img/circles/central_asia_15.jpeg',
	'alt' => 'Central Asia 15',
];

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
	<div class="align-items-center justify-content-center row">
		<div class="col-lg-8">
			<p class="lead"><?= $languageData['lead'] ?></p>
		</div>
	</div>
	<?php foreach ($rowData as $index => $data): ?>
		<div class="row align-items-center justify-content-center">
			<?php renderColumns($index, $rowData); ?>
		</div>
	<?php endforeach; ?>
</div>
