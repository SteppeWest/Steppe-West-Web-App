<?php
/**
 * SWLanguageBase.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace language\models;

use Yii;
use yii\db\ActiveRecord;
use language\widgets\SWFlagSelector;
use language\widgets\SWLanguageSelector;

/**
 * This is the model class for table "{{%language_base}}".
 *
 * @property int $lang_pk Language PK
 * @property string $lang_code Language Code
 * @property string|null $prev_code Previous Code
 * @property int|null $menu_position Menu Position
 * @property string $lang_name Language Name
 * @property string $native_name Native Name
 * @property string $flag_icon Flag Icon
 * @property string $ui_label UI Label
 * @property string $locale Locale
 * @property string $html_lang HTML Language
 * @property string|null $footer_yaml Footer YAML
 *
 * @property LanguagePage[] $languagePages
 */
class SWLanguageBase extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%language_base}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['lang_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang'], 'required'],
			[['menu_position'], 'integer'],
			[['lang_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang', 'footer_yaml'], 'string'],
			[['lang_code', 'prev_code', 'flag_icon'], 'max' => 4],
			[['lang_name', 'native_name'], 'max' => 32],
			[['ui_label', 'html_lang'], 'max' => 8],
			[['locale'], 'max' => 12],
			[['lang_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'lang_pk' => 'Language PK',
			'lang_code' => 'Language Code',
			'prev_code' => 'Previous Code',
			'menu_position' => 'Menu Position',
			'lang_name' => 'Language Name',
			'native_name' => 'Native Name',
			'flag_icon' => 'Flag Icon',
			'ui_label' => 'UI Label',
			'locale' => 'Locale',
			'html_lang' => 'HTML Language',
			'footer_yaml' => 'Footer YAML',
		];
	}

	/**
	 * Gets query for [[LanguagePages]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getLanguagePages()
	{
		return $this->hasMany(LanguagePage::class, ['page_lang' => 'lang_code']);
	}

	public static function getCurrentLanguage()
	{
		$languageCode = SWLanguageSelector::getCurrentLanguage();
		return self::findOne(['lang_code' => $languageCode]);
	}

	public function getFlag()
	{
		return SWFlagSelector::getFlag($this->getAttribute('flag_icon'));
	}

	public function __get($name)
	{
		if ($name === 'flag_icon') {
			return $this->getFlag();
		}
		return parent::__get($name);
	}
}
