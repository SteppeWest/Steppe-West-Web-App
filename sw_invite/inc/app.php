<?php
session_start();

// Include the circles data and assign to a variable
$circles = include __DIR__ . '/data/circles.php';

// Shuffle groups
$groupFolders = array_keys($circles);
shuffle($groupFolders);

function sanitise($data) {
	if (is_array($data)) return array_map('sanitise', $data);
	return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function fetchData($file, $sanitise = false) {
	$filePath = __DIR__ . '/' . $file . '.php';
	$data = [];
	if (file_exists($filePath)) {
		$data = include $filePath;
		if ($sanitise) $data = sanitise($data);
	}
	else {
		echo "'{$file}' not found.";
	}
	return $data;
}

function getFlagEmoji($languageCode) {
	if ($languageCode === 'EN') {
		$languageCode = 'GB';
	}
	$codePoints = [
		127397 + ord($languageCode[0]),
		127397 + ord($languageCode[1])
	];
	return mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
}

function renderResources($type) {
	$resources = fetchData('data/utility/resources');
	$html = '';
	foreach ($resources[$type] as $resource) {
		if ($type === 'css') {
			$html .= '<link rel="stylesheet" href="' . $resource['url'] . '"';
		}
		elseif ($type === 'js') {
			$html .= '<script src="' . $resource['url'] . '"';
		}
		if (!empty($resource['integrity'])) {
			$html .= ' integrity="' . $resource['integrity'] . '"';
		}
		$html .= ' crossorigin="anonymous">';
		if ($type === 'js') {
			$html .= '</script>';
		}
		//$html .= PHP_EOL;
	}
	return $html;
}

function renderNavigationLinks() {
	global $languages, $currentLanguage;
	$navigation = '';
	foreach ($languages as $languageCode) {
		$label = getFlagEmoji($languageCode) . ' ' . $languageCode;
		$class = ($languageCode === $currentLanguage) ? ' active' : '';
		$navigation .= '<li class="nav-item"><a class="nav-link' . $class . '" href="/' . $languageCode . '">' . $label . '</a></li>';
	}
	return $navigation;
}

function renderLanguageButtons() {
	global $languages, $currentLanguage;
	$buttons = '';
	foreach ($languages as $languageCode) {
		$flag = getFlagEmoji($languageCode);
		$label = $flag . ' ' . $languageCode;
		$buttonClass = ($languageCode === $currentLanguage) ? 'btn-secondary active' : 'btn-secondary';
		$buttons .= '<a class="btn btn-sm ' . $buttonClass . '" role="button" href="/' . $languageCode . '">'
				. $label . '</a>';
	}
	return '<div class="btn-group">' . $buttons . '</div>';
}

function renderCircleImage($index) {
	global $groupFolders, $circles;

	// Select a random group
	$groupFolder = $groupFolders[$index % count($groupFolders)];

	// Select a random image from the group
	$images = glob(__DIR__ . "/../ui/img/circles/$groupFolder/*.jpg");
	if (!$images) {
		return ''; // Handle case where no images are found
	}

	$image = $images[array_rand($images)];
	$alt = $circles[$groupFolder];

	return '<img class="img-fluid rounded-circle" alt="'
		 . $alt . '" src="/ui/img/circles/'
		 . $groupFolder . '/'
		 . basename($image) . '">';
}

function renderContentRow($index, $data) {
	$textColumn = '<div class="col-lg-6 order-1 order-lg-2">' . $data . '</div>';

	$lr = ($index % 2);
	$rowOutput = '';
	if ($lr == 0) {
		$rowOutput .= '<div class="col-lg-1 order-3 order-lg-1">&nbsp;</div>';
		$rowOutput .= $textColumn;
		$rowOutput .= '<div class="col-lg-3 order-2 order-lg-3">'
					. renderCircleImage($index) . '</div>';
	}
	else {
		$rowOutput .= '<div class="col-lg-3 order-2 order-lg-1">'
					. renderCircleImage($index) . '</div>';
		$rowOutput .= $textColumn;
		$rowOutput .= '<div class="col-lg-1 order-3 order-lg-3">&nbsp;</div>';
	}

	echo $rowOutput;
}

function renderFlagsBanner() {
	global $languages;
	$class = 'img-fluid';
	$alt = 'Steppe West ' . getFlagEmoji($languages[4])
		 . ' ' . getFlagEmoji($languages[3]) . ' ' . getFlagEmoji($languages[6])
		 . ' ' . getFlagEmoji($languages[7]) . ' ' . getFlagEmoji($languages[8])
		 . ' ' . getFlagEmoji($languages[2]) . ' ' . getFlagEmoji($languages[5]);
	$src = '/ui/img/flags-banner-1004x0200.png';
	return '<img class="' . $class . '" alt="' . $alt . '" src="' . $src . '">';
}

function renderSocials($asButtons = true) {
	$socials = fetchData('data/utility/socials', true);
	$links = [];
	foreach ($socials as $name => $details) {
		$url = $details['url'];
		$icon = $details['icon'];
		if ($asButtons) {
			$link = '<a class="btn btn-secondary btn-circle btn-circle-sm"'
				  . ' role="button" href="https://' . $url . '" title="' . $name
				  . '" target="_blank"><i class="' . $icon . '"></i></a>';
		}
		else {
			$link = '<a href="https://' . $url . '" title="' . $name . '" target="_blank">'
				  . '<i class="' . $icon . '"></i> ' . $name . '</a>';
		}
		$links[] = $link;
	}
	return implode(' ', $links);
}

function renderFooterContent() {
	global $languageData;
	$paraOpen = '<p class="m-0 text-center text-white">';
	$paraClose = '</p>';
	$footer = '';
	$footer .= $paraOpen . $languageData['footer1'] . $paraClose;
	$footer .= $paraOpen . $languageData['footer2'] . ' '
						 . $languageData['footer3'] . $paraClose;
	$footer .= $paraOpen . $languageData['copy'] . $paraClose;
	return $footer;
}

function substitutePlaceholders($placeholder, &$target, $substitutions) {
	if (isset($substitutions[$placeholder])) {
		$target = str_replace("{{$placeholder}}", $substitutions[$placeholder], $target);
	}
}

function processUrl() {
	global $currentLanguage;

	$languageMap = include __DIR__ . '/data/languagemap.php';
	$languagesList = array_keys(include __DIR__ . '/data/languages.php');

	$requestUri = $_SERVER['REQUEST_URI'];

	if (preg_match('#^/faq/([A-Z]{2})#', $requestUri, $matches)) {
		$countryCode = $matches[1];
		if (isset($languageMap[$countryCode])) {
			$newLanguage = $languageMap[$countryCode];
			$newUrl = str_replace("/faq/$countryCode", "/faq/$newLanguage", $requestUri);
			header("Location: $newUrl", true, 301);
			exit();
		}
	}
	elseif (preg_match('#^/([A-Z]{2})#', $requestUri, $matches)) {
		$countryCode = $matches[1];
		if (isset($languageMap[$countryCode])) {
			$newLanguage = $languageMap[$countryCode];
			$newUrl = str_replace("/$countryCode", "/$newLanguage", $requestUri);
			header("Location: $newUrl", true, 301);
			exit();
		}
	}
	elseif ($requestUri === '/') {
		header("Location: /en", true, 301);
		exit();
	}
	else {
		if (preg_match('#^/([a-z]{2,3})#', $requestUri, $matches)) {
			$currentLanguage = $matches[1];
		}
	}
}

function init() {
	global $updated, $canonical, $currentLanguage, $languageData;

	processUrl();

	// Load language data
	$commonData = fetchData('../languages/common/' . $currentLanguage, true);
	$contentData = fetchData('../languages/content/' . $currentLanguage, true);

	// Merge shared and content data
	$languageData = array_merge($commonData, $contentData);

	// Set the 'lang' key in $languageData
	if ($currentLanguage === 'en') {
		$languageData['lang'] = $languageData['locale'];
	}
	else {
		$languageData['lang'] = strtolower($currentLanguage);
	}

	// Load substitutions data
	$substitutionLinks = fetchData('data/substitutions');
	$substitutions = [];
	foreach ($substitutionLinks as $placeholder => $data) {
		$link = '<a class="link-info link-opacity-75-hover text-decoration-none" href="https://'
			  . $data['url'] . '" title="' . $data['title']
			  . '" target="_blank">' . $data['label'] . '</a>';
		$substitutions[$placeholder] = $link;
	}
	$substitutions['UA'] = getFlagEmoji('UA');
	$substitutions['PS'] = getFlagEmoji('PS');

	// Perform substitutions in the target fields
	substitutePlaceholders('Substack', $languageData['origin'], $substitutions);
	substitutePlaceholders('GubbiGubbi', $languageData['footer1'], $substitutions);
	substitutePlaceholders('KabiKabi', $languageData['footer1'], $substitutions);
	substitutePlaceholders('UA', $languageData['footer3'], $substitutions);
	substitutePlaceholders('PS', $languageData['footer3'], $substitutions);

	// Combine subtitle and description if both are present
	if (isset($languageData['description']) && isset($languageData['subtitle'])) {
		$languageData['description'] = $languageData['subtitle'] . '. ' . $languageData['description'];
	}
}
