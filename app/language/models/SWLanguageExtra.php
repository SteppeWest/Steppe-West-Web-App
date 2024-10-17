<?php

namespace language\models;

use Yii;

/**
 * This is the model class for table "{{%language_extra}}".
 *
 * @property int $extra_pk Extra PK
 * @property string $extra_code Language Code
 * @property string $locale Locale
 * @property string $lang Lang Code
 * @property string|null $footer_yaml Footer YAML
 *
 * @property LanguageBase $extraCode
 * @property LanguagePage[] $languagePages
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
            [['extra_code', 'locale', 'lang'], 'required'],
            [['footer_yaml'], 'string'],
            [['extra_code', 'lang'], 'string', 'max' => 4],
            [['locale'], 'string', 'max' => 12],
            [['extra_code'], 'unique'],
            [['locale'], 'unique'],
            [['lang'], 'unique'],
            [['extra_code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBase::class, 'targetAttribute' => ['extra_code' => 'base_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'extra_pk' => 'Extra PK',
            'extra_code' => 'Language Code',
            'locale' => 'Locale',
            'lang' => 'Lang Code',
            'footer_yaml' => 'Footer YAML',
        ];
    }

    /**
     * Gets query for [[ExtraCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtraCode()
    {
        return $this->hasOne(LanguageBase::class, ['base_code' => 'extra_code']);
    }

    /**
     * Gets query for [[LanguagePages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagePages()
    {
        return $this->hasMany(LanguagePage::class, ['page_code' => 'extra_code']);
    }
}
