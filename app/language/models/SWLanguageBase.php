<?php

namespace language\models;

use Yii;

/**
 * This is the model class for table "{{%language_base}}".
 *
 * @property int $pk_base Base PK
 * @property string $lang_code Language Code
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
            [['lang_code', 'name', 'native', 'flag_icon', 'ui_label'], 'required'],
            [['position'], 'integer'],
            [['lang_code', 'prev_code', 'flag_icon'], 'string', 'max' => 4],
            [['name', 'native'], 'string', 'max' => 32],
            [['ui_label'], 'string', 'max' => 8],
            [['lang_code'], 'unique'],
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
            'pk_base' => 'Pk Base',
            'lang_code' => 'Lang Code',
            'prev_code' => 'Prev Code',
            'position' => 'Position',
            'name' => 'Name',
            'native' => 'Native',
            'flag_icon' => 'Flag Icon',
            'ui_label' => 'Ui Label',
        ];
    }

    /**
     * Gets query for [[LanguageExtra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageExtra()
    {
        return $this->hasOne(LanguageExtra::class, ['lang_code' => 'lang_code']);
    }

    /**
     * Gets query for [[LanguagePages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagePages()
    {
        return $this->hasMany(LanguagePage::class, ['lang_code' => 'lang_code']);
    }
}
