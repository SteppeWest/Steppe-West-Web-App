<?php

namespace common\models\generated;

/**
 * This is the ActiveQuery class for [[ContactTranslation]].
 *
 * @see ContactTranslation
 */
class ContactTranslationQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return ContactTranslation[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return ContactTranslation|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
