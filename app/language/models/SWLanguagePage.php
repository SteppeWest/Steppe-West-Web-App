<?php

namespace language\models;

use Yii;

/**
 * This is the model class for table "{{%language_page}}".
 *
 * @property int $pk_page Page PK
 * @property string $lang_code Language Code
 * @property string $page_tag Page Slug
 * @property string $title Title
 * @property string|null $subtitle Subtitle
 * @property string|null $description Description
 * @property string|null $keywords Keywords
 * @property string|null $lead Page Lead
 * @property string|null $origin Substack Origin
 * @property string|null $origin_link Origin Link
 * @property string|null $body_yaml Body YAML
 *
 * @property LanguageBase $langCode
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
            [['lang_code', 'page_tag', 'title'], 'required'],
            [['title', 'subtitle', 'description', 'keywords', 'lead', 'origin', 'origin_link', 'body_yaml'], 'string'],
            [['lang_code'], 'string', 'max' => 4],
            [['page_tag'], 'string', 'max' => 12],
            [['lang_code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBase::class, 'targetAttribute' => ['lang_code' => 'lang_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_page' => 'Pk Page',
            'lang_code' => 'Lang Code',
            'page_tag' => 'Page Tag',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'lead' => 'Lead',
            'origin' => 'Origin',
            'origin_link' => 'Origin Link',
            'body_yaml' => 'Body Yaml',
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
