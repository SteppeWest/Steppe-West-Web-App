<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SWPage]].
 *
 * @see SWPage
 */
class SWPageQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return SWPage[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return SWPage|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
