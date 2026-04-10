<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "{{%page_translation}}".
 *
 * @property int $id
 * @property int $page_id
 * @property int $language_id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $origin_label
 * @property string|null $origin_url
 * @property string|null $body_content
 * @property string $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Language $language
 * @property Page $page
 */
class PageTranslation extends \yii\db\ActiveRecord
{


	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%page_translation}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['subtitle', 'meta_description', 'meta_keywords', 'origin_label', 'origin_url', 'body_content', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
			[['status'], 'default', 'value' => 'published'],
			[['page_id', 'language_id', 'title'], 'required'],
			[['page_id', 'language_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
			[['meta_description', 'meta_keywords', 'body_content'], 'string'],
			[['title', 'subtitle', 'origin_label'], 'string', 'max' => 255],
			[['origin_url'], 'string', 'max' => 2048],
			[['status'], 'string', 'max' => 16],
			[['page_id', 'language_id'], 'unique', 'targetAttribute' => ['page_id', 'language_id']],
			[['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language_id' => 'id']],
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
			'language_id' => 'Language ID',
			'title' => 'Title',
			'subtitle' => 'Subtitle',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'origin_label' => 'Origin Label',
			'origin_url' => 'Origin Url',
			'body_content' => 'Body Content',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
		];
	}

	/**
	 * Gets query for [[Language]].
	 *
	 * @return \yii\db\ActiveQuery|LanguageQuery
	 */
	public function getLanguage()
	{
		return $this->hasOne(Language::class, ['id' => 'language_id']);
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
	 * @return PageTranslationQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new PageTranslationQuery(get_called_class());
	}

}
