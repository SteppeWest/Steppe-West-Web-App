<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SWLanguageBase]].
 *
 * @see SWLanguageBase
 */
class LanguageCodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SWLanguageBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguageBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
