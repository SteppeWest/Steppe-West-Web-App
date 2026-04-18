<?php
/**
 * @frontend/helpers/SwBanner.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\helpers;

use p2m\api\P2AssetFactory;
use p2m\api\P2Image;
use frontend\assets\SwBannerAsset;

final class SwBanner extends P2AssetFactory
{
	protected static string $cssPrefix   = 'sw-banner';
	protected static string $sizePrefix  = 'sw-size';
	protected static ?int   $defaultSize = 4;

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
				1 => ['width' => 3000, 'height' => 480],
				2 => ['width' => 2500, 'height' => 400],
				3 => ['width' => 2000, 'height' => 320],
				4 => ['width' => 1250, 'height' => 200],
				5 => ['width' => 600,  'height' => 96],
				6 => ['width' => 160,  'height' => 26],
			],
		],
		2 => [
			'name'  => 'banner-2',
			'alt'   => 'Steppe West flags banner',
			'sizes' => [
				1 => ['width' => 3000, 'height' => 960],
				2 => ['width' => 2500, 'height' => 800],
				3 => ['width' => 2000, 'height' => 640],
				4 => ['width' => 1250, 'height' => 400],
				5 => ['width' => 600,  'height' => 192],
				6 => ['width' => 160,  'height' => 51],
			],
		],
		3 => [
			'name'  => 'eagle-square-1',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 3000, 'height' => 3000],
				2 => ['width' => 2500, 'height' => 2500],
				3 => ['width' => 2000, 'height' => 2000],
				4 => ['width' => 1250, 'height' => 1250],
				5 => ['width' => 600,  'height' => 600],
				6 => ['width' => 160,  'height' => 160],
			],
		],
		4 => [
			'name'  => 'eagle-square-2',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 3000, 'height' => 3000],
				2 => ['width' => 2500, 'height' => 2500],
				3 => ['width' => 2000, 'height' => 2000],
				4 => ['width' => 1250, 'height' => 1250],
				5 => ['width' => 600,  'height' => 600],
				6 => ['width' => 160,  'height' => 160],
			],
		],
		5 => [
			'name'  => 'eagle-wide-1',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 3000, 'height' => 1800],
				2 => ['width' => 2500, 'height' => 1500],
				3 => ['width' => 2000, 'height' => 1200],
				4 => ['width' => 1250, 'height' => 750],
				5 => ['width' => 600,  'height' => 360],
				6 => ['width' => 160,  'height' => 96],
			],
		],
		6 => [
			'name'  => 'eagle-wide-2',
			'alt'   => 'Steppe West flags banner with eagle',
			'sizes' => [
				1 => ['width' => 3000, 'height' => 1800],
				2 => ['width' => 2500, 'height' => 1500],
				3 => ['width' => 2000, 'height' => 1200],
				4 => ['width' => 1250, 'height' => 750],
				5 => ['width' => 600,  'height' => 360],
				6 => ['width' => 160,  'height' => 96],
			],
		],
	];

	protected static function assetClass(): string
	{
		return SwBannerAsset::class;
	}

	protected static function imagePath(string $name, array $options = []): string
	{
		$size = $options['size'] ?? static::$defaultSize ?? 4;
		$size = static::sizeCheck((int) $size);

		$format = $options['format'] ?? 'svg';

		if ($size < 3) {
			$format = 'svg';
		}

		$widthMap = [
			3 => '2000',
			4 => '1250',
			5 => '0600',
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
		return static::svg(1, 4, $options);
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

		$size = static::sizeCheck($size ?? static::$defaultSize ?? 4);

		$config = static::$banners[$version];
		$sizeData = $config['sizes'][$size] ?? $config['sizes'][4];
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

		return static::$defaultSize ?? 4;
	}
}
