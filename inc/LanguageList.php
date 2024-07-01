<?php

class LanguageList {
	private static $_languages;

	public function __construct($app) {
		self::$_languages = $app->fetchData('languages');
	}

		'locale' => 'mn_MN',
		'lang' => 'mn',
		'flag' => 'MN',
		'label' => 'MN',
		'name' => 'Mongolian',
		'native' => 'Монгол',


	public function code() {
		return $this->_data['code'];
	}

	public function updated() {
		return $this->_data['updated'];
	}

	public function canonical() {
		return $this->_data['canonical'];
	}

	public function locale() {
		return $this->_data['locale'];
	}

	public function flag() {
		return $this->_data['flag'];
	}

	public function label() {
		return $this->_data['label'];
	}

	public function name() {
		return $this->_data['name'];
	}

	public function nativeName() {
		return $this->_data['native'];
	}

	public function title() {
		return $this->_data['title'];
	}

	public function subtitle() {
		return $this->_data['subtitle'];
	}

	public function description() {
		return $this->_data['description'];
	}

	public function keywords() {
		return $this->_data['keywords'];
	}

	public function origin() {
		return $this->_data['origin'];
	}

	public function footer($index) {
		$key = 'footer' . $index;
		return $this->_data[$key];
	}

	public function copyright() {
		return $this->_data['copy'];
	}

	public function pageData() {
		return $this->_data;
	}

	private function substitutePlaceholders($placeholder, &$target, $substitutions) {
		if (isset($substitutions[$placeholder])) {
			$target = str_replace("{{$placeholder}}", $substitutions[$placeholder], $target);
		}
	}
}
