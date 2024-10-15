<?php

namespace letter\models;

/**
 * This is the ActiveQuery class for [[SWCurrentLanguage]].
 *
 * @see SWCurrentLanguage
 */
class SWCurrentLanguageQuery extends \yii\db\ActiveQuery
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
