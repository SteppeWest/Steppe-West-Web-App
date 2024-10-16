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
 * @class \letter\languages\SWLanguageSelector
 *
 * use letter\languages\SWLanguageSelector;
 */

namespace letter\languages;

use Yii;
use yii\helpers\Url;

class SWLanguageSelector implements \yii\base\BootstrapInterface
{
	public function bootstrap($app)
	{
		$this->getCurrentLanguage();
	}

	// Get the current language by calling this from anywhere
	public static function getCurrentLanguage()
	{
		$currentLanguage = Yii::$app->language;
		$requestLanguage = Yii::$app->request->get('language');

		if ($currentLanguage === $requestLanguage) {
			return $currentLanguage;
		}

		$language = self::languageFromRequest($requestLanguage);

		Yii::$app->language = $language;

		return $language;
	}

	private static function languageFromRequest($language)
	{
		$inputLanguage = $language;
		$defaultLanguage = Yii::$app->params['swDefaultLanguage'];

		if ($language) {
			$languageMap = Yii::$app->params['swLanguageMap'];
			if (array_key_exists($language, $languageMap)) {
				$language = $languageMap[$language];
			} elseif (!in_array($language, Yii::$app->params['swLanguages'])) {
				$language = $defaultLanguage;
			}
		} else {
			$language = $defaultLanguage;
		}

		if ($language !== $inputLanguage) {
			self::updateUrl($language);
		}

		return $language;
	}

	private static function updateUrl($language)
	{
		$pathInfo = Yii::$app->request->pathInfo;
		$giiPattern = '/^gii/';

		if (YII_ENV_DEV && preg_match($giiPattern, $pathInfo)) {
			// Do not modify the URL for Gii in development environment
			return;
		}

		$newUrl = Url::to(['/site/index', 'language' => $language]);
		Yii::$app->response->redirect($newUrl)->send();
		Yii::$app->end();
	}
}
