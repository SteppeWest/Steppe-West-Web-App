<?php

namespace language\models;

use Yii;

/**
 * This is the model class for table "{{%language_page}}".
 *
 * @property int $page_pk Page PK
 * @property string $page_code Language Code
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
 * @property LanguageBase $pageCode
 * @property LanguageExtra $pageCode0
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
            [['page_code', 'page_tag', 'title'], 'required'],
            [['title', 'subtitle', 'description', 'keywords', 'lead', 'origin', 'origin_link', 'body_yaml'], 'string'],
            [['page_code'], 'string', 'max' => 4],
            [['page_tag'], 'string', 'max' => 12],
            [['page_code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBase::class, 'targetAttribute' => ['page_code' => 'base_code']],
            [['page_code'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageExtra::class, 'targetAttribute' => ['page_code' => 'extra_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'page_pk' => 'Page PK',
            'page_code' => 'Language Code',
            'page_tag' => 'Page Slug',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'lead' => 'Page Lead',
            'origin' => 'Substack Origin',
            'origin_link' => 'Origin Link',
            'body_yaml' => 'Body YAML',
        ];
    }

    /**
     * Gets query for [[PageCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPageCode()
    {
        return $this->hasOne(LanguageBase::class, ['base_code' => 'page_code']);
    }

    /**
     * Gets query for [[PageCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPageCode0()
    {
        return $this->hasOne(LanguageExtra::class, ['extra_code' => 'page_code']);
    }
}
