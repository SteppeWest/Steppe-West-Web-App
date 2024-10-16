<?php

namespace language\models;

use Yii;

/**
 * This is the model class for table "{{%language_extra}}".
 *
 * @property int $pk_extra Extra PK
 * @property string $lang_code Language Code
 * @property string $locale Locale
 * @property string $lang Lang Code
 * @property string|null $footer_yaml Footer YAML
 *
 * @property LanguageBase $langCode
 */
class SWLanguageExtra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_extra}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang_code', 'locale', 'lang'], 'required'],
            [['footer_yaml'], 'string'],
            [['lang_code', 'lang'], 'string', 'max' => 4],
            [['locale'], 'string', 'max' => 12],
            [['lang_code'], 'unique'],
            [['locale'], 'unique'],
            [['lang'], 'unique'],
            [['lang_code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBase::class, 'targetAttribute' => ['lang_code' => 'lang_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_extra' => 'Pk Extra',
            'lang_code' => 'Lang Code',
            'locale' => 'Locale',
            'lang' => 'Lang',
            'footer_yaml' => 'Footer Yaml',
        ];
    }

    /**
     * Gets query for [[LangCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(LanguageBase::class, ['lang_code' => 'lang_code']);
    }
}
