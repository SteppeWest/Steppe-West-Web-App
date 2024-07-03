<?php
/**
 * SWLanguageShared.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \app\assets\SWLanguageShared
 *
 * Load this asset with...
 * app\assets\SWLanguageShared::register($this);
 *
 * use app\assets\SWLanguageShared;
 * SWAppAsset::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\SWLanguageShared',
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "sw_language_shared".
 *
 * @property int $pk
 * @property string $code
 * @property string $locale
 * @property string $lang
 * @property string $origin
 * @property string $footer_yaml
 */
class SWLanguageShared extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'sw_language_shared';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['code', 'locale', 'lang', 'origin', 'footer_yaml'], 'required'],
			[['code', 'locale', 'lang', 'origin', 'footer_yaml'], 'string'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => Yii::t('app', 'PK'),
			'code' => Yii::t('app', 'Code'),
			'locale' => Yii::t('app', 'Locale'),
			'lang' => Yii::t('app', 'Lang'),
			'origin' => Yii::t('app', 'Origin'),
			'footer_yaml' => Yii::t('app', 'Footer YAML'),
		];
	}
}
