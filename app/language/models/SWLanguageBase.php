<?php

namespace language\models;

use Yii;

/**
 * This is the model class for table "{{%language_base}}".
 *
 * @property int $base_pk Base PK
 * @property string $base_code Language Code
 * @property string|null $prev_code Previous Code
 * @property int|null $position Position
 * @property string $name Name
 * @property string $native Native Name
 * @property string $flag_icon Flag Icon
 * @property string $ui_label UI Label
 *
 * @property LanguageExtra $languageExtra
 * @property LanguagePage[] $languagePages
 */
class SWLanguageBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_base}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base_code', 'name', 'native', 'flag_icon', 'ui_label'], 'required'],
            [['position'], 'integer'],
            [['base_code', 'prev_code', 'flag_icon'], 'string', 'max' => 4],
            [['name', 'native'], 'string', 'max' => 32],
            [['ui_label'], 'string', 'max' => 8],
            [['base_code'], 'unique'],
            [['name'], 'unique'],
            [['native'], 'unique'],
            [['flag_icon'], 'unique'],
            [['ui_label'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'base_pk' => 'Base PK',
            'base_code' => 'Language Code',
            'prev_code' => 'Previous Code',
            'position' => 'Position',
            'name' => 'Name',
            'native' => 'Native Name',
            'flag_icon' => 'Flag Icon',
            'ui_label' => 'UI Label',
        ];
    }

    /**
     * Gets query for [[LanguageExtra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageExtra()
    {
        return $this->hasOne(LanguageExtra::class, ['extra_code' => 'base_code']);
    }

    /**
     * Gets query for [[LanguagePages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagePages()
    {
        return $this->hasMany(LanguagePage::class, ['page_code' => 'base_code']);
    }
}
