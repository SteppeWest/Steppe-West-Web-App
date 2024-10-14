<?php
/**
 * SWLanguageQuery.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

/**
 * This is the ActiveQuery class for [[SWLanguage]].
 *
 * @see SWLanguage
 */
class SWLanguageQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return SWLanguage[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return SWLanguage|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
