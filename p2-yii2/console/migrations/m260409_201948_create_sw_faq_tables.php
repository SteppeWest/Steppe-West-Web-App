<?php

use yii\db\Migration;

class m260409_201948_create_sw_faq_tables extends Migration
{
	public function safeUp()
	{
		$this->createTable('{{%sw_faq_item}}', [
			'id' => $this->primaryKey(),
			'page_id' => $this->integer()->notNull(),
			'code' => $this->string(64)->null(),
			'is_active' => $this->boolean()->notNull()->defaultValue(true),
			'sort_order' => $this->integer()->notNull()->defaultValue(0),
			'created_at' => $this->integer()->null(),
			'updated_at' => $this->integer()->null(),
		]);

		$this->createIndex('ix_sw_faq_item_page_id', '{{%sw_faq_item}}', 'page_id');
		$this->createIndex('ix_sw_faq_item_page_sort', '{{%sw_faq_item}}', ['page_id', 'sort_order']);
		$this->createIndex('ux_sw_faq_item_page_code', '{{%sw_faq_item}}', ['page_id', 'code'], true);

		$this->addForeignKey(
			'fk_sw_faq_item_page_id',
			'{{%sw_faq_item}}',
			'page_id',
			'{{%sw_page}}',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->createTable('{{%sw_faq_translation}}', [
			'id' => $this->primaryKey(),
			'faq_item_id' => $this->integer()->notNull(),
			'language_id' => $this->integer()->notNull(),
			'question' => $this->string(255)->notNull(),
			'answer' => $this->text()->notNull(),
		]);

		$this->createIndex(
			'ux_sw_faq_translation_item_language',
			'{{%sw_faq_translation}}',
			['faq_item_id', 'language_id'],
			true
		);

		$this->createIndex('ix_sw_faq_translation_language_id', '{{%sw_faq_translation}}', 'language_id');

		$this->addForeignKey(
			'fk_sw_faq_translation_item_id',
			'{{%sw_faq_translation}}',
			'faq_item_id',
			'{{%sw_faq_item}}',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk_sw_faq_translation_language_id',
			'{{%sw_faq_translation}}',
			'language_id',
			'{{%sw_language}}',
			'id',
			'RESTRICT',
			'CASCADE'
		);
	}

	public function safeDown()
	{
		$this->dropForeignKey('fk_sw_faq_translation_language_id', '{{%sw_faq_translation}}');
		$this->dropForeignKey('fk_sw_faq_translation_item_id', '{{%sw_faq_translation}}');
		$this->dropForeignKey('fk_sw_faq_item_page_id', '{{%sw_faq_item}}');

		$this->dropTable('{{%sw_faq_translation}}');
		$this->dropTable('{{%sw_faq_item}}');
	}
}
