<?php
/**
 * SWLanguagePage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace language\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%language_page}}".
 *
 * @property int $page_pk Page PK
 * @property string $page_lang Language Code
 * @property string $page_slug Page Slug
 * @property string $title Page Title
 * @property string|null $subtitle Subtitle
 * @property string|null $description Description
 * @property string|null $keywords Keywords
 * @property string|null $lead Page Lead
 * @property string|null $origin Substack Origin
 * @property string|null $origin_link Origin Link
 * @property string|null $body_yaml Body YAML
 *
 * @property LanguageBase $pageLang
 */
class SWLanguagePage extends ActiveRecord
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
			[['page_lang', 'page_slug', 'title'], 'required'],
			[['title', 'subtitle', 'description', 'keywords', 'lead', 'origin', 'origin_link', 'body_yaml'], 'string'],
			[['page_lang'], 'string', 'max' => 4],
			[['page_slug'], 'string', 'max' => 12],
			[['page_lang'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBase::class, 'targetAttribute' => ['page_lang' => 'lang_code']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'page_pk' => 'Page PK',
			'page_lang' => 'Language Code',
			'page_slug' => 'Page Slug',
			'title' => 'Page Title',
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
	 * Gets query for [[PageLang]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getPageLang()
	{
		return $this->hasOne(LanguageBase::class, ['lang_code' => 'page_lang']);
	}
}
