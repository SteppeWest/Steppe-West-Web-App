<?php
/**
 * SwMetaFactory.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Load this factory with...
 * use common\helpers\SwMetaFactory;
 */

namespace common\helpers;

use Yii;
use yii\web\View;
use common\assets\SwMetaAsset;

/**
 * Data Dictionary
 *
 * All accepted data is a flat dictionary of non-empty string keys
 * and non-empty string values.
 *
 * Data originating from params is treated as safe defaults.
 * Caller-supplied data is filtered before use.
 *
 * Only the keys listed below are consumed by this factory.
 * Unknown keys may be accepted into the merged options array,
 * but are ignored unless explicitly used by the registration logic.
 *
 * 'title'        => 'Page Title',             // from params
 * 'author'       => 'Page Author',            // from params
 * 'contentType'  => 'content-type',           // from params
 * 'description'  => 'Page description.',
 * 'keywords'     => 'Page keywords',
 * 'canonicalUrl' => 'http://steppewest.com/...',
 * 'updatedTime'  => 'timestamp',
 *
 * Override with extreme caution.
 *
 * 'locale'       => 'locale',                 // from params
 * 'viewport'     => 'viewport',               // from params
 */

/**
	Yii::$app->params['swMeta'] => [
		'locale'      => 'en_AU',
		'viewport'    => 'width=device-width, initial-scale=1, shrink-to-fit=no',
		'title'       => 'Steppe West',
		'author'      => 'Pedro Plowman for Steppe West',
		'contentType' => 'article',
	],
 */

abstract class SwMetaFactory
{
	/**
	 * 0 to 9   - abnormal conditions
	 * 10 to 19 - frontend pages
	 * 20 to 29 - backend pages
	 */
	protected const ERROR_PAGE   = 0;
	protected const FRONT_END    = 10;
	protected const BACK_END     = 20;

	protected const TWITTER_CARD = [
		'name'    => 'twitter:card',
		'content' => 'summary_large_image',
	];

	/**
	 * API functions
	 */

	public static function frontend(View $view, array $options = []): void
	{
		static::registerMetaData($view, self::FRONT_END, $options);
	}

	public static function f(View $view, array $options = []): void
	{
		static::frontend($view, $options);
	}

	public static function backend(View $view): void
	{
		static::registerMetaData($view, self::BACK_END);
	}

	public static function b(View $view): void
	{
		static::backend($view);
	}

	public static function errorPage(View $view): void
	{
		static::registerMetaData($view, self::ERROR_PAGE);
	}

	public static function e(View $view): void
	{
		static::errorPage($view);
	}

	/**
	 * Master function
	 */

	protected static function registerMetaData(View $view, int $pageType, array $options = []): void
	{
		$options  = static::mergeOptions($options);
		$asset    = SwMetaAsset::register($view);
		$assetUrl = $asset->baseUrl;
		$fullMeta = $pageType === self::FRONT_END;

		/**
		 * No special treatment required for these
		 */
		$view->registerMetaTag([
			'charset' => Yii::$app->charset,
		]); // charset
		$view->registerMetaTag([
			'http-equiv' => 'X-UA-Compatible',
			'content'    => 'IE=edge'
		]); // http-equiv
		$view->registerMetaTag([
			'name'    => 'viewport',
			'content' => $options['viewport'] ?? 'width=device-width, initial-scale=1, shrink-to-fit=no',
		]); // viewport
		$view->registerMetaTag([
			'name'    => 'robots',
			'content' => $fullMeta ? 'index,follow' : 'noindex,nofollow',
		]); // robots
		$view->registerMetaTag([
			'name'    => 'author',
			'content' => $options['author'] ?? 'Pedro Plowman for Steppe West',
		]); // author

		foreach ($asset->browserLinks() as $link) {
			$view->registerLinkTag($link);
		}

		foreach ($asset->browserMeta() as $meta) {
			$view->registerMetaTag($meta);
		}

		if ($fullMeta) {
			$view->registerMetaTag([
				'property' => 'og:locale',
				'content'  => $options['locale'] ?? 'en_AU',
			]); // og:locale
			$view->registerMetaTag(self::TWITTER_CARD); // twitter:card

			if (static::hasStringValue($options['title'] ?? null)) {
				$view->registerMetaTag([
					'property' => 'og:title',
					'content'  => $options['title'],
				]); // og:title
				$view->registerMetaTag([
					'name'    => 'twitter:title',
					'content' => $options['title'],
				]); // twitter:title
			}
			if (static::hasStringValue($options['description'] ?? null)) {
				$view->registerMetaTag([
					'name'    => 'description',
					'content' => $options['description'],
				]); // description
				$view->registerMetaTag([
					'property' => 'og:description',
					'content'  => $options['description'],
				]); // og:description
				$view->registerMetaTag([
					'name'    => 'twitter:description',
					'content' => $options['description'],
				]); // twitter:description
			}
			if (static::hasStringValue($options['keywords'] ?? null)) {
				$view->registerMetaTag([
					'name'    => 'keywords',
					'content' => $options['keywords'],
				]); // keywords
			}
			if (static::hasStringValue($options['canonicalUrl'] ?? null)) {
				$view->registerLinkTag([
					'href' => $options['canonicalUrl'],
					'rel'  => 'canonical',
				]); // canonicalUrl
				$view->registerMetaTag([
					'property' => 'og:url',
					'content'  => $options['canonicalUrl'],
				]); // og:url
				$view->registerMetaTag([
					'name'    => 'twitter:url',
					'content' => $options['canonicalUrl'],
				]); // twitter:url
			}
			if (static::hasStringValue($options['contentType'] ?? null)) {
				$view->registerMetaTag([
					'property' => 'og:type',
					'content'  => $options['contentType'],
				]); // og:type
			}
			if (static::hasStringValue($options['updatedTime'] ?? null)) {
				$view->registerMetaTag([
					'property' => 'og:updated_time',
					'content'  => $options['updatedTime'],
				]); // og:updated_time
			}

			foreach ($asset->browserImages() as $image) {
				$view->registerMetaTag([
					'property' => 'og:image',
					'content'  => $image,
				]); // og:image
				$view->registerMetaTag([
					'name'    => 'twitter:image',
					'content' => $image,
				]); // twitter:image
			}
		}
	}

	/**
	 * Helper functions
	 */

	protected static function mergeOptions(array $options): array
	{
		$params = Yii::$app->params['swMeta'] ?? [];
		$newOptions = [];

		foreach ($options as $name => $value) {
			if (
				static::hasStringValue($name) &&
				static::hasStringValue($value)
			) {
				$newOptions[$name] = $value;
			}
		}

		return array_replace($params, $newOptions);
	}

	protected static function hasStringValue(mixed $value): bool
	{
		return is_string($value) && trim($value) !== '';
	}
}
