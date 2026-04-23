<?php

use yii\db\Migration;

class m260410_173821_add_languages extends Migration
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
			['ug', null, 11, 0, 'Uyghur', 'Uyghur tili', 'ug', 'UG', 'ug_Latn', 'ug_Latn'],
			['tt', null, 12, 0, 'Tatar', 'Татарча', 'tt', 'TT', 'tt_RU', 'tt_Cryl'],
			['ba', null, 13, 0, 'Bashkir', 'Башҡорт теле', 'ba', 'BA', 'ba_RU', 'ba_Cyrl'],
			['kaa', null, 14, 0, 'Karakalpak', 'Qaraqalpaq tili', 'kaa', 'KAA', 'kaa_UZ', 'kaa_Latn'],
			['sah', null, 15, 0, 'Sakha', 'Саха тыла', 'sah', 'SAH', 'sah_RU', 'sah_Cyrl'],
			['alt', null, 16, 0, 'Altai', 'Алтай тили', 'alt', 'ALT', 'alt_RU', 'alt_Latn'],
			['xal', null, 17, 0, 'Kalmyk', 'Хальмг келн', 'xal', 'XAL', 'xal_RU', 'xal_Cyrl'],
			['chv', null, 18, 0, 'Chuvash', 'Чӑваш чӗлхи', 'chv', 'CHV', 'chv_RU', 'chv_Cyrl'],
			['crh', null, 19, 0, 'Crimean Tatar', 'Qırımtatar tili', 'crh', 'CRH', 'crh_UA', 'crh_Latn'],
			['nog', null, 20, 0, 'Nogai', 'Ногай тили', 'nog', 'NOG', 'nog_RU', 'nog_Cyrl'],
			['bua', null, 21, 0, 'Buryat', 'Буряад хэлэн', 'bua', 'BUA', 'bua', 'bua_Cyrl'],
			['oiq', null, 22, 0, 'Oirat', 'Ойрад хэл', 'oiq', 'OIQ', 'oiq', 'oiq_Cyrl'],
			['ce', null, 23, 0, 'Chechen', 'Нохчийн мотт', 'ce', 'CE', 'ce_RU', 'ce_Cyrl'],
		]);
	}

	public function safeDown()
	{
		$this->delete('{{%language}}');
	}
}
