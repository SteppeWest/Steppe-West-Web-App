<?php
/**
 * SWLanguageSelector.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \app\languages\SWLanguageSelector
 *
 * use app\languages\SWLanguageSelector;
 */

namespace app\languages;

use Yii;
use yii\base\BootstrapInterface;
use yii\helpers\Url;

class SWLanguageSelector implements BootstrapInterface
{
	public function bootstrap($app)
	{
		// Only call getCurrentLanguage in bootstrap
		$this->getCurrentLanguage();
	}

	// get the current language by calling this from anywhere
	public static function getCurrentLanguage()
	{
		// Get the app language and request language
		$currentLanguage = Yii::$app->language;
		$requestLanguage = Yii::$app->request->get('language');

		// If they're the same, return the app language
		if ($currentLanguage === $requestLanguage) {
			return $currentLanguage;
		}

		// Set $language from the request language and get the default language
		$language = $requestLanguage;
		$defaultLanguage = Yii::$app->params['swDefaultLanguage'];

		// If $language has a value...
		if ($language) {
			// Check it against swLanguageMap
			$languageMap = Yii::$app->params['swLanguageMap'];
			if (array_key_exists($language, $languageMap)) {
				$language = $languageMap[$language];
			}

			// Check it against swLanguages and set to default on failure
			if (!in_array($language, Yii::$app->params['swLanguages'])) {
				$language = $defaultLanguage;
			}
		}
		else {
			// Otherwise, set it to default
			$language = $defaultLanguage;
		}

		// Update the app language
		Yii::$app->language = $language;

		// Update the URL if $language has changed
		if ($requestLanguage !== $language) {
			self::updateUrl($language);
		}

		// Return the final value of $language
		return $language;
	}

	private function updateUrl($language)
	{
		$currentUrl = Yii::$app->request->url;
		$parsedUrl = parse_url($currentUrl);
		$queryParams = [];
		if (isset($parsedUrl['query'])) {
			parse_str($parsedUrl['query'], $queryParams);
		}

		$queryParams['language'] = $language;
		$newQuery = http_build_query($queryParams);
		$newUrl = Url::to([$parsedUrl['path'], $newQuery]);

		Yii::$app->response->redirect($newUrl)->send();
		Yii::$app->end();
	}
}
