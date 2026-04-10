<?php

namespace common\models\generated;

/**
 * This is the ActiveQuery class for [[PageRoute]].
 *
 * @see PageRoute
 */
class PageRouteQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return PageRoute[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return PageRoute|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
