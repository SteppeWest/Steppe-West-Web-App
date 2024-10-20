<?php
/**
 * SWCurrentLanguage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Yii;
use common\models\SWLanguageBase;
use common\widgets\SWFlagSelector;
use common\widgets\SWLanguageSelector;

/**
 * This is the model class for table "{{%language_base}}".
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
 * @property LanguagePage[] $languagePages
 */
class SWCurrentLanguage extends SWLanguageBase
{
	//public static function tableName()

	//public function rules()

	//public function attributeLabels()

	//public function getLanguagePages()

	/**
	 * {@inheritdoc}
	 * @return SWCurrentLanguageQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new SWCurrentLanguageQuery(get_called_class());
	}
}
