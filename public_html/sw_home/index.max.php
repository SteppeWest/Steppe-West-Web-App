<?php
$updated = '2024-06-18';
$canonicalRoot = 'https://steppewest.com/';

// Include the app.php file for functions
include 'inc/app.php';

// Include the data.php file to access the $languages array
include 'inc/data.php';

// Default language code
$defaultLanguage = 'EN';

// Get the language code from the URL or use the default
$languageCode = isset($_GET['country']) ? strtoupper($_GET['country']) : $defaultLanguage;

// Use the language code to get the language data
$languageData = $languages[$languageCode];

// Fetch meta values
$canonical = $canonicalRoot . $languageCode;
$locale = htmlspecialchars($languageData['locale'], ENT_QUOTES, 'UTF-8');
$title = htmlspecialchars($languageData['title'], ENT_QUOTES, 'UTF-8');
$subtitle = htmlspecialchars($languageData['subtitle'], ENT_QUOTES, 'UTF-8');
$description = htmlspecialchars($languageData['description'], ENT_QUOTES, 'UTF-8');
$keywords = htmlspecialchars($languageData['keywords'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="canonical" href="<?= $canonical ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?= $description ?>">
	<meta name="keywords" content="<?= $keywords ?>">
	<meta name="author" content="Pedro Plowman for Steppe West">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?= $canonical ?>">
	<meta property="og:image" content="https://steppewest.com/ui/img/og_image_01-1200x0630.jpeg">
	<meta property="og:image" content="https://steppewest.com/ui/img/og_image_01-1200x0630.jpeg">
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:description" content="<?= $description ?>">
	<meta property="og:updated_time" content="<?= $updated ?>">
	<meta property="og:locale" content="<?= $locale ?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?= $canonical ?>">
	<meta property="twitter:title" content="<?= $title ?>">
	<meta property="twitter:description" content="<?= $description ?>">
	<meta property="twitter:image" content="https://steppewest.com/ui/img/og_image_01-1200x0630.jpeg">
	<meta property="twitter:image" content="https://steppewest.com/ui/img/og_image_01-1200x0630.jpeg">

	<!-- Favicon-->
	<link rel="apple-touch-icon" sizes="180x180" href="/ui/ico/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/ui/ico/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/ui/ico/favicon-16x16.png">
	<link rel="manifest" href="/ui/ico/site.webmanifest">
	<link rel="mask-icon" href="/ui/ico/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="/ui/ico/favicon.ico">

	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="/ui/ico/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<title><?= $title ?></title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
	<link rel="stylesheet" href="/ui/css/full-width-pics.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="/ui/css/circle-buttons.min.css" crossorigin="anonymous">
</head>
<body>
	<?php
		// Include navbar
		include 'inc/navbar.min.php';
	?>
	<!-- Header - set the background image for the header in the line below-->
	<header class="py-5 bg-image-full">
		<div class="text-center my-5">
			<div id="title">
				<h1 class="text-white fs-2 fw-bolder mb-0"><?= $title ?></h1>
				<h2 class="text-white fs-3 fw-bolder mb-0"><?= $subtitle ?></h2>
			</div>
		</div>
	</header>
	<!-- Content section-->
	<section class="py-1">
		<?php
			// Include languages
			include 'inc/languages.min.php';

			letter($languageCode);

			// Include signature
			include 'inc/signature.min.php';
		?>
	</section>
	<?php
		// Include footer
		include 'inc/footer.min.php';
	?>
	<!-- Bootstrap core JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
