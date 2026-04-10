<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Language]].
 *
 * @see Language
 */
class LanguageQuery extends \common\models\generated\LanguageQuery
{
	public function active(): static
	{
		return $this->andWhere(['is_active' => 1]);
	}

	public function ordered(): static
	{
		return $this->orderBy(['menu_position' => SORT_ASC, 'id' => SORT_ASC]);
	}

	public function byCode(string $code): static
	{
		return $this->andWhere(['code' => $code]);
	}
}
