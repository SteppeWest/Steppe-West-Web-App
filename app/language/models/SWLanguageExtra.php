<?php
/**
 * SWLanguageExtra.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace letter\models;

use Yii;
use yii\db\ActiveRecord;

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
class SWLanguageExtra extends ActiveRecord
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
			[['code', 'locale', 'lang', 'footer_yaml'], 'string'],
			[['code'], 'max' => 2],
			[['locale'], 'max' => 12],
			[['lang'], 'max' => 4],
			[['code', 'locale', 'lang'], 'unique'],
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
	public function getLanguageCode()
	{
		return $this->hasOne(LanguageCode::class, ['code' => 'code']);
	}
}
