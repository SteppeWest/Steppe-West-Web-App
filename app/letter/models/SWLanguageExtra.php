<?php

namespace letter\models;

use Yii;

/**
 * This is the model class for table "{{%language_extra}}".
 *
 * @property int $pk PK
 * @property string $code Code
 * @property string $locale Locale
 * @property string $lang Lang Code
 * @property string|null $footer_yaml Footer YAML
 *
 * @property LanguageCode $code0
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
            [['code', 'locale', 'lang'], 'required'],
            [['footer_yaml'], 'string'],
            [['code'], 'string', 'max' => 2],
            [['locale'], 'string', 'max' => 12],
            [['lang'], 'string', 'max' => 4],
            [['code'], 'unique'],
            [['locale'], 'unique'],
            [['lang'], 'unique'],
            [['code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageCode::class, 'targetAttribute' => ['code' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'code' => 'Code',
            'locale' => 'Locale',
            'lang' => 'Lang',
            'footer_yaml' => 'Footer Yaml',
        ];
    }

    /**
     * Gets query for [[Code0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCode0()
    {
        return $this->hasOne(LanguageCode::class, ['code' => 'code']);
    }
}
