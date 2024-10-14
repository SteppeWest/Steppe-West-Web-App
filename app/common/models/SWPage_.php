<?php
/**
 * SWPage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $pk PK
 * @property int $key_pk Key PK
 * @property string $code Code
 * @property string $page Page
 * @property string $title Title
 * @property string|null $subtitle Subtitle
 * @property string|null $body_yaml Body YAML
 *
 * @property Language $keyPk
 */
class SWPage extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%page}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['key_pk', 'code', 'page', 'title'], 'required'],
			[['key_pk'], 'integer'],
			[['code', 'page', 'title', 'subtitle', 'body_yaml'], 'string'],
			[['key_pk'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['key_pk' => 'pk']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => 'PK',
			'key_pk' => 'Key PK',
			'code' => 'Code',
			'page' => 'Page',
			'title' => 'Title',
			'subtitle' => 'Subtitle',
			'body_yaml' => 'Body YAML',
		];
	}

	/**
	 * Gets query for [[KeyPk]].
	 *
	 * @return \yii\db\ActiveQuery|LanguageQuery
	 */
	public function getKeyPk()
	{
		return $this->hasOne(Language::class, ['pk' => 'key_pk']);
	}

	/**
	 * {@inheritdoc}
	 * @return SWPageQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new SWPageQuery(get_called_class());
	}
}
