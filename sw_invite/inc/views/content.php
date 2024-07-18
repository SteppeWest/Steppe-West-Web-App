<?php
$rowData = [];
$rowData[] = '<p class="lead">' . $languageData['lead']
			. '</p><p>' . $languageData['paragraph1'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph2'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph3'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph4'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph5'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph6'] . '</p>';
$rowData[] = '<p>' . $languageData['paragraph7'] . '</p><p>'
		   . $languageData['close'] . ' '
		   . $languageData['pedro'] . '</p><p>'
		   . renderFaqLink($currentLanguage) . '</p>';
?>
<div class="container my-4">
	<?php foreach ($rowData as $index => $data): ?>
		<?php renderContentRow($index, $data); ?>
	<?php endforeach; ?>
</div>
