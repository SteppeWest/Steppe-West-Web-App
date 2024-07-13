<?php
$updated = '2024-07-10';
$canonical = 'https://invite.steppewest.com/';
$pages = [
	'invite', // first item is /
	'faq', // later items are /item/
];

// Include the app.php file for functions
include 'inc/app.php';

// Call the init function in inc/app.php
init();
?>
<!DOCTYPE html>
<html lang="<?= $languageData['lang'] ?>">
<?php include 'inc/views/head.php'; ?>
<body>
	<?php include 'inc/views/header.php'; ?>
	<!-- Content section-->
	<section class="py-1">
		<?php
			// Include languages
			include 'inc/views/languages.php';

			// Include content
			include 'inc/views/content.php';

			// Include signature
			include 'inc/views/signature.php';
		?>
	</section>
	<?php include 'inc/views/footer.php'; ?>
</body>
</html>
