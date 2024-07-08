<?php
$updated = '2024-06-21';
$canonical = 'https://invite.steppewest.com/';

// Include the app.php file for functions
include 'inc/app.php';

// Call the init function in inc/app.php
init();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/ui/head.min.php'; ?>
<body>
	<?php include 'inc/ui/header.min.php'; ?>
	<!-- Content section-->
	<section class="py-1">
		<?php
			// Include languages
			include 'inc/ui/languages.min.php';

			// Include content
			include 'inc/ui/content.min.php';

			// Include signature
			include 'inc/ui/signature.min.php';
		?>
	</section>
	<?php include 'inc/ui/footer.min.php'; ?>
</body>
</html>
