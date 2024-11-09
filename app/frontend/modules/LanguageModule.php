<?php
/**
 * LanguageModule.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\modules;

/**
 * SwLanguage module definition class
 */
class LanguageModule extends \yii\base\Module
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'frontend\modules\controllers';

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();

		// custom initialization code goes here
	}


	public function getFlagIcon($flagIcon)
	{
		$codePoints = [
			127397 + ord($flagIcon[0]),
			127397 + ord($flagIcon[1])
		];
		return mb_convert_encoding('&#' . implode(';&#', $codePoints) . ';', 'UTF-8', 'HTML-ENTITIES');
	}

	public function createMenuItems()
	{
		// Get the current URL components
		$currentUrl = Url::current();
		$parsedUrl = parse_url($currentUrl);

		// Ensure $queryParams is a string
		$queryParams = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';
		$queryArray = [];
		parse_str($queryParams, $queryArray);

		// Fetch active languages ordered by menu_position
		$languages = SwLanguage::find()
			->where(['active' => true])
			->orderBy(['menu_position' => SORT_ASC])
			->all();

		$menuItems = [];

		foreach ($languages as $language) {
			// Generate the label with the flag emoji and UI label
			$flagEmoji = $this->getFlagIcon($language->flag_icon);
			$label = $flagEmoji . ' ' . Html::encode($language->ui_label);

			// Modify the URL to include or replace `lc` with `lang_code`
			$queryArray['lc'] = $language->lang_code;
			$newUrl = Url::to(array_merge([$parsedUrl['path']], $queryArray));

			// Add to menuItems
			$menuItems[] = [
				'label' => $label,
				'url' => $newUrl,
			];
		}

		return $menuItems;
	}
	{
		foreach ($languages as $language) {
			// Generate the label with the flag emoji and UI label
			$flagEmoji = $this->getFlagIcon($language->flag_icon);
			$label = $flagEmoji . ' ' . Html::encode($language->ui_label);

			// Construct the new URL path by replacing or appending the language code
			$path = isset($parsedUrl['path']) ? trim($parsedUrl['path'], '/') : '';
			$segments = explode('/', $path);

			// If `lc` is already in the URL, replace it with the current language code
			if (isset($segments[1])) {
				$segments[1] = $language->lang_code;
			} else {
				// Otherwise, append the language code as a new segment
				$segments[] = $language->lang_code;
			}

			// Reconstruct the path and generate the URL
			$newUrl = '/' . implode('/', $segments);

			// Add to menuItems
			$menuItems[] = [
				'label' => $label,
				'url' => $newUrl,
			];
		}
	}
	{
		// Determine the base URL
		$baseUrl = Url::base(true);

		foreach ($languages as $language) {
			// Generate the label with the flag emoji and UI label
			$flagEmoji = $this->getFlagIcon($language->flag_icon);
			$label = $flagEmoji . ' ' . Html::encode($language->ui_label);

			// Construct the new URL path by replacing or appending the language code
			$path = isset($parsedUrl['path']) ? trim($parsedUrl['path'], '/') : '';
			$segments = explode('/', $path);

			// If the language code (lc) is already in the URL, replace it
			if (isset($segments[1])) {
				$segments[1] = $language->lang_code;
			} else {
				// Otherwise, append the language code as a new segment
				$segments[] = $language->lang_code;
			}

			// Reconstruct the path and generate the full URL
			$newUrl = $baseUrl . '/' . implode('/', $segments);

			// Add to menuItems
			$menuItems[] = [
				'label' => $label,
				'url' => $newUrl,
			];
		}
	}
}
