<?php

namespace letter\models;

use Yii;

/**
 * This is the model class for table "{{%language_page}}".
 *
 * @property int $pk PK
 * @property string $code Code
 * @property string $page Page
 * @property string $title Title
 * @property string|null $subtitle Subtitle
 * @property string|null $description Description
 * @property string|null $keywords Keywords
 * @property string|null $lead Lead
 * @property string|null $origin Substack Origin
 * @property string|null $origin_link Origin Link
 * @property string|null $body_yaml Body YAML
 *
 * @property LanguageCode $code0
 */
class SWLanguagePage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'page', 'title'], 'required'],
            [['title', 'subtitle', 'description', 'keywords', 'lead', 'origin', 'origin_link', 'body_yaml'], 'string'],
            [['code'], 'string', 'max' => 4],
            [['page'], 'string', 'max' => 12],
            [['code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageCode::class, 'targetAttribute' => ['code' => 'code']],
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
            'page' => 'Page',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'lead' => 'Lead',
            'origin' => 'Substack Origin',
            'origin_link' => 'Origin Link',
            'body_yaml' => 'Body YAML',
        ];
    }

    /**
     * Gets query for [[Code0]].
     *
     * @return \yii\db\ActiveQuery|LanguageCodeQuery
     */
    public function getCode0()
    {
        return $this->hasOne(LanguageCode::class, ['code' => 'code']);
    }

    /**
     * {@inheritdoc}
     * @return SWLanguagePageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SWLanguagePageQuery(get_called_class());
    }
}
