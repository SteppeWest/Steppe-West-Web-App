<?php
/**
 * SWLanguageCode.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace letter\models;

use Yii;
use yii\db\ActiveRecord;
use letter\languages\SWFlagSelector;
use letter\languages\SWLanguageSelector;

/**
 * This is the model class for table "{{%language_code}}".
 *
 * @property int $pk PK
 * @property string $code Code
 * @property string|null $prev
 * @property int|null $position Position
 * @property string $name Name
 * @property string $native Native Name
 * @property string $flag Flag Icon
 * @property string $label UI Label
 *
 * @property LanguageExtra $languageExtra
 * @property LanguagePage[] $languagePages
 */
class SWLanguageCode extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%language_code}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['code', 'name', 'native', 'flag', 'label'], 'required'],
			[['position'], 'integer'],
			[['code', 'name', 'native', 'flag', 'label'], 'string'],
			[['code', 'prev'], 'max' => 4],
			[['name', 'native'], 'max' => 32],
			[['flag'], 'max' => 6],
			[['label'], 'max' => 8],
			[['code', 'name', 'native', 'flag', 'label'], 'unique'],
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
			'prev' => 'Prev',
			'position' => 'Position',
			'name' => 'Name',
			'native' => 'Native Name',
			'flag' => 'Flag Icon',
			'label' => 'UI Label',
		];
	}

	/**
	 * Gets query for [[LanguageExtra]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getLanguageExtra()
	{
		return $this->hasOne(LanguageExtra::class, ['code' => 'code']);
	}

	/**
	 * Gets query for [[LanguagePages]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getLanguagePages()
	{
		return $this->hasMany(LanguagePage::class, ['code' => 'code']);
	}

	public static function getCurrentLanguage()
	{
		$languageCode = SWLanguageSelector::getCurrentLanguage();
		return self::findOne(['code' => $languageCode]);
	}

	public function getFlag()
	{
		return SWFlagSelector::getFlag($this->getAttribute('flag'));
	}

	public function __get($name)
	{
		if ($name === 'flag') {
			return $this->getFlag();
		}
		return parent::__get($name);
	}
}
