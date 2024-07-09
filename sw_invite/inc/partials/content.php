<?php
$rowData = [];
$rowData[] = '<p class="lead">' . $languageData['lead']
			. '</p><p>' . $languageData['paragraph1'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph2'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph3'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph4'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph5'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph6'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph7']
		   . '</p><p>' . $languageData['close']
		   . '</p><p>' . $languageData['pedro'] . '</p>';
?>
<div class="container my-4">
	<?php foreach ($rowData as $index => $data): ?>
		<div class="row align-items-center justify-content-center">
			<?php renderContentRow($index, $data); ?>
		</div>
	<?php endforeach; ?>
</div>
