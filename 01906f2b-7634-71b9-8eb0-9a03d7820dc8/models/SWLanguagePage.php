<?php
/**
 * SWLanguagePage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \app\assets\SWLanguagePage
 *
 * Load this asset with...
 * app\assets\SWLanguagePage::register($this);
 *
 * use app\assets\SWLanguagePage;
 * SWAppAsset::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\SWLanguagePage',
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "sw_language_page".
 *
 * @property int $pk
 * @property string $code
 * @property string|null $page
 * @property string $title
 * @property string|null $subtitle
 * @property string $description
 * @property string $keywords
 * @property string|null $lead
 * @property string|null $body_yaml
 */
class SWLanguagePage extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'sw_language_page';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['code', 'title', 'description', 'keywords'], 'required'],
			[['code', 'page', 'title', 'subtitle', 'description', 'keywords', 'lead', 'body_yaml'], 'string'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => Yii::t('app', 'Pk'),
			'code' => Yii::t('app', 'Code'),
			'page' => Yii::t('app', 'Page'),
			'title' => Yii::t('app', 'Title'),
			'subtitle' => Yii::t('app', 'Subtitle'),
			'description' => Yii::t('app', 'Description'),
			'keywords' => Yii::t('app', 'Keywords'),
			'lead' => Yii::t('app', 'Lead'),
			'body_yaml' => Yii::t('app', 'Body Yaml'),
		];
	}
}
