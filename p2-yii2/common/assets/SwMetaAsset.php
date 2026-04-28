<?php
/**
 * @common/assets/SwMetaAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SwMetaAsset
 *
 * Load this asset with...
 *
 * common\assets\SwMetaAsset::register($this);
 *
 * use common\assets\SwMetaAsset;
 * SwMetaAsset::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwMetaAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;
use common\assets\SwCommonAsset;

class SwMetaAsset extends AssetBundle
{
	private const BROWSER_LINKS = [
		[
			'href'  => 'ico/site.webmanifest',
			'rel'   => 'manifest',
		],
		[
			'href'  => 'ico/apple-touch-icon.png',
			'rel'   => 'apple-touch-icon',
			'sizes' => '180x180',
		],
		[
			'href'  => 'ico/favicon-16x16.png',
			'rel'   => 'icon',
			'type'  => 'image/png',
			'sizes' => '16x16',
		],
		[
			'href'  => 'ico/favicon-32x32.png',
			'rel'   => 'icon',
			'type'  => 'image/png',
			'sizes' => '32x32',
		],
		[
			'href'  => 'ico/favicon.ico',
			'rel'   => 'shortcut icon',
		],
		[
			'href'  => 'ico/safari-pinned-tab.svg',
			'rel'   => 'mask-icon',
			'color' => '#5bbad5',
		],
	];
	private const BROWSER_META = [
		[
			'name'    => 'msapplication-config',
			'content' => 'ico/browserconfig.xml',
		],
		[
			'name'    => 'msapplication-TileColor',
			'content' => '#da532c',
		],
		[
			'name'    => 'theme-color',
			'content' => '#ffffff',
		],
	];
	private const BROWSER_IMAGES = [
		'img/og_image_01-1200x0630.jpeg',
		'img/og_image_02-1200x0630.jpeg',
	];

	// @var string
	public $sourcePath = '@common/assets/lib/meta';

	// @var array
	public $depends = [
		SwCommonAsset::class,
	];

	/**
	 * Custom functions
	 */

	/**
	 * Returns resolved link-tag definitions for browser/app icons and manifest.
	 */
	public function browserLinks(): array
	{
		$links = [];

		// prepend baseUrl to the href of each item
		foreach (self::BROWSER_LINKS as $link) {
			$link['href'] = $this->baseUrl . '/' . $link['href'];
			$links[] = $link;
		}

		return $links;
	}

	/**
	 * Returns resolved msapplication data.
	 */
	public function browserMeta(): array
	{
		$newMeta = [];
		// prepend baseUrl to browserconfig
		foreach (self::BROWSER_META as $metaItem) {
			if ($metaItem['name'] === 'msapplication-config') {
				$metaItem['content'] = $this->baseUrl . '/' . $metaItem['content'];
			}
			$newMeta[] = $metaItem;
		}

		return $newMeta;
	}

	/**
	 * Returns resolved inage URLs.
	 */
	public function browserImages(): array
	{
		$images = [];

		// prepend baseUrl to each item
		foreach (self::BROWSER_IMAGES as $image) {
			$images[] = $this->baseUrl . '/' . $image;
		}

		return $images;
	}
}
