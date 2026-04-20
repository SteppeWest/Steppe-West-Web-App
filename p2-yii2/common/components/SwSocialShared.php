<?php
/**
 * SwSocialShared.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\components;

use yii\bootstrap5\Html;
use common\helpers\SwSocialsFactory;

class SwSocialShared
{
	/**
	 * SwSocialsFactory::ICON_ONLY = 0 - icon only
	 * SwSocialsFactory::TEXT_ONLY = 1 - text only
	 * SwSocialsFactory::ICON_TEXT = 2 - icon + text
	 */
	protected int $type = SwSocialsFactory::ICON_ONLY;
	protected ?int $size = null;

	public function clearSize(): static
	{
		$this->size = null;

		return $this;
	}

}
