<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Page]].
 *
 * @see Page
 */
class PageQuery extends \common\models\generated\PageQuery
{
	public function active(): static
	{
		return $this->andWhere(['is_active' => 1]);
	}

	public function home(): static
	{
		return $this->andWhere(['is_home' => 1]);
	}

	public function byCode(string $code): static
	{
		return $this->andWhere(['code' => $code]);
	}
}
