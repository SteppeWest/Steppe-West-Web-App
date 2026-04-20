<?php
/**
 * SwSocialObject.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\components;

use yii\bootstrap5\Html;
use p2m\helpers\BI;
use common\helpers\SwSocialsFactory;

class SwSocialObject extends SwSocialShared
{
	protected string $name;
	protected string $label;
	protected string $url;
	protected string $icon;

	public function __construct(string $name, string $label, string $url, string $icon, int $type = SwSocialsFactory::ICON_ONLY)
	{
		$this->name = $name;
		$this->label = $label;
		$this->url = $url;
		$this->icon = $icon;
		$this->type($type);

		if ($type === SwSocialsFactory::ICON_ONLY) {
			$this->size(1);
		}
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		$parts = [];

		if (
			$this->type === SwSocialsFactory::ICON_ONLY
			|| $this->type === SwSocialsFactory::ICON_TEXT
		)
		{
			$icon = BI::i($this->icon);

			if ($this->size !== null) {
				$icon->size($this->size);
			}

			$parts[] = (string) $icon;
		}

		if (
			$this->type === SwSocialsFactory::TEXT_ONLY
			|| $this->type === SwSocialsFactory::ICON_TEXT
		)
		{
			$parts[] = Html::tag('span', Html::encode($this->label), [
				'class' => 'sw-social-label',
			]);
		}

		return Html::a(
			implode(' ', $parts),
			$this->url,
			[
				'class' => [
					'sw-social',
					'sw-social-' . $this->name,
					'sw-social-type-' . $this->type,
				],
				'target' => '_blank',
				'rel' => 'noopener noreferrer',
				'aria-label' => $this->label,
			]
		);
	}

	/**
	 * @param bool $text = true
	 * @return \common\components\SwSocialObject
	 * @throws \yii\base\InvalidConfigException
	 */
	public function type(int $type = SwSocialsFactory::TEXT_ONLY): static
	{
		if (in_array($type, [
			SwSocialsFactory::ICON_ONLY,
			SwSocialsFactory::TEXT_ONLY,
			SwSocialsFactory::ICON_TEXT,
		], true))
		{
			$this->type = $type;

			if ($this->type === SwSocialsFactory::ICON_ONLY && $this->size === null) {
				$this->size(1);
			}
			if ($this->type !== SwSocialsFactory::ICON_ONLY && $this->size === 1) {
				$this->clearSize();
			}
		}

		return $this;
	}

	/**
	 * Shortcut for `type()`
	 * @see type()
	 */
	public function t(int $type = SwSocialsFactory::TEXT_ONLY): static
	{
		return $this->type($type);
	}

	/**
	 * @param integer $value range 1 to 6
	 * @return \common\components\SwSocialObject
	 * @throws \yii\base\InvalidConfigException
	 */
	public function size(int $size): static
	{
		if ($size >= 1 && $size <= 6) {
			$this->size = $size;
		}
		else {
			$this->size = null;
		}

		return $this;
	}

	/**
	 * Shortcut for `size()`
	 * @see size()
	 */
	public function s(int $size): static
	{
		return $this->size($size);
	}
}
