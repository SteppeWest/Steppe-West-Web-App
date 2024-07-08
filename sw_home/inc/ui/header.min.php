<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="/">Steppe West</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?= renderNavigationLinks() ?>
			</ul>
		</div>
	</div>
</nav>

<header class="py-5 bg-image-full">
	<div class="text-center my-5">
		<div id="title">
			<h1 class="text-white fs-2 fw-bolder mb-0"><?= $languageData['title'] ?></h1>
		</div>
	</div>
</header>
