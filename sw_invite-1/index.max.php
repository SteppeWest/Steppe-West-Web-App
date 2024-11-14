<?php
$updated = '2024-07-18';
$canonical = 'https://invite.steppewest.com/';

// Include the app.php file for functions
include 'inc/app.php';

// Call the init function in inc/app.php
init();
?>
<!DOCTYPE html>
<html lang="<?=$languageData['lang']?>">
<?php include 'inc/views/head.min.php'; ?>
<body>
	<?php include 'inc/views/header.min.php'; ?>
	<!-- Content section-->
	<section class="py-1">
		<?php
			// Include languages
			include 'inc/views/languages.min.php';

			// Include content
			include 'inc/views/content.min.php';

			// Include signature
			include 'inc/views/signature.min.php';
		?>
	</section>
	<?php include 'inc/views/footer.min.php'; ?>
</body>
</html>
