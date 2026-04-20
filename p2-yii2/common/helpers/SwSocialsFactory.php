<?php
/**
 * SwSocialsFactory.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Load this factory with...
 * use common\helpers\SwSocialsFactory;
 */

/**
 * Uses app params items...
 * 'swSocials' - a list of the active social media accounts
 * 'swSocialsData' - data for all Steppe West social media accounts as...
 *        'name'  => [
 *            'label' => 'label',
 *            'url'   => 'url',
 *            'icon'  => 'icon',
 *        ],
 */

namespace common\helpers;

use Yii;
use yii\base\InvalidConfigException;
use common\components\SwSocialObject;
use common\components\SwSocialGroup;

abstract class SwSocialsFactory extends SwFactory
{
	public const ICON_ONLY = 0;
	public const TEXT_ONLY = 1;
	public const ICON_TEXT = 2;

	public static function socialObject(string $name, int $type = self::ICON_ONLY): SwSocialObject
	{
		$active = static::activeSocialNames();

		if (!in_array($name, $active, true)) {
			throw new InvalidConfigException("Inactive or unknown social account: {$name}");
		}

		$data = static::socialConfig($name);

		if (
			$data === []
			|| !isset($data['label'], $data['url'], $data['icon'])
		) {
			throw new InvalidConfigException("Missing social data for: {$name}");
		}

		$type = static::socialTypeCheck($type);

		return new SwSocialObject(
			$name,
			$data['label'],
			$data['url'],
			$data['icon'],
			$type
		);
	}

	public static function o(string $name, int $type = self::ICON_ONLY): SwSocialObject
	{
		return static::socialObject($name, $type);
	}

	public static function socialBar(int $type = self::ICON_ONLY): SwSocialGroup
	{
		$type = static::socialTypeCheck($type);

		$items = [];

		foreach (static::activeSocialNames() as $name) {
			$items[] = static::socialObject($name, $type);
		}

		return new SwSocialGroup($items, $type);
	}

	public static function b(int $type = self::ICON_ONLY): SwSocialGroup
	{
		return static::socialBar($type);
	}

	protected static function activeSocialNames(): array
	{
		return Yii::$app->params['swSocials'] ?? [];
	}

	protected static function activeSocialAccounts(): array
	{
		$all = Yii::$app->params['swSocialsData'] ?? [];
		$items = [];

		foreach (static::activeSocialNames() as $name) {
			if (isset($all[$name])) {
				$items[$name] = $all[$name];
			}
		}

		return $items;
	}

	protected static function socialConfig(string $name): array
	{
		return Yii::$app->params['swSocialsData'][$name] ?? [];
	}

	protected static function socialTypeCheck(int $type): int
	{
		if (in_array($type, [self::ICON_ONLY, self::TEXT_ONLY, self::ICON_TEXT], true)) {
			return $type;
		}

		return self::ICON_ONLY;
	}
}
