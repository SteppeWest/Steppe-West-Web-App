<?php

class SW {
	private $config;
	private $currentLanguage = '';
	private $pageId = 'error';

	public function __construct($config) {
		$this->config = $config;
	}

	public function run() {
		// Load language maps
		$langmap = include $this->config['appPath'] . 'data/langmap.php';
		$languages = include $this->config['appPath'] . 'data/languages.php';

		// Evaluate the URL
		$this->evaluateUrl($langmap, $languages);

		// Output the results for debugging
		echo "Steppe West Web Application is running!<br>";
		echo "Page ID: " . $this->pageId . "<br>";
		echo "Current Language: " . $this->currentLanguage;
	}

	private function evaluateUrl($langmap, $languages) {
		$url = $_SERVER['REQUEST_URI'];
		$host = $_SERVER['HTTP_HOST'];

		// Parse the URL path
		$path = trim(parse_url($url, PHP_URL_PATH), '/');
		$pathParts = explode('/', $path);

		// Default language
		$defaultLanguage = 'en';

		// Check the root domain or subdomain
		if (strpos($host, 'invite.steppewest.') === 0) {
			$domainType = 'invite';
		}
		else {
			$domainType = 'root';
		}

		// Initialize
		$this->currentLanguage = '';
		$this->pageId = 'error';

		if (count($pathParts) == 1) {
			$firstPart = $pathParts[0];

			if (empty($firstPart)) {
				// Root URL, set to default language
				$this->currentLanguage = $langmap[array_key_first($langmap)] ?? $defaultLanguage;
				$this->pageId = ($domainType == 'root') ? 'home' : 'invite';
			}
			elseif (isset($langmap[$firstPart])) {
				// Country code, replace with corresponding language code
				$this->currentLanguage = $langmap[$firstPart];
				$this->pageId = ($domainType == 'root') ? 'home' : 'invite';
			}
			elseif (isset($languages[$firstPart])) {
				// Language code
				$this->currentLanguage = $firstPart;
				$this->pageId = ($domainType == 'root') ? 'home' : 'invite';
			}
		}
		elseif (count($pathParts) == 2 && $domainType == 'invite' && $pathParts[0] == 'faq') {
			$secondPart = $pathParts[1];
			if (isset($languages[$secondPart])) {
				// FAQ URL with valid language code
				$this->currentLanguage = $secondPart;
				$this->pageId = 'faq';
			}
		}

		// If a valid language code was found or set, set the current language
		if (!empty($this->currentLanguage)) {
			$_SESSION['language'] = $this->currentLanguage;
		}
	}

}
