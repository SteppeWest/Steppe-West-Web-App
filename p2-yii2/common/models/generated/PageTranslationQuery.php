<?php

namespace common\models\generated;

/**
 * This is the ActiveQuery class for [[PageTranslation]].
 *
 * @see PageTranslation
 */
class PageTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PageTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PageTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
