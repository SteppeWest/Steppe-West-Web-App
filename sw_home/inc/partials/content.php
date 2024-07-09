<?php
$rowData = [];
$rowData[] = '<h4>' . $languageData['heading0']
		   . '</h4><p>' . $languageData['paragraph0'] . '</h4>';
$rowData[] = '<h4>' . $languageData['heading1']
		   . '</h4><p>' . $languageData['paragraph1'] . '</h4>';
$rowData[] = '<h4>' . $languageData['heading2']
		   . '</h4><p>' . $languageData['paragraph2'] . '</h4>';
$rowData[] = '<h4>' . $languageData['heading3']
		   . '</h4><p>' . $languageData['paragraph3'] . '</h4>';
$rowData[] = '<h4>' . $languageData['heading4']
		   . '</h4><p>' . $languageData['paragraph4'] . '</h4>';
$rowData[] = '<h4>' . $languageData['heading5']
		   . '</h4><p>' . $languageData['paragraph5'] . '</h4>';
$rowData[] = '<h4>' . $languageData['heading6']
		   . '</h4><p>' . $languageData['paragraph6'] . '</h4>';
$rowData[] = '<p>' . $languageData['paragraph7']
		   . '</p><p>' . $languageData['close'] . '</h4>';
?>
<div class="container my-4">
	<?php foreach ($rowData as $index => $data): ?>
		<div class="row align-items-center justify-content-center">
			<?php renderContentRow($index, $data); ?>
		</div>
	<?php endforeach; ?>
</div>
