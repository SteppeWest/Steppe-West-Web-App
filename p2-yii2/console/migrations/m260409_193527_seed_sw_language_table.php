<?php

use yii\db\Migration;

class m260409_193527_seed_sw_language_table extends Migration
{
	public function safeUp()
	{
		$this->batchInsert('{{%language}}', [
			'code',
			'legacy_code',
			'menu_position',
			'is_active',
			'name_en',
			'native_name',
			'flag_icon',
			'ui_label',
			'locale',
			'html_lang',
		], [
			['en', 'EN', 1, 1, 'English', 'English', 'GB', 'EN', 'en_AU', 'en_AU'],
			['ru', 'RU', 2, 1, 'Russian', 'Русский', 'RU', 'RU', 'ru_RU', 'ru'],
			['kk', 'KZ', 3, 1, 'Kazakh', 'Қазақ', 'KZ', 'KZ', 'kk_KZ', 'kk'],
			['ky', 'KG', 4, 1, 'Kyrgyz', 'Кыргыз', 'KG', 'KG', 'ky_KG', 'ky'],
			['tg', 'TJ', 5, 1, 'Tajik', 'Тоҷикӣ', 'TJ', 'TJ', 'tg_TJ', 'tg'],
			['tk', 'TM', 6, 1, 'Turkmen', 'Türkmen', 'TM', 'TM', 'tk_TM', 'tk'],
			['uz', 'UZ', 7, 1, 'Uzbek', 'O‘zbek', 'UZ', 'UZ', 'uz_Latn_UZ', 'uz_Latn'],
			['az', 'AZ', 8, 1, 'Azerbaijani', 'Azərbaycan', 'AZ', 'AZ', 'az_Latn_AZ', 'az_Latn'],
			['mn', 'MN', 9, 1, 'Mongolian', 'Монгол', 'MN', 'MN', 'mn_MN', 'mn'],
			['tr', 'TR', 10, 1, 'Turkish', 'Türkçe', 'TR', 'TR', 'tr_Latn_TR', 'tr_Latn'],
		]);
	}

	public function safeDown()
	{
		$this->delete('{{%language}}');
	}
}
