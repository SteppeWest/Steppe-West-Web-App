<?php

namespace common\models\generated;

/**
 * This is the ActiveQuery class for [[FaqTranslation]].
 *
 * @see FaqTranslation
 */
class FaqTranslationQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return FaqTranslation[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return FaqTranslation|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
