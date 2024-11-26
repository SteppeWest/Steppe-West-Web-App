<?php
// Function to determine the TLD and protocol
function getBaseURL() {
	// Get the host
	$host = $_SERVER['HTTP_HOST'];

	// Determine the protocol
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";

	// Determine the TLD
	if (strpos($host, '.p2m') !== false) {
		$tld = 'p2m';
	} else {
		$tld = 'com';
	}

	// Construct the base URL for the common content
	$baseURL = "{$protocol}://common.steppewest.{$tld}/";

	return $baseURL;
}

// Get the flag emoji for a passed language/country code
// If passed 'EN' it will be converted to 'GB'
function getFlagEmoji($languageCode) {
	// Change 'EN' to 'GB' if necessary
	if ($languageCode === 'EN') {
		$languageCode = 'GB';
	}

	// Calculate the code points for the flag emoji
	$codePoints = [
		127397 + ord($languageCode[0]),
		127397 + ord($languageCode[1])
	];

	// Convert the code points to a flag emoji
	$flagEmoji = mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');

	return $flagEmoji;
}

// Function to write meta tags
function metaTags($meta) {
	foreach ($meta as $name => $content) {
		echo '<meta name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '" content="' . htmlspecialchars($content, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
	}
}

function navigationLinks($languages, $currentLanguage) {
	$navigation = '';
	foreach ($languages as $languageCode => $data) {
		$label = getFlagEmoji($languageCode) . ' ' . $languageCode;
		$class = ($languageCode === $currentLanguage) ? ' active' : '';
		$navigation .= '<li class="nav-item"><a class="nav-link' . $class . '" href="/' . $languageCode . '">' . $label . '</a></li>' . PHP_EOL;
	}
	return $navigation;
}

function languageButtons($languages, $currentLanguage) {
	$buttons = '';
	foreach ($languages as $languageCode => $data) {
		$flag = getFlagEmoji($languageCode);
		$label = getFlagEmoji($languageCode) . ' ' . $languageCode;
		$buttonClass = ($languageCode === $currentLanguage) ? 'btn-secondary active' : 'btn-secondary';
		$buttons .= '<a class="btn btn-sm ' . $buttonClass . '" role="button" href="/' . $languageCode . '">'
				. $flag . ' ' . $languageCode . '</a>';
	}
	echo '<div class="btn-group">' . $buttons . '</div>';
}

function letter($language) {
	// Construct the file path
	$letterPath = 'inc/' . $language . '.min.php';

	// Check if the file exists before including it
	if (file_exists($letterPath)) {
		include $letterPath;
	} else {
		// Handle the case where the file doesn't exist
		echo "File '{$letterPath}' not found.";
	}
}

function socialLinks($socials) {
	$links = [];
	foreach ($socials as $name => $details) {
		$url = $details['url'];
		$icon = $details['icon'];
		$link = '<a href="https://' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" title="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '" target="_blank">'
			  . '<i class="' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . '"></i> '
			  . htmlspecialchars($name, ENT_QUOTES, 'UTF-8')
			  . '</a>';
		$links[] = $link;
	}
	echo implode(' ', $links); // Using en space for separation
}

function socialButtons($socials, $buttonType) {
	$links = [];
	foreach ($socials as $name => $details) {
		$url = $details['url'];
		$icon = $details['icon'];
		$link = '<a class="btn btn-' . htmlspecialchars($buttonType, ENT_QUOTES, 'UTF-8')
			  . ' btn-circle btn-circle-sm" role="button" target="_blank" href="https://'
			  . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" title="'
			  . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '">'
			  . '<i class="' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . '"></i>'
			  . '</a>';
		$links[] = $link;
	}
	echo implode('&nbsp;', $links); // Using en space for separation
}

function gubbiGubbi($title, $text, $url) {
	$l = '<a class="text-info" href="' . $url . '" title="';
	$l .= $title . '" target="_blank">' . $text . '</a>';
	echo $l;
}
