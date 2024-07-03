<?php
/**
 * SWCurrentLanguage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is a model class for table "{{%sw_language_codes}}".
 *
 * @property int $pk
 * @property string $code
 * @property int|null $position
 * @property string $name
 * @property string $native
 * @property string $flag
 * @property string $label
 * @property string $locale
 * @property string $lang
 * @property string $origin
 * @property string $footer_yaml
 */
class SWCurrentLanguage extends SWLanguageCode
{
	/**
	 * {@inheritdoc}
	 * public static function tableName()
	 */

	/**
	 * {@inheritdoc}
	 * public function rules()
	 */

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
			'locale' => Yii::t('app', 'Locale'),
			'lang' => Yii::t('app', 'Lang'),
			'origin' => Yii::t('app', 'Origin'),
			'footer_yaml' => Yii::t('app', 'Footer YAML'),
		];
	}

	public static function getLanguageRecord($page)
	{
		$language = self::getCurrentLanguage();
		if (!$language)
			return;

		$languageCode = SWLanguageSelector::getCurrentLanguage();
		$shared = SWLanguageShared::findOne(['code' => $languageCode]);
		if (!$shared)
			return $language;

		// Merge shared data into language data
		foreach ($shared->attributes as $key => $value)
			$language->$key = $value;

		return $language;
	}
}
?>
<?php
namespace app\models;

/**
 * This is the model class for the current language, extending `SWLanguageCode`.
 */
class SWCurrentLanguage extends SWLanguageCode
{
    public static function getCurrentLanguage($languageCode)
    {
        return self::findOne(['code' => $languageCode]);
    }
}
