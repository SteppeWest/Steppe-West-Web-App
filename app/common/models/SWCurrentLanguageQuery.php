<?php
/**
 * SWCurrentLanguageQuery.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use yii\db\ActiveQuery;
/**

 * This is the ActiveQuery class for [[SWCurrentLanguage]].
 *
 * @see SWCurrentLanguage
 */
class SWCurrentLanguageQuery extends ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * {@inheritdoc}
	 * @return SWCurrentLanguage[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return SWCurrentLanguage|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
