<?php

use yii\db\Migration;

class m260409_202322_create_sw_contact_tables extends Migration
{
	public function safeUp()
	{
		$this->createTable('{{%sw_contact}}', [
			'id' => $this->primaryKey(),
			'profile_user_id' => $this->integer()->null(),
			'country_code' => $this->string(8)->null(),
			'email' => $this->string(255)->null(),
			'whatsapp_number' => $this->string(32)->null(),
			'is_staff' => $this->boolean()->notNull()->defaultValue(true),
			'is_public' => $this->boolean()->notNull()->defaultValue(true),
			'is_active' => $this->boolean()->notNull()->defaultValue(true),
			'sort_order' => $this->integer()->notNull()->defaultValue(0),
			'created_at' => $this->integer()->null(),
			'updated_at' => $this->integer()->null(),
		]);

		$this->createIndex('ix_sw_contact_profile_user_id', '{{%sw_contact}}', 'profile_user_id');
		$this->createIndex('ix_sw_contact_sort_order', '{{%sw_contact}}', 'sort_order');

		$this->createTable('{{%sw_contact_translation}}', [
			'id' => $this->primaryKey(),
			'contact_id' => $this->integer()->notNull(),
			'language_id' => $this->integer()->notNull(),
			'first_name' => $this->string(128)->notNull(),
			'family_name' => $this->string(128)->null(),
			'display_name' => $this->string(255)->null(),
			'role_title' => $this->string(255)->null(),
			'country_label' => $this->string(128)->null(),
			'bio_short' => $this->text()->null(),
		]);

		$this->createIndex(
			'ux_sw_contact_translation_contact_language',
			'{{%sw_contact_translation}}',
			['contact_id', 'language_id'],
			true
		);

		$this->createIndex('ix_sw_contact_translation_language_id', '{{%sw_contact_translation}}', 'language_id');

		$this->addForeignKey(
			'fk_sw_contact_translation_contact_id',
			'{{%sw_contact_translation}}',
			'contact_id',
			'{{%sw_contact}}',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk_sw_contact_translation_language_id',
			'{{%sw_contact_translation}}',
			'language_id',
			'{{%sw_language}}',
			'id',
			'RESTRICT',
			'CASCADE'
		);
	}

	public function safeDown()
	{
		$this->dropForeignKey('fk_sw_contact_translation_language_id', '{{%sw_contact_translation}}');
		$this->dropForeignKey('fk_sw_contact_translation_contact_id', '{{%sw_contact_translation}}');

		$this->dropTable('{{%sw_contact_translation}}');
		$this->dropTable('{{%sw_contact}}');
	}
}
