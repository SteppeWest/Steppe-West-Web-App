<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%page_route}}".
 *
 * @property int $id
 * @property int $page_id
 * @property string $slug
 * @property int $is_primary
 * @property int $is_active
 *
 * @property Page $page
 */
class PageRoute extends \common\models\PageRoute
{
	/**
	 * {@inheritdoc}
	 */
	/**
	public static function tableName()
	{
		return '{{%page_route}}';
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	/**
	public function rules()
	{
		return [
			[['is_active'], 'default', 'value' => 1],
			[['page_id', 'slug'], 'required'],
			[['page_id', 'is_primary', 'is_active'], 'integer'],
			[['slug'], 'string', 'max' => 64],
			[['slug'], 'unique'],
			[['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['page_id' => 'id']],
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
			'page_id' => 'Page ID',
			'slug' => 'Slug',
			'is_primary' => 'Is Primary',
			'is_active' => 'Is Active',
		];
	}
	 */

	/**
	 * Gets query for [[Page]].
	 *
	 * @return \yii\db\ActiveQuery|PageQuery
	 */
	/**
	public function getPage()
	{
		return $this->hasOne(Page::class, ['id' => 'page_id']);
	}
	 */

	/**
	 * {@inheritdoc}
	 * @return PageRouteQuery the active query used by this AR class.
	 */
	/**
	public static function find()
	{
		return new PageRouteQuery(get_called_class());
	}
	 */
}
