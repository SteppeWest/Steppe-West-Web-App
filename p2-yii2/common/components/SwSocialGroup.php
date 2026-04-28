<?php
/**
 * SwSocialGroup.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\components;

use yii\bootstrap5\Html;
use common\helpers\SwSocialsFactory;

class SwSocialGroup extends SwSocialShared
{
	/**
	 * @var SwSocialObject[]
	 */
	protected array $items = [];
	protected bool $inline = false;

	public function __construct(array $items = [], int $type = SwSocialsFactory::ICON_ONLY)
	{
		$this->items = $items;
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
		$items = [];

		foreach ($this->items as $item) {
			if (!$item instanceof SwSocialObject) {
				continue;
			}

			$items[] = (string) $item;
		}

		$content = $this->renderItems($items);

		return Html::tag(
			$this->inline ? 'span' : 'div',
			$content,
			[
				'class' => [
					'sw-social-group',
					'sw-social-group-type-' . $this->type,
					$this->inline ? 'sw-social-group-inline' : 'sw-social-group-block',
				],
			]
		);
	}

	protected function renderItems(array $items): string
	{
		if ($items === []) {
			return '';
		}

		if ($this->type === SwSocialsFactory::TEXT_ONLY) {
			return '| ' . implode(' | ', $items) . ' |';
		}

		return implode(' ', $items);
	}

	public function inline(bool $inline = true): static
	{
		$this->inline = $inline;

		return $this;
	}

	public function i(bool $inline = true): static
	{
		return $this->inline($inline);
	}

	public function type(int $type = SwSocialsFactory::TEXT_ONLY): static
	{
		if (in_array($type, [
			SwSocialsFactory::ICON_ONLY,
			SwSocialsFactory::TEXT_ONLY,
			SwSocialsFactory::ICON_TEXT,
		], true))
		{
			$this->type = $type;

			foreach ($this->items as $item) {
				if ($item instanceof SwSocialObject) {
					$item->type($type);
				}
			}

			if ($this->type === SwSocialsFactory::ICON_ONLY && $this->size === null) {
				$this->size(1);
			}
			if ($this->type !== SwSocialsFactory::ICON_ONLY && $this->size === 1) {
				$this->clearSize();
			}
		}

		return $this;
	}

	public function t(int $type = SwSocialsFactory::TEXT_ONLY): static
	{
		return $this->type($type);
	}

	public function size(?int $size): static
	{
		if ($size !== null && $size >= 1 && $size <= 6) {
			$this->size = $size;
		}
		elseif ($this->type === SwSocialsFactory::ICON_ONLY) {
			$this->size = 1;
		}
		else {
			$this->size = null;
		}

		return $this;
	}

	public function s(?int $size): static
	{
		return $this->size($size);
	}

	/**
	public function multiply(int $x = 1): static
	{
	}

	public function x(int $x = 1): static
	{
	}
	 */
}
