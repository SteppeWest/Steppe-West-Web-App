<?php
session_start();

// Define CDN base URL
//define('CDN_BASE_URL', 'https://cdn.steppewest.com/tLC93gF6xhwTRC68ecmAU8VN3qEzA8/');
define('LOCAL_BASE_URL', $canonical);

$languages = [
	'EN', // 0
	'RU', // 1
	'KG', // 2
	'KZ', // 3
	'TJ', // 4
	'TM', // 5
	'UZ', // 6
	'AZ', // 7
	'MN', // 8
	'TR', // 9
];

// Default language code
//$defaultLanguage = $languages[0];
//$currentLanguage = isset($_GET['language']) ? strtoupper($_GET['language']) : $defaultLanguage;
$currentLanguage = '';
$languageData = [];

// Include the circles data and assign to a variable
$circles = include __DIR__ . '/data/circles.php';

// Shuffle groups
$groupFolders = array_keys($circles);
shuffle($groupFolders);

function sanitise($data) {
	if (is_array($data)) {
		return array_map('sanitise', $data);
	}
	return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function fetchData($file, $sanitise = false) {
	$filePath = __DIR__ . '/' . $file . '.php';
	$data = [];
	if (file_exists($filePath)) {
		$data = include $filePath;
		if ($sanitise) {
			$data = sanitise($data);
		}
	} else {
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
	$resources = fetchData('data/resources');
	$html = '';
	foreach ($resources[$type] as $resource) {
		if ($type === 'css') {
			$html .= '<link rel="stylesheet" href="' . $resource['url'] . '"';
		} elseif ($type === 'js') {
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
	global $groupFolders, $circles; // Ensure these are accessible in this function

	// Select a random group
	$groupFolder = $groupFolders[$index % count($groupFolders)];

	// Select a random image from the group
	$images = glob(__DIR__ . "/../ui/img/circles/$groupFolder/*.jpg"); // Adjust path to be relative
	if (!$images) {
		return ''; // Handle case where no images are found
	}

	$image = $images[array_rand($images)];
	$alt = $circles[$groupFolder];

	return '<img class="img-fluid rounded-circle" alt="'
		 . htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') . '" src="/ui/img/circles/'
		 . htmlspecialchars($groupFolder, ENT_QUOTES, 'UTF-8') . '/'
		 . htmlspecialchars(basename($image), ENT_QUOTES, 'UTF-8') . '">';
}

function renderContentRow($index, $data) {
	$textColumn = '<div class="col-lg-6 order-1 order-lg-2">' . $data . '</div>';

	$lr = ($index % 2); // $lr for "left or right"
	// Debugging output to check the value of $index
	//echo "<!-- Debug: \$index = $index, \$lr = \$index % 2 = " . $lr . " -->" . PHP_EOL;

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
	$socials = fetchData('data/socials', true);
	$links = [];
	foreach ($socials as $name => $details) {
		$url = $details['url'];
		$icon = $details['icon'];
		if ($asButtons) {
			$link = '<a class="btn btn-secondary btn-circle btn-circle-sm"'
				  . ' role="button" href="https://' . $url . '" title="' . $name
				  . '" target="_blank"><i class="' . $icon . '"></i></a>';
		} else {
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

function init() {
	global $updated, $canonical, $languages, $currentLanguage, $languageData;

	// Set language
	if (isset($_GET['language'])) {
		$currentLanguage = $_GET['language'];
	} elseif (isset($_SESSION['language'])) {
		$currentLanguage = $_SESSION['language'];
	} else {
		$currentLanguage = $languages[0]; // default language
	}
	$_SESSION['language'] = $currentLanguage;

	// Set default timezone
	date_default_timezone_set('UTC');

	// Construct canonical URL
	$canonical = $canonical . $currentLanguage;

	// Load language data
	$commonData = fetchData('data/common/' . $currentLanguage, true);
	$contentData = fetchData('data/invite/' . $currentLanguage, true);

	// Merge shared and content data
	$languageData = array_merge($commonData, $contentData);

	// Merge shared and content data
	$languageData = array_merge($commonData, $contentData);

	// Set the 'lang' key in $languageData
	if ($currentLanguage === 'EN') {
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
