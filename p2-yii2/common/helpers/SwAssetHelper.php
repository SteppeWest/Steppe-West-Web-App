<?php
/**
 * SwAssetHelper.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Centralised asset registration & URL helper.
 *
 * @class \common\helpers\SwAssetHelper
 * @package common\helpers
 *
 * use common\helpers\SwAssetHelper;
 */

namespace common\helpers;

use Yii;
use yii\web\View;
use common\assets\SwCommonAsset;

class SwAssetHelper
{
	const ENDPOINT_FRONTEND = 'frontend';
	const ENDPOINT_BACKEND  = 'backend';

	const LAYOUT_MAIN  = 'main';
	const LAYOUT_AUTH  = 'auth';
	const LAYOUT_ERROR = 'error';

	/** @var string|null */
	private static $endpoint = null;

	/** @var \yii\web\AssetBundle|null */
	private static $commonAsset = null;

	/** @var \yii\web\AssetBundle|null */
	private static $layoutAsset = null;

	/**
	 * Ensure endpoint is detected and cached.
	 */
	protected static function ensureEndpoint(): void
	{
		if (self::$endpoint !== null)
		{
			return;
		}

		$appId = Yii::$app->id;

		if ($appId === 'app-backend')
		{
			self::$endpoint = self::ENDPOINT_BACKEND;
		}
		else
		{
			// Treat everything else as frontend for now
			self::$endpoint = self::ENDPOINT_FRONTEND;
		}
	}

	/**
	 * Register assets for the current endpoint and given layout.
	 *
	 * @param string|null $layout 'main' (default), 'auth', 'error', etc.
	 */
	public static function registerAssets(string $layout = null): void
	{
		$view = Yii::$app->getView();

		if ($layout === null)
		{
			$layout = self::LAYOUT_MAIN;
		}

		self::ensureEndpoint();

		// Always register SwCommonAsset once per request
		if (self::$commonAsset === null)
		{
			self::$commonAsset = SwCommonAsset::register($view);
		}

		// If we already have a layout asset for this layout, nothing more to do
		if (self::$layoutAsset !== null)
		{
			return;
		}

		$map = Yii::$app->params['swAssetMap'] ?? [];

		if (isset($map[self::$endpoint][$layout]))
		{
			$class = $map[self::$endpoint][$layout];
			self::$layoutAsset[$layout] = $class::register($view);
			return;
		}
	}

	/**
	 * Base URL for the current asset set.
	 *
	 * @param bool        $common If true, return SwCommonAsset URL; otherwise layout-specific URL.
	 * @param string|null $layout Layout name when $common is false (defaults to 'main').
	 * @return string
	 */
	public static function assetURL(bool $common = true, string $layout = null): string
	{
		self::registerAssets($layout);

		if ($common)
		{
			if (self::$commonAsset !== null && !empty(self::$commonAsset->baseUrl))
			{
				return self::$commonAsset->baseUrl;
			}

			return '';
		}

		if (self::$layoutAsset !== null && !empty(self::$layoutAsset->baseUrl))
		{
			return self::$layoutAsset->baseUrl;
		}

		// Fallback – at worst use common if available, or empty string
		if (self::$commonAsset !== null && !empty(self::$commonAsset->baseUrl))
		{
			return self::$commonAsset->baseUrl;
		}

		return '';
	}

	/**
	 * Convenience: build a URL for a file under the current asset bundle.
	 *
	 * @param string      $relativePath Path relative to the asset bundle base (e.g. 'images/logo.svg')
	 * @param bool        $common       True for SwCommonAsset, false for layout asset.
	 * @param string|null $layout       Layout name when $common is false.
	 * @return string
	 */
	public static function fileURL(string $relativePath, bool $common = true, string $layout = null): string
	{
		$base = self::assetURL($common, $layout);

		if ($base === '')
		{
			// Worst case, just return the path as-is
			return $relativePath;
		}

		return rtrim($base, '/') . '/' . ltrim($relativePath, '/');
	}
}
