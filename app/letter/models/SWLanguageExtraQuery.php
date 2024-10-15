<?php

namespace letter\models;

/**
 * This is the ActiveQuery class for [[SWLanguageExtra]].
 *
 * @see SWLanguageExtra
 */
class SWLanguageExtraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SWLanguageExtra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguageExtra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
