<?php
/**
 * SWLanguageCode.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\languages\SWLanguageSelector;

/**
 * This is the model class for table "{{%sw_language_codes}}".
 *
 * @property int $pk
 * @property string $code
 * @property int|null $position
 * @property string $name
 * @property string $native
 * @property string $flag
 * @property string $label
 */
class SWLanguageCode extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%sw_language_codes}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['code', 'name', 'native', 'flag', 'label'], 'required'],
			[['code', 'name', 'native', 'flag', 'label'], 'string'],
			[['code', 'flag', 'label'], 'max' => 3],
			[['name', 'native'], 'max' => 32],
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
			'code' => Yii::t('app', 'Code'),
			'position' => Yii::t('app', 'Position'),
			'name' => Yii::t('app', 'Name'),
			'native' => Yii::t('app', 'Native Name'),
			'flag' => Yii::t('app', 'Flag'),
			'label' => Yii::t('app', 'UI Label'),
		];
	}

	public static function getCurrentLanguage()
	{
		$languageCode = SWLanguageSelector::getCurrentLanguage();
		return self::findOne(['code' => $languageCode]);
	}
}
