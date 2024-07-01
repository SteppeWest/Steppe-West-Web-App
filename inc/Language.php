<?php

class Language {
	private static $_data; // array of remaining fields from page specific language data

	public function __construct($app, $data) {
		$data['updated'] = $app->updated();
		$data['canonical'] = $app->canonical();
		$data['flag'] = $app->getFlagEmoji($data['flag']);

		// Combine subtitle and description if both are present
		if (isset($data['description']) && isset($data['subtitle'])) {
			$data['description'] = $data['subtitle'] . '. ' . $data['description'];
		}

		// Load substitutions data
		$substitutionLinks = $app->fetchData('substitutions');
		$substitutions = [];
		foreach ($substitutionLinks as $placeholder => $data) {
			$link = '<a class="link-info link-opacity-75-hover text-decoration-none" href="https://'
				  . $data['url'] . '" title="' . $data['title']
				  . '" target="_blank">' . $data['label'] . '</a>';
			$substitutions[$placeholder] = $link;
		}
		$substitutions['UA'] = $app->getFlagEmoji('UA');
		$substitutions['PS'] = $app->getFlagEmoji('PS');

		// Perform substitutions in the target fields
		$this->substitutePlaceholders('Substack', $data['origin'], $substitutions);
		$this->substitutePlaceholders('GubbiGubbi', $data['footer1'], $substitutions);
		$this->substitutePlaceholders('KabiKabi', $data['footer1'], $substitutions);
		$this->substitutePlaceholders('UA', $data['footer3'], $substitutions);
		$this->substitutePlaceholders('PS', $data['footer3'], $substitutions);

		self::$_data = $data;
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
			'subtitle',
			'description',
			'keywords',
			'origin',
			'footer1',
			'footer2',
			'footer3',
			'copy',
		 */
	}

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

	public function lang() {
		return $this->_data['lang'];
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
