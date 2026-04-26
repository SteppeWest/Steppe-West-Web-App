<?php
/**
 * @common/helpers/SwBanner.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Load this factory with...
 * use common\helpers\SwBanner;
 */

namespace common\helpers;

use p2m\api\P2AssetFactory;
use p2m\api\P2Image;
use common\assets\SwBannerAsset;

final class SwBanner extends P2AssetFactory
{
	protected static string $cssPrefix   = 'sw-banner';
	protected static string $sizePrefix  = 'sw-size';
	protected static ?int   $defaultSize = 3;

	/**
	 * 1 - banner-1
	 * 2 - banner-2
	 * 3 - eagle-square-1
	 * 4 - eagle-square-2
	 * 5 - eagle-wide-1
	 * 6 - eagle-wide-2
	 */
	protected static array $banners = [
		1 => [
			'name'  => 'banner-1',
			'alt'   => 'Steppe West flags banner',
			'sizes' => [
				1 => ['width' => 1500, 'height' => 240],
				2 => ['width' => 1000, 'height' => 400],
				3 => ['width' => 750, 'height' => 120],
				4 => ['width' => 500, 'height' => 80],
				5 => ['width' => 300, 'height' => 48],
				6 => ['width' => 160, 'height' => 26],
			],
		],
		2 => [
			'name'  => 'banner-2',
			'alt'   => 'Steppe West flags banner',
			'sizes' => [
				1 => ['width' => 1500, 'height' => 480],
				2 => ['width' => 1000, 'height' => 800],
				3 => ['width' => 750, 'height' => 240],
				4 => ['width' => 500, 'height' => 160],
				5 => ['width' => 300, 'height' => 96],
				6 => ['width' => 160, 'height' => 51],
			],
		],
		3 => [
			'name'  => 'eagle-square-1',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 1500, 'height' => 1500],
				2 => ['width' => 1000, 'height' => 2500],
				3 => ['width' => 750, 'height' => 750],
				4 => ['width' => 500, 'height' => 500],
				5 => ['width' => 300, 'height' => 300],
				6 => ['width' => 160, 'height' => 160],
			],
		],
		4 => [
			'name'  => 'eagle-square-2',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 1500, 'height' => 1500],
				2 => ['width' => 1000, 'height' => 2500],
				3 => ['width' => 750, 'height' => 750],
				4 => ['width' => 500, 'height' => 500],
				5 => ['width' => 300, 'height' => 300],
				6 => ['width' => 160, 'height' => 160],
			],
		],
		5 => [
			'name'  => 'eagle-wide-1',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 1500, 'height' => 900],
				2 => ['width' => 1000, 'height' => 1500],
				3 => ['width' => 750, 'height' => 450],
				4 => ['width' => 500, 'height' => 300],
				5 => ['width' => 300, 'height' => 180],
				6 => ['width' => 160, 'height' => 96],
			],
		],
		6 => [
			'name'  => 'eagle-wide-2',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 1500, 'height' => 900],
				2 => ['width' => 1000, 'height' => 1500],
				3 => ['width' => 750, 'height' => 450],
				4 => ['width' => 500, 'height' => 300],
				5 => ['width' => 300, 'height' => 180],
				6 => ['width' => 160, 'height' => 96],
			],
		],
	];

	protected static function assetClass(): string
	{
		return SwBannerAsset::class;
	}

	protected static function imagePath(string $name, array $options = []): string
	{
		$size = $options['size'] ?? static::$defaultSize ?? 3;
		$size = static::sizeCheck((int) $size);

		$format = $options['format'] ?? 'svg';

		$widthMap = [
			1 => '1500',
			2 => '1000',
			3 => '0750',
			4 => '0500',
			5 => '0300',
			6 => '0160',
		];

		$width = $widthMap[$size] ?? '1250';

		if ($format === 'svg') {
			$width  = 'min';
		}

		return "{$format}/sw-{$name}-{$width}.{$format}";
	}

	public static function banner(array $options = []): P2Image
	{
		return static::svg(1, 3, $options);
	}

	public static function b(array $options = []): P2Image
	{
		return static::banner($options);
	}

	public static function svg(int $version, ?int $size, array $options = []): P2Image
	{
		$options = array_merge(
			['format' => 'svg'],
			$options
		);

		return static::image($version, $size, $options);
	}

	public static function png(int $version, ?int $size, array $options = []): P2Image
	{
		$options = array_merge(
			['format' => 'png'],
			$options
		);

		return static::image($version, $size, $options);
	}

	public static function image(int $version, ?int $size, array $options = []): P2Image
	{
		if (!isset(static::$banners[$version])) {
			$version = 1;
		}

		$size = static::sizeCheck($size ?? static::$defaultSize ?? 3);

		$config = static::$banners[$version];
		$sizeData = $config['sizes'][$size] ?? $config['sizes'][3];
		$name = $config['name'];

		$options = array_merge(
			[
				'alt' => $config['alt'],
				'size' => $size,
			],
			$sizeData,
			$options
		);

		return static::img($name, $options);
	}

	protected static function sizeCheck(int $size): int
	{
		if ($size >= 1 && $size <= 6) {
			return $size;
		}

		return static::$defaultSize ?? 3;
	}
}
