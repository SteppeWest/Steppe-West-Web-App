<?php
$updated = '2024-07-12';
$pageId = 'home';

$canonical = 'https://steppewest.com/'; // can be derived from $pageId

$appFolder = '0190888a-c7e9-7bfc-a951-6005e1293165';
if (basename(__DIR__) != 'public_html') $appFolder = '../' . $appFolder;

// Include the app.php file for functions
include $appFolder . '/app.php';

// Call the init function in inc/app.php
init();
?>
<!DOCTYPE html>
<html lang="<?= $languageData['lang'] ?>">
<?php include $appFolder . '/views/head.php'; ?>
<body>
	<?php include $appFolder . '/views/header_.php'; ?>
	<!-- Content section-->
	<section class="py-1">
		<?php
			// Include languages
			include $appFolder . '/views/languages.php';

			// Include content
			include $appFolder . '/views/content_.php';

			// Include signature
			include $appFolder . '/views/signature_.php';
		?>
	</section>
	<?php include $appFolder . '/views/footer.php'; ?>
</body>
</html>
