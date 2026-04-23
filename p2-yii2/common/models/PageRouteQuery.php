<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PageRoute]].
 *
 * @see PageRoute
 */
class PageRouteQuery extends \common\models\generated\PageRouteQuery
{
	public function active(): static
	{
		return $this->andWhere(['is_active' => 1]);
	}

	public function primary(): static
	{
		return $this->andWhere(['is_primary' => 1]);
	}

	public function bySlug(string $slug): static
	{
		return $this->andWhere(['slug' => $slug]);
	}
}
