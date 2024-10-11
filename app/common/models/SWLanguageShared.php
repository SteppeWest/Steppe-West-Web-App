<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%language_shared}}".
 *
 * @property int $pk PK
 * @property string $code Code
 * @property string $locale Locale
 * @property string $lang Lang Code
 * @property string|null $footer_yaml Footer YAML
 *
 * @property Language $code0
 */
class SWLanguageShared extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_shared}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'locale', 'lang'], 'required'],
            [['footer_yaml'], 'string'],
            [['code'], 'string', 'max' => 2],
            [['locale'], 'string', 'max' => 12],
            [['lang'], 'string', 'max' => 4],
            [['code'], 'unique'],
            [['locale'], 'unique'],
            [['lang'], 'unique'],
            [['code'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['code' => 'code']],
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
            'locale' => 'Locale',
            'lang' => 'Lang Code',
            'footer_yaml' => 'Footer YAML',
        ];
    }

    /**
     * Gets query for [[Code0]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getCode0()
    {
        return $this->hasOne(Language::class, ['code' => 'code']);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguageSharedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SWLanguageSharedQuery(get_called_class());
    }
}
