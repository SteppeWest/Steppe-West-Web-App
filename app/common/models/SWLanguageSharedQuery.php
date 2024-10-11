<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SWLanguageShared]].
 *
 * @see SWLanguageShared
 */
class SWLanguageSharedQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SWLanguageShared[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguageShared|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
