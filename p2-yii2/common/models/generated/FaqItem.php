<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "{{%faq_item}}".
 *
 * @property int $id
 * @property int $page_id
 * @property string|null $code
 * @property int $is_active
 * @property int $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property FaqTranslation[] $faqTranslations
 * @property Language[] $languages
 * @property Page $page
 */
class FaqItem extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%faq_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['is_active'], 'default', 'value' => 1],
            [['sort_order'], 'default', 'value' => 0],
            [['page_id'], 'required'],
            [['page_id', 'is_active', 'sort_order', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 64],
            [['page_id', 'code'], 'unique', 'targetAttribute' => ['page_id', 'code']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'code' => 'Code',
            'is_active' => 'Is Active',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[FaqTranslations]].
     *
     * @return \yii\db\ActiveQuery|FaqTranslationQuery
     */
    public function getFaqTranslations()
    {
        return $this->hasMany(FaqTranslation::class, ['faq_item_id' => 'id']);
    }

    /**
     * Gets query for [[Languages]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::class, ['id' => 'language_id'])->viaTable('{{%faq_translation}}', ['faq_item_id' => 'id']);
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery|PageQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }

    /**
     * {@inheritdoc}
     * @return FaqItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaqItemQuery(get_called_class());
    }

}
