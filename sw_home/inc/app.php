<?php
$languages = ['EN', 'RU', 'AZ', 'KG', 'KZ', 'MN', 'TJ', 'TM', 'UZ'];
/*
$languages[0] = 'EN';
$languages[1] = 'RU';
$languages[2] = 'AZ';
$languages[3] = 'KG';
$languages[4] = 'KZ';
$languages[5] = 'MN';
$languages[6] = 'TJ';
$languages[7] = 'TM';
$languages[8] = 'UZ';
 */

// Default language code
$defaultLanguage = $languages[4];

// Get the language code from the URL or use the default
$currentLanguage = isset($_GET['language']) ? strtoupper($_GET['language']) : $defaultLanguage;

$languageData = [];

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
	}
	return $html;
}

function renderNavigationLinks() {
	global $languages, $currentLanguage;
	$navigation = '';
	foreach ($languages as $languageCode) {
		$label = getFlagEmoji($languageCode) . ' ' . $languageCode;
		$class = ($languageCode === $currentLanguage) ? ' active' : '';
		$navigation .= '<li class="nav-item"><a class="nav-link' . $class . '" href="/' . $languageCode . '">' . $label . '</a></li>' . PHP_EOL;
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

function renderFlagsBanner() {
	global $languages;
	$alt = 'Steppe West ' . getFlagEmoji($languages[4])
		 . ' ' . getFlagEmoji($languages[3]) . ' ' . getFlagEmoji($languages[6])
		 . ' ' . getFlagEmoji($languages[7]) . ' ' . getFlagEmoji($languages[8])
		 . ' ' . getFlagEmoji($languages[2]) . ' ' . getFlagEmoji($languages[5]);
	$src = '/ui/img/flags-banner-1004x0200.png';
	$class = 'img-fluid';
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

	// Set default timezone
	date_default_timezone_set('UTC');

	// Construct canonical URL
	$canonical = $canonical . $currentLanguage;

	// Load language data
	$sharedData = fetchData('lang_shared/' . $currentLanguage, true);
	$contentData = fetchData('lang_content/' . $currentLanguage, true);

	// Merge shared and content data
	$languageData = array_merge($sharedData, $contentData);

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
