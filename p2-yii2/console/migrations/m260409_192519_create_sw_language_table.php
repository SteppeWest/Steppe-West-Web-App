<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sw_language}}`.
 */
class m260409_192519_create_sw_language_table extends Migration
{
	public function safeUp()
	{
		$this->createTable('{{%language}}', [
			'id' => $this->primaryKey(),
			'code' => $this->string(8)->notNull(),
			'legacy_code' => $this->string(8)->null(),
			'menu_position' => $this->smallInteger()->null(),
			'is_active' => $this->boolean()->notNull()->defaultValue(true),
			'name_en' => $this->string(64)->notNull(),
			'native_name' => $this->string(64)->notNull(),
			'flag_icon' => $this->string(8)->null(),
			'ui_label' => $this->string(16)->notNull(),
			'locale' => $this->string(16)->notNull(),
			'html_lang' => $this->string(16)->notNull(),
			'created_at' => $this->integer()->null(),
			'updated_at' => $this->integer()->null(),
		]);

		$this->createIndex(
			'ux_sw_language_code',
			'{{%language}}',
			'code',
			true
		);

		$this->createIndex(
			'ux_sw_language_legacy_code',
			'{{%language}}',
			'legacy_code',
			true
		);
	}

	public function safeDown()
	{
		$this->dropTable('{{%language}}');
	}
}
