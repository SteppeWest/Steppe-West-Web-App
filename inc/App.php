<?php

class App {
	private static $_updated;
	private static $_canonical;
	private static $_subdomain;
	private static $_languages;
	private $_language; // an instance of Language
	//private $_languageData;

	public function __construct($updated, $canonical) {
		self::$_updated = $updated;
		self::$_canonical = $canonical;
		$this->init();
	}

	public function init() {
		date_default_timezone_set('UTC');
		self::$_languages = $this->loadLanguages();
		$code = $this->getLanguageFromUrl();
		$data = $this->fetchLanguageData($code);
		$data['code'] = $code;
		/* stock data fields
			'code',
			'updated',
			'canonical',
			'locale',
			'lang',
			'flag',
			'label',
			'name',
			'native',
			'title',
			'subtitle,
			'description',
			'keywords',
			'origin',
			'footer1',
			'footer2',
			'footer3',
			'copy',
		 */
		$this->_language = new Language($this, $data);
	}

	private function loadLanguages() {
		$languagesData = $this->fetchData('languages');
		$languages = [];
		foreach ($languagesData as $code => $data) {
			$languages[$code] = new Language($code, $data);
		}
		return $languages;
	}

	private function getLanguageFromUrl() {
		$languages = self::$_languages;
		$languageCode = isset($_GET['language']) && array_key_exists($_GET['language'], $languages)
			? $_GET['language']
			: array_key_first($languages);
		return $languages[$languageCode];
	}

	private function fetchLanguageData($langCode) {
		$subdomain = $this->subdomain();

		$folder = $subdomain ? $subdomain . '/' : 'home/';

		// Load language data
		$baseData = self::$_languages($langCode);
		$commonData = $this->fetchData('common/' . $langCode, true);
		$contentData = $this->fetchData($folder . $langCode, true);

		// Merge shared and content data
		$languageData = array_merge($baseData, $commonData, $contentData);

		return $languageData;
	}

	public function subdomain() {
		if (!isset(self::$_subdomain)) {
			$host = $_SERVER['HTTP_HOST'];
			$parts = explode('.', $host);
			$subdomain = '';
			if (count($parts) > 2) {
				$subdomain = $parts[0];
			}
			self::$_subdomain = $subdomain;
		}
		return self::$_subdomain;
	}

	public function basePath() {
		$subdomain = $this->subdomain();
		return $subdomain ? '../' : '';
	}

	public function languages() {
		return self::$_languages;
	}

	public function lang() {
		return $this->_language->getLang();
	}

	public function locale() {
		return $this->_language->getLocale();
	}

	public function flag() {
		return $this->getFlagEmoji($this->_language->getFlag());
	}

	public function label() {
		return $this->_language->getLabel();
	}

	public function data() {
		return $this->_languageData;
	}

	public function updated() {
		return self::$_updated;
	}

	public function canonical() {
		return self::$_canonical . $this->lang();
	}

	public function getFlagEmoji($countryCode) {
		if (strlen($countryCode) !== 2 || !ctype_alpha($countryCode)) {
			return 'NF';
		}
		$codePoints = [
			127397 + ord(strtoupper($countryCode[0])),
			127397 + ord(strtoupper($countryCode[1]))
		];
		$emoji = mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
		return $emoji ?: 'NF';
	}

	public static function sanitise($data) {
		if (is_array($data)) {
			return array_map(['App', 'sanitise'], $data);
		}
		return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
	}

	public function fetchData($file, $sanitise = false) {
		$filePath = __DIR__ . '/' . $file . '.php';
		$data = [];
		if (file_exists($filePath)) {
			$data = include $filePath;
			if ($sanitise) {
				$data = self::sanitise($data);
			}
		} else {
			echo "'{$file}' not found.";
		}
		return $data;
	}

}
?>
<?php

class App {

	private function getLanguageCodeFromUrl() {
		$languages = self::$_languages;
		return isset($_GET['language']) && array_key_exists($_GET['language'], $languages)
			? $_GET['language']
			: array_key_first($languages);
	}

	private function fetchLanguageData() {
		$subdomain = $this->subdomain();

		$folder = $subdomain ? $subdomain . '/' : 'home/';

		// Load language data
		$commonData = $this->fetchData('common/' . $this->languageCode(), true);
		$contentData = $this->fetchData($folder . $this->languageCode(), true);

		// Merge shared and content data
		$languageData = array_merge($commonData, $contentData);

		// Load substitutions data
		$substitutionLinks = $this->fetchData('substitutions');
		$substitutions = [];
		foreach ($substitutionLinks as $placeholder => $data) {
			$link = '<a class="link-info link-opacity-75-hover text-decoration-none" href="https://'
				  . $data['url'] . '" title="' . $data['title']
				  . '" target="_blank">' . $data['label'] . '</a>';
			$substitutions[$placeholder] = $link;
		}
		$substitutions['UA'] = $this->getFlagEmoji('UA');
		$substitutions['PS'] = $this->getFlagEmoji('PS');

		// Perform substitutions in the target fields
		$this->substitutePlaceholders('Substack', $languageData['origin'], $substitutions);
		$this->substitutePlaceholders('GubbiGubbi', $languageData['footer1'], $substitutions);
		$this->substitutePlaceholders('KabiKabi', $languageData['footer1'], $substitutions);
		$this->substitutePlaceholders('UA', $languageData['footer3'], $substitutions);
		$this->substitutePlaceholders('PS', $languageData['footer3'], $substitutions);

		// Combine subtitle and description if both are present
		if (isset($languageData['description']) && isset($languageData['subtitle'])) {
			$languageData['description'] = $languageData['subtitle'] . '. ' . $languageData['description'];
		}

		return $languageData;
	}

	public function subdomain() {
		if (!isset(self::$_subdomain)) {
			$host = $_SERVER['HTTP_HOST'];
			$parts = explode('.', $host);
			$subdomain = '';
			if (count($parts) > 2) {
				$subdomain = $parts[0];
			}
			self::$_subdomain = $subdomain;
		}
		return self::$_subdomain;
	}

	public function basePath() {
		$subdomain = $this->subdomain();
		return $subdomain ? '../' : '';
	}

	public function languages() {
		if (!isset(self::$_languages)) {
			self::$_languages = $this->fetchData('languages');
		}
		return self::$_languages;
	}

	public function languageCode() {
		return $this->_languageCode;
	}

	private function validateLanguageCode($languageCode) {
		return isset($languageCode) && array_key_exists($languageCode, self::$_languages)
			? $languageCode
			: $this->languageCode();
	}

	public function lang() {
		return self::$_languages[$this->languageCode()]['lang'];
	}

	public function locale() {
		return self::$_languages[$this->languageCode()]['locale'];
	}

	public function flag($languageCode = null) {
		$languageCode = $this->validateLanguageCode($languageCode);
		$flagCode = self::$_languages[$languageCode]['flag'];
		return $this->getFlagEmoji($flagCode);
	}

	public function label($languageCode = null) {
		$languageCode = $this->validateLanguageCode($languageCode);
		return self::$_languages[$languageCode]['label'];
	}

	public function languageData() {
		return $this->_languageData;
	}

	public function updated() {
		return self::$_updated;
	}

	public function canonical() {
		return self::$_canonical . $this->languageCode();
	}

	public function getFlagEmoji($countryCode) {
		if (strlen($countryCode) !== 2 || !ctype_alpha($countryCode)) {
			return 'NF';
		}
		$codePoints = [
			127397 + ord(strtoupper($countryCode[0])),
			127397 + ord(strtoupper($countryCode[1]))
		];
		$emoji = mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
		return $emoji ?: 'NF';
	}

	public static function sanitise($data) {
		if (is_array($data)) {
			return array_map(['App', 'sanitise'], $data);
		}
		return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
	}

	public function fetchData($file, $sanitise = false) {
		$filePath = __DIR__ . '/data/' . $file . '.php';
		$data = [];
		if (file_exists($filePath)) {
			$data = include $filePath;
			if ($sanitise) {
				$data = self::sanitise($data);
			}
		} else {
			echo "'{$file}' not found.";
		}
		return $data;
	}

	private function substitutePlaceholders($placeholder, &$target, $substitutions) {
		if (isset($substitutions[$placeholder])) {
			$target = str_replace("{{$placeholder}}", $substitutions[$placeholder], $target);
		}
	}
}
