<?php

namespace common\models\generated;

/**
 * This is the ActiveQuery class for [[FaqItem]].
 *
 * @see FaqItem
 */
class FaqItemQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return FaqItem[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return FaqItem|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
