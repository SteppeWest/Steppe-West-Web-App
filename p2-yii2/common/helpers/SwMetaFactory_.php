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
use common\components\SwMetaObject;
use common\assets\SwMetaAsset;

abstract class SwMetaFactory extends SwFactory
{
	public const FRONT_END       = 10;
	public const BACK_END        = 20;
	public const ERROR_PAGE      = 30;

	/**
	 * API functions
	 */

	public static function meta(View $view, int $pageType = static::FRONT_END, ?string $title = null): SwMetaObject
	{
		$assetUrl     = static::assetUrl();
		$locale       = static::pageLocale();
		$title        = static::pageTitle($pageType, $title);
		$canonicalUrl = static::canonicalUrl($pageType);
		$description  = static::pageDescription($pageType);
		$keywords     = static::pageKeywords($pageType);

		return new SwMetaObject(
			$view,
			$pageType,
			$assetUrl,
			$locale,
			$title,
			$canonicalUrl,
			$description,
			$keywords,
		);
	}

	public static function frontend(View $view, ?string $title = null): SwMetaObject
	{
		return static::meta($view, static::FRONT_END ,$title);
	}

	public static function f(View $view, ?string $title = null): SwMetaObject
	{
		return static::frontend($view ,$title);
	}

	public static function backend(View $view, ?string $title = null): SwMetaObject
	{
		return static::meta($view, static::BACK_END ,$title);
	}

	public static function b(View $view, ?string $title = null): SwMetaObject
	{
		return static::backend($view ,$title);
	}

	public static function errorPage(View $view, ?string $title = null): SwMetaObject
	{
		return static::meta($view, static::ERROR_PAGE ,$title);
	}

	public static function e(View $view, ?string $title = null): SwMetaObject
	{
		return static::errorPage($view ,$title);
	}

	/**
	 * helper functions
	 */

	protected static function assetClass(): string
	{
		return SwMetaAsset::class;
	}

	protected static function assetUrl(): string
	{
		$assetClass = static::assetClass();
		$asset = $assetClass::register(Yii::$app->view);

		return $asset->baseUrl;
	}

	protected static function pageLocale(): string
	{
		return; // default 'en_AU'
	}

	protected static function pageTitle(int $pageType, ?string $title = null): string
	{
		// need to decide whether to prioritise  tile passed in or title found in data
		// if necessary attempt to get title from data
		// return 'Steppe West' if neither title contains a non-empty string

		return; // default 'Steppe West'
	}

	protected static function canonicalUrl(int $pageType): ?string
	{
		if ($pageType !== static::FRONT_END) {
			return null;
		}

		return; // "https://steppewest.com/" . path/to/page/lc
	}

	protected static function pageDescription(int $pageType): ?string
	{
		if ($pageType !== static::FRONT_END) {
			return null;
		}

		// attempt to get description from data
		// return found description or null if nothing found

		return; // default null
	}

	protected static function pageKeywords(int $pageType): ?string
	{
		if ($pageType !== static::FRONT_END) {
			return null;
		}

		// attempt to get keywords from data
		// return found keywords or null if nothing found

		return; // default null
	}

	protected static function languageFromUrl(): ?string
	{
		return;
	}

	protected static function detectedLanguage(): ?string
	{
		return;
	}

	protected static function availableLanguageCodesForCurrentPage(): array
	{
		return;
	}

	protected static function resolveLanguageCode(): string
	{
		return;
	}

	protected static function resolveLocale(string $languageCode): string
	{
		return;
	}

	protected static function currentPageTranslation(string $languageCode): ?PageTranslation
	{
		return;
	}
}
?>
<?php
/**
 * SwMetaObject.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\components;

use yii\web\View;
use common\helpers\SwMetaFactory;

class SwMetaObject
{
	// SwMetaFactory::FRONT_END       = 10
	// SwMetaFactory::BACK_END        = 20
	// SwMetaFactory::ERROR_PAGE      = 30

	protected View    $view;
	protected int     $pageType     = SwMetaFactory::FRONT_END;
	protected string  $assetUrl;
	protected string  $locale       = 'en_AU';
	protected string  $title        = 'Steppe West';
	protected ?string $canonicalUrl = null;
	protected ?string $description  = null;
	protected ?string $keywords     = null;

	private const VIEWPORT = 'width=device-width, initial-scale=1, shrink-to-fit=no';
	private const FOLLOW   = 'index,follow';
	private const NOFOLLOW = 'noindex,nofollow';
	private const AUTHOR   = 'Pedro Plowman for Steppe West';


	public function __construct(
		View $view,
		int $pageType = SwMetaFactory::FRONT_END,
		string $assetUrl,
		string $locale = 'en_AU',
		string $title = 'Steppe West',
		?string $canonicalUrl = null,
		?string $description = null,
		?string $keywords = null,
	)
	{
		$this->view = $view;
		$this->pageType = $pageType;
		$this->assetUrl = rtrim($assetUrl, '/');
		$this->locale = $locale;
		$this->title = $title;
		$this->canonicalUrl = $canonicalUrl;
		$this->description = $description;
		$this->keywords = $keywords;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return '';
	}

	static protected function frontend()
	{
		$this->view->registerMetaTag([
			'name' => 'viewport',
			'content' => self::VIEWPORT,
		]); // viewport
		$this->view->registerMetaTag([
			'name' => 'robots',
			'content' => self::FOLLOW,
		]); // robots

		$this->view->registerMetaTag([
			'name' => 'description',
			'content' => $this->description,
		]); // description
		$this->view->registerMetaTag([
			'name' => 'keywords',
			'content' => $this->keywords,
		]); // keywords

		$this->view->registerMetaTag([
			'name' => 'author',
			'content' => self::AUTHOR,
		]); // author
	}

	static protected function backend()
	{
		$this->view->registerMetaTag([
			'name' => 'viewport',
			'content' => self::VIEWPORT,
		]); // viewport
		$this->view->registerMetaTag([
			'name' => 'robots',
			'content' => self::NOFOLLOW,
		]); // robots

		$this->view->registerMetaTag([
			'name' => 'author',
			'content' => self::AUTHOR,
		]); // author
	}

	static protected function errorPage()
	{
		$this->view->registerMetaTag([
			'name' => 'viewport',
			'content' => self::VIEWPORT,
		]); // viewport
		$this->view->registerMetaTag([
			'name' => 'robots',
			'content' => self::NOFOLLOW,
		]); // robots

		$this->view->registerMetaTag([
			'name' => 'author',
			'content' => self::AUTHOR,
		]); // author
	}

/**
 * frontend

<meta property="og:type" content="article">
<meta property="og:url" content="https://steppewest.com/intro/en">
<meta property="og:title" content="Discover Steppe West: Bringing Central Asia to the World">
<meta property="og:description" content="Showcasing the rich and diverse music and cultures of Central Asia to the English speaking world.">
<meta property="og:image" content="/assets/90e6fbce/img/og_image_01-1200x0630.jpeg">
<meta property="og:image" content="/assets/90e6fbce/img/og_image_02-1200x0630.jpeg">
<meta property="og:updated_time" content="2024-07-08">
<meta property="og:locale" content="en_AU">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="https://steppewest.com/intro/en">
<meta name="twitter:title" content="Discover Steppe West: Bringing Central Asia to the World">
<meta name="twitter:description" content="Showcasing the rich and diverse music and cultures of Central Asia to the English speaking world.">
<meta name="twitter:image" content="/assets/90e6fbce/img/og_image_01-1200x0630.jpeg">
<meta name="twitter:image" content="/assets/90e6fbce/img/og_image_02-1200x0630.jpeg">

<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="/assets/90e6fbce/ico/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<link href="https://steppewest.com/intro/en" rel="canonical">

<link href="/assets/90e6fbce/ico/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
<link type="image/png" href="/assets/90e6fbce/ico/favicon-32x32.png" rel="icon" sizes="32x32">
<link type="image/png" href="/assets/90e6fbce/ico/favicon-16x16.png" rel="icon" sizes="16x16">
<link href="/assets/90e6fbce/ico/site.webmanifest" rel="manifest">
<link href="/assets/90e6fbce/ico/safari-pinned-tab.svg" rel="mask-icon" color="#5bbad5">
<link href="/assets/90e6fbce/ico/favicon.ico" rel="shortcut icon">

 * error

<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="/assets/90e6fbce/ico/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<link href="/assets/90e6fbce/ico/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
<link type="image/png" href="/assets/90e6fbce/ico/favicon-32x32.png" rel="icon" sizes="32x32">
<link type="image/png" href="/assets/90e6fbce/ico/favicon-16x16.png" rel="icon" sizes="16x16">
<link href="/assets/90e6fbce/ico/site.webmanifest" rel="manifest">
<link href="/assets/90e6fbce/ico/safari-pinned-tab.svg" rel="mask-icon" color="#5bbad5">
<link href="/assets/90e6fbce/ico/favicon.ico" rel="shortcut icon">

 * backend

<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="/assets/90e6fbce/ico/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<link href="/assets/90e6fbce/ico/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
<link type="image/png" href="/assets/90e6fbce/ico/favicon-32x32.png" rel="icon" sizes="32x32">
<link type="image/png" href="/assets/90e6fbce/ico/favicon-16x16.png" rel="icon" sizes="16x16">
<link href="/assets/90e6fbce/ico/site.webmanifest" rel="manifest">
<link href="/assets/90e6fbce/ico/safari-pinned-tab.svg" rel="mask-icon" color="#5bbad5">
<link href="/assets/90e6fbce/ico/favicon.ico" rel="shortcut icon">

 */
}
