<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Contact]].
 *
 * @see Contact
 */
class ContactQuery extends \common\models\generated\ContactQuery
{
	public function active(): static
	{
		return $this->andWhere(['is_active' => 1]);
	}

	public function public(): static
	{
		return $this->andWhere(['is_public' => 1]);
	}

	public function staff(): static
	{
		return $this->andWhere(['is_staff' => 1]);
	}

	public function ordered(): static
	{
		return $this->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC]);
	}
}
