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
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sw_language".
 *
 * @property int $pk Language PK
 * @property string $lang_code Language Code
 * @property string|null $prev_code Previous Code
 * @property int|null $menu_position Menu Position
 * @property int $active Active
 * @property string $lang_name Language Name
 * @property string $native_name Native Name
 * @property string $flag_icon Flag Icon
 * @property string $ui_label UI Label
 * @property string $locale Locale
 * @property string $html_lang HTML Language
 * @property string|null $footer_json Footer JSON
 *
 * @property SwLanguagePage[] $swLanguagePages
 */
class SwLanguage extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'sw_language';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['lang_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang'], 'required'],
			[['menu_position', 'active'], 'integer'],
			[['lang_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang', 'footer_json'], 'string'],
			[['lang_code', 'prev_code', 'flag_icon', 'ui_label'], 'max' => 4],
			[['lang_name', 'native_name'], 'max' => 32],
			[['locale', 'html_lang'], 'max' => 12],
			[['lang_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang', 'prev_code'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => 'Language PK',
			'lang_code' => 'Language Code',
			'prev_code' => 'Previous Code',
			'menu_position' => 'Menu Position',
			'active' => 'Active',
			'lang_name' => 'Language Name',
			'native_name' => 'Native Name',
			'flag_icon' => 'Flag Icon',
			'ui_label' => 'UI Label',
			'locale' => 'Locale',
			'html_lang' => 'HTML Language',
			'footer_json' => 'Footer JSON',
		];
	}

	/**
	 * Gets query for [[SwLanguagePages]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getSwLanguagePages()
	{
		return $this->hasMany(SwLanguagePage::class, ['page_lang' => 'lang_code']);
	}
}
