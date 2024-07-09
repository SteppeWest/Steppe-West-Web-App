<?php
$updated = '2024-07-10';
$canonical = 'https://steppewest.com/';

// Include the app.php file for functions
include 'inc/app.php';

// Call the init function in inc/app.php
init();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/partials/head.min.php'; ?>
<body>
	<?php include 'inc/partials/header.min.php'; ?>
	<!-- Content section-->
	<section class="py-1">
		<?php
			// Include languages
			include 'inc/partials/languages.min.php';

			// Include content
			include 'inc/partials/content.min.php';

			// Include signature
			include 'inc/partials/signature.min.php';
		?>
	</section>
	<?php include 'inc/partials/footer.min.php'; ?>
</body>
</html>
