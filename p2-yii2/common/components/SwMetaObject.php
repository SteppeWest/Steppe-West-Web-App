<?php
/**
 * SwMeta.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\components;

class SwMeta
{
	public string $title = '';
	public string $description = '';
	public string $keywords = '';

	public string $assetUrl = '';
	public string $canonicalUrl = '';

	public array $items = [
		[
			'type' => 'meta',
			'http-equiv' => 'X-UA-Compatible',
			'content' => 'IE=edge'
		],
		// Canonical link
		[
			'type' => 'link',
			'rel' => 'canonical',
			'href' => $canonicalUrl
		],
		[
			'type' => 'meta',
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'
		],
		// Meta tags for SEO
		[
			'type' => 'meta',
			'name' => 'description',
			'content' => $description
		],
		[
			'type' => 'meta',
			'name' => 'keywords',
			'content' => $keywords
		],
		[
			'type' => 'meta',
			'name' => 'author',
			'content' => 'Pedro Plowman for Steppe West'
		],
		// Open Graph Meta Tags
		[
			'type' => 'meta',
			'property' => 'og:type',
			'content' => 'article'
		],
		[
			'type' => 'meta',
			'property' => 'og:url',
			'content' => $canonicalUrl
		],
		[
			'type' => 'meta',
			'property' => 'og:title',
			'content' => $title
		],
		[
			'type' => 'meta',
			'property' => 'og:description',
			'content' => $description
		],
		[
			'type' => 'meta',
			'property' => 'og:image',
			'content' => $metaAssetUrl . '/img/og_image_01-1200x0630.jpeg'
		],
		[
			'type' => 'meta',
			'property' => 'og:image',
			'content' => $metaAssetUrl . '/img/og_image_02-1200x0630.jpeg'
		],
		[
			'type' => 'meta',
			'property' => 'og:updated_time',
			'content' => '2024-07-08'
		],
		[
			'type' => 'meta',
			'property' => 'og:locale',
			'content' => $locale
		],
		// Twitter
		[
			'type' => 'meta',
			'property' => 'twitter:card',
			'content' => 'summary_large_image'
		],
		[
			'type' => 'meta',
			'property' => 'twitter:url',
			'content' => $canonicalUrl
		],
		[
			'type' => 'meta',
			'property' => 'twitter:title',
			'content' => $title
		],
		[
			'type' => 'meta',
			'property' => 'twitter:description',
			'content' => $description
		],
		[
			'type' => 'meta',
			'property' => 'twitter:image',
			'content' => $metaAssetUrl . '/img/og_image_01-1200x0630.jpeg'
		],
		[
			'type' => 'meta',
			'property' => 'twitter:image',
			'content' => $metaAssetUrl . '/img/og_image_02-1200x0630.jpeg'
		],
		// Favicon
		[
			'type' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '180x180',
			'href' => $metaAssetUrl . '/ico/apple-touch-icon.png'
		],
		[
			'type' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'sizes' => '32x32',
			'href' => $metaAssetUrl . '/ico/favicon-32x32.png'
		],
		[
			'type' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'sizes' => '16x16',
			'href' => $metaAssetUrl . '/ico/favicon-16x16.png'
		],
		[
			'type' => 'link',
			'rel' => 'manifest',
			'href' => $metaAssetUrl . '/ico/site.webmanifest'
		],
		[
			'type' => 'link',
			'rel' => 'mask-icon',
			'color' => '#5bbad5',
			'href' => $metaAssetUrl . '/ico/safari-pinned-tab.svg',
		],
		[
			'type' => 'link',
			'rel' => 'shortcut icon',
			'href' => $metaAssetUrl . '/ico/favicon.ico',
		],
		[
			'type' => 'meta',
			'name' => 'msapplication-TileColor',
			'content' => '#da532c',
		],
		[
			'type' => 'meta',
			'name' => 'msapplication-config',
			'content' => $metaAssetUrl . '/ico/browserconfig.xml',
		],
		[
			'type' => 'meta',
			'name' => 'theme-color',
			'content' => '#ffffff',
		],
	];

}
