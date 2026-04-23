<?php

use yii\db\Migration;
use yii\db\Query;

class m260410_080404_seed_sw_contact_tables extends Migration
{
	public function safeUp()
	{
		$languageIds = (new Query())
			->select(['id', 'code'])
			->from('{{%language}}')
			->indexBy('code')
			->column();

		$requiredCodes = ['en', 'ru', 'kk', 'ky', 'tg', 'tk', 'uz', 'az', 'mn', 'tr'];

		foreach ($requiredCodes as $code) {
			if (!isset($languageIds[$code])) {
				throw new \RuntimeException("Language code '{$code}' not found in sw_language.");
			}
		}

		$now = time();

		$this->batchInsert('{{%contact}}', [
			'country_code',
			'email',
			'whatsapp_number',
			'is_staff',
			'is_public',
			'is_active',
			'sort_order',
			'created_at',
			'updated_at',
		], [
			['au', 'pedro@steppewest.com', '+61 400 473 376', 1, 1, 1, 10, $now, $now],
			['kg', 'erkaiym@steppewest.com', '+7 778 321 2863', 1, 1, 1, 20, $now, $now],
		]);

		$pedroId = (new Query())
			->select('id')
			->from('{{%contact}}')
			->where(['email' => 'pedro@steppewest.com'])
			->scalar();

		$erkaiymId = (new Query())
			->select('id')
			->from('{{%contact}}')
			->where(['email' => 'erkaiym@steppewest.com'])
			->scalar();

		if (!$pedroId || !$erkaiymId) {
			throw new \RuntimeException('Failed to resolve inserted sw_contact rows.');
		}

		$this->batchInsert('{{%contact_translation}}', [
			'contact_id',
			'language_id',
			'first_name',
			'family_name',
			'display_name',
			'role_title',
			'country_label',
			'bio_short',
		], [
			[$pedroId,   $languageIds['en'], 'Pedro',    'Plowman',       'Pedro',    'Curator / Director',         'Australia',   null],
			[$erkaiymId, $languageIds['en'], 'Erkaiym',  'Turdumamatova', 'Erkaiym',  'Social Media / Outreach',    'Kyrgyzstan',  null],

			[$pedroId,   $languageIds['ru'], 'Педро',    'Плоуман',       'Педро',    'Куратор / Директор',         'Австралия',   null],
			[$erkaiymId, $languageIds['ru'], 'Эркайым',  'Турдумаматова', 'Эркайым',  'Социальные сети / Аутрич',   'Кыргызстан',  null],

			[$pedroId,   $languageIds['kk'], 'Педро',    'Плоуман',       'Педро',    'Куратор / Директор',         'Аустралия',   null],
			[$erkaiymId, $languageIds['kk'], 'Эркайым',  'Турдумаматова', 'Эркайым',  'Әлеуметтік желі / Аутрич',   'Қырғызстан',  null],

			[$pedroId,   $languageIds['ky'], 'Педро',    'Плоуман',       'Педро',    'Куратор / Директор',         'Австралия',   null],
			[$erkaiymId, $languageIds['ky'], 'Эркайым',  'Турдумаматова', 'Эркайым',  'Социалдык медиа / Аутрич',   'Кыргызстан',  null],

			[$pedroId,   $languageIds['tg'], 'Педро',    'Плоуман',       'Педро',    'Куратор / Директор',         'Австралия',   null],
			[$erkaiymId, $languageIds['tg'], 'Эркайым',  'Турдумаматова', 'Эркайым',  'Шабакаҳои иҷтимоӣ / Аутрич', 'Қирғизистон', null],

			[$pedroId,   $languageIds['tk'], 'Pedro',    'Plowman',       'Pedro',    'Kurator / Direktor',         'Awstraliýa',  null],
			[$erkaiymId, $languageIds['tk'], 'Erkaiym',  'Turdumamatova', 'Erkaiym',  'Sosial media / Outreach',    'Gyrgyzystan', null],

			[$pedroId,   $languageIds['uz'], 'Pedro',    'Plowman',       'Pedro',    'Kurator / Direktor',         'Avstraliya',  null],
			[$erkaiymId, $languageIds['uz'], 'Erkaiym',  'Turdumamatova', 'Erkaiym',  'Ijtimoiy tarmoqlar / Outreach', 'Qirgʻiziston', null],

			[$pedroId,   $languageIds['az'], 'Pedro',    'Plowman',       'Pedro',    'Kurator / Direktor',         'Avstraliya',  null],
			[$erkaiymId, $languageIds['az'], 'Erkaiym',  'Turdumamatova', 'Erkaiym',  'Sosial media / Outreach',    'Qırğızıstan', null],

			[$pedroId,   $languageIds['mn'], 'Педро',    'Плоуман',       'Педро',    'Куратор / Захирал',          'Австрали',    null],
			[$erkaiymId, $languageIds['mn'], 'Эркайым',  'Турдумаматова', 'Эркайым',  'Сошиал медиа / Аутрич',      'Кыргызстан',  null],

			[$pedroId,   $languageIds['tr'], 'Pedro',    'Plowman',       'Pedro',    'Küratör / Direktör',         'Avustralya',  null],
			[$erkaiymId, $languageIds['tr'], 'Erkaiym',  'Turdumamatova', 'Erkaiym',  'Sosyal Medya / Outreach',    'Kırgızistan', null],
		]);
	}

	public function safeDown()
	{
		$this->delete('{{%contact_translation}}', [
			'contact_id' => (new Query())
				->select('id')
				->from('{{%contact}}')
				->where(['email' => [
					'pedro@steppewest.com',
					'erkaiym@steppewest.com',
				]])
				->column(),
		]);

		$this->delete('{{%contact}}', [
			'email' => [
				'pedro@steppewest.com',
				'erkaiym@steppewest.com',
			],
		]);
	}
}
