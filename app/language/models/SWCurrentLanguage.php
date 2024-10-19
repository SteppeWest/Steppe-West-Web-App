<?php
/**
 * SWCurrentLanguage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace language\models;

use Yii;
use letter\models\SWLanguagePage;

/**
 * This is the model class for table "{{%language_page}}".
 *
 * @property int $page_pk Page PK
 * @property string $page_lang Language Code
 * @property string $page_slug Page Slug
 * @property string $title Page Title
 * @property string|null $subtitle Subtitle
 * @property string|null $description Description
 * @property string|null $keywords Keywords
 * @property string|null $lead Page Lead
 * @property string|null $origin Substack Origin
 * @property string|null $origin_link Origin Link
 * @property string|null $body_json Body JSON
 *
 * @property LanguageBase $pageLang
 */
class SWCurrentLanguage extends SWLanguagePage
{
	//public static function tableName()

	//public function rules()

	//public function attributeLabels()

	//public function getPageLang()

	/**
	 * {@inheritdoc}
	 * @return SWCurrentLanguageQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new SWCurrentLanguageQuery(get_called_class());
	}

	public static function getCurrentLanguage()
	{
		$languageCode = SWLanguageSelector::getCurrentLanguage();
		return self::findOne(['code' => $languageCode]);
	}

	public static function getLanguageRecord($page = null)
	{
		$language = self::getCurrentLanguage();
		if (!$language) return null;

		$shared = $language->shared;
		if ($shared) {
			foreach ($shared->attributes as $key => $value) {
				$language->$key = $value;
			}
		}

		if (!$page) return $language;

		$pageRecord = SWLanguagePage::findOne([
			'code' => $language->code,
			'page' => $page
		]);
		if ($pageRecord) {
			foreach ($pageRecord->attributes as $key => $value) {
				$language->$key = $value;
			}
		}

		return $language;
	}

	private static function mergeRecords($record, $language)
	{
		if (!$record) {
			return $language;
		}

		// Merge record data into language data
		foreach ($record->attributes as $key => $value) {
			$language->$key = $value;
		}

		return $language;
	}
}
