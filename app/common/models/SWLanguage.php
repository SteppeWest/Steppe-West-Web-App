<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property int $pk PK
 * @property string $code Code
 * @property string|null $prev
 * @property int|null $position Position
 * @property string $name Name
 * @property string $native Native Name
 * @property string $flag Flag Icon
 * @property string $label UI Label
 *
 * @property LanguagePage[] $languagePages
 * @property LanguageShared $languageShared
 */
class SWLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'native', 'flag', 'label'], 'required'],
            [['position'], 'integer'],
            [['code', 'prev'], 'string', 'max' => 4],
            [['name', 'native'], 'string', 'max' => 32],
            [['flag'], 'string', 'max' => 6],
            [['label'], 'string', 'max' => 8],
            [['code'], 'unique'],
            [['name'], 'unique'],
            [['native'], 'unique'],
            [['flag'], 'unique'],
            [['label'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'PK',
            'code' => 'Code',
            'prev' => 'Prev',
            'position' => 'Position',
            'name' => 'Name',
            'native' => 'Native Name',
            'flag' => 'Flag Icon',
            'label' => 'UI Label',
        ];
    }

    /**
     * Gets query for [[LanguagePages]].
     *
     * @return \yii\db\ActiveQuery|LanguagePageQuery
     */
    public function getLanguagePages()
    {
        return $this->hasMany(LanguagePage::class, ['code' => 'code']);
    }

    /**
     * Gets query for [[LanguageShared]].
     *
     * @return \yii\db\ActiveQuery|LanguageSharedQuery
     */
    public function getLanguageShared()
    {
        return $this->hasOne(LanguageShared::class, ['code' => 'code']);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SWLanguageQuery(get_called_class());
    }
}
