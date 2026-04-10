<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id
 * @property string $code
 * @property string $view_key
 * @property int $is_active
 * @property int $is_home
 * @property int|null $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property FaqItem[] $faqItems
 * @property Language[] $languages
 * @property PageRoute[] $pageRoutes
 * @property PageTranslation[] $pageTranslations
 */
class Page extends \common\models\Page
{
	/**
	 * {@inheritdoc}
	 */
	/**
	 */
	public static function tableName()
	{
		return '{{%page}}';
	}

	/**
	 * {@inheritdoc}
	 */
	/**
	public function rules()
	{
		return [
			[['sort_order', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
			[['view_key'], 'default', 'value' => 'static-page'],
			[['is_active'], 'default', 'value' => 1],
			[['is_home'], 'default', 'value' => 0],
			[['code'], 'required'],
			[['is_active', 'is_home', 'sort_order', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
			[['code', 'view_key'], 'string', 'max' => 32],
			[['code'], 'unique'],
		];
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	/**
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'code' => 'Code',
			'view_key' => 'View Key',
			'is_active' => 'Is Active',
			'is_home' => 'Is Home',
			'sort_order' => 'Sort Order',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
		];
	}
	 */

	/**
	 * Gets query for [[FaqItems]].
	 *
	 * @return \yii\db\ActiveQuery|FaqItemQuery
	 */
	/**
	public function getFaqItems()
	{
		return $this->hasMany(FaqItem::class, ['page_id' => 'id']);
	}
	 */

	/**
	 * Gets query for [[Languages]].
	 *
	 * @return \yii\db\ActiveQuery|LanguageQuery
	 */
	/**
	public function getLanguages()
	{
		return $this->hasMany(Language::class, ['id' => 'language_id'])->viaTable('{{%page_translation}}', ['page_id' => 'id']);
	}
	 */

	/**
	 * Gets query for [[PageRoutes]].
	 *
	 * @return \yii\db\ActiveQuery|PageRouteQuery
	 */
	/**
	public function getPageRoutes()
	{
		return $this->hasMany(PageRoute::class, ['page_id' => 'id']);
	}
	 */

	/**
	 * Gets query for [[PageTranslations]].
	 *
	 * @return \yii\db\ActiveQuery|PageTranslationQuery
	 */
	/**
	public function getPageTranslations()
	{
		return $this->hasMany(PageTranslation::class, ['page_id' => 'id']);
	}
	 */

	/**
	 * {@inheritdoc}
	 * @return PageQuery the active query used by this AR class.
	 */
	/**
	public static function find()
	{
		return new PageQuery(get_called_class());
	}
	 */
}
