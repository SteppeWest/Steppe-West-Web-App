<?php
/**
 * SWLanguage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property int $pk PK
 * @property int|null $position Position
 * @property string $code Code
 * @property string $name Name
 * @property string $native Native Name
 * @property string $locale Locale
 * @property string $lang Lang
 * @property string $flag Flag Icon
 * @property string $label UI Label
 * @property string|null $description Description
 * @property string|null $keywords Keywords
 * @property string|null $origin Origin
 * @property string|null $footer_yaml Footer YAML
 *
 * @property Page[] $pages
 */
class SWLanguage extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%language}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['code', 'name', 'native', 'locale', 'lang', 'flag', 'label'], 'required'],
			[['code', 'name', 'native', 'locale', 'lang', 'flag', 'label', 'description', 'keywords', 'origin', 'footer_yaml'], 'string'],
			[['code', 'flag'], 'max' => 3],
			[['name', 'native', 'locale', 'lang', 'label'], 'max' => 32],
			[['code', 'position'], 'unique'],
			[['position'], 'integer'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => 'PK',
			'position' => 'Position',
			'code' => 'Code',
			'name' => 'Name',
			'native' => 'Native Name',
			'locale' => 'Locale',
			'lang' => 'Lang',
			'flag' => 'Flag Icon',
			'label' => 'UI Label',
			'description' => 'Description',
			'keywords' => 'Keywords',
			'origin' => 'Origin',
			'footer_yaml' => 'Footer YAML',
		];
	}

	/**
	 * Gets query for [[Pages]].
	 *
	 * @return \yii\db\ActiveQuery|PageQuery
	 */
	public function getPages()
	{
		return $this->hasMany(Page::class, ['key_pk' => 'pk']);
	}

	/**
	 * {@inheritdoc}
	 * @return SWLanguageQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new SWLanguageQuery(get_called_class());
	}
}
