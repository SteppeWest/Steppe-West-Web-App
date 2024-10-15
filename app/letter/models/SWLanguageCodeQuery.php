<?php

namespace letter\models;

/**
 * This is the ActiveQuery class for [[SWLanguageCode]].
 *
 * @see SWLanguageCode
 */
class SWLanguageCodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SWLanguageCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguageCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
