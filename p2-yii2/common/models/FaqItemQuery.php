<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FaqItem]].
 *
 * @see FaqItem
 */
class FaqItemQuery extends \common\models\generated\FaqItemQuery
{
	public function active(): static
	{
		return $this->andWhere(['is_active' => 1]);
	}

	public function ordered(): static
	{
		return $this->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC]);
	}
}
