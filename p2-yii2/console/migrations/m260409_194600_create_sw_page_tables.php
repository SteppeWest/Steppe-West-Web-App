<?php

use yii\db\Migration;

class m260409_194600_create_sw_page_tables extends Migration
{
	public function safeUp()
	{
		$this->createTable('{{%sw_page}}', [
			'id' => $this->primaryKey(),
			'code' => $this->string(32)->notNull(),
			'view_key' => $this->string(32)->notNull()->defaultValue('static-page'),
			'is_active' => $this->boolean()->notNull()->defaultValue(true),
			'is_home' => $this->boolean()->notNull()->defaultValue(false),
			'sort_order' => $this->integer()->null(),
			'created_at' => $this->integer()->null(),
			'updated_at' => $this->integer()->null(),
			'created_by' => $this->integer()->null(),
			'updated_by' => $this->integer()->null(),
		]);

		$this->createIndex('ux_sw_page_code', '{{%sw_page}}', 'code', true);

		$this->createTable('{{%sw_page_route}}', [
			'id' => $this->primaryKey(),
			'page_id' => $this->integer()->notNull(),
			'slug' => $this->string(64)->notNull(),
			'is_primary' => $this->boolean()->notNull()->defaultValue(true),
			'is_active' => $this->boolean()->notNull()->defaultValue(true),
		]);

		$this->createIndex('ux_sw_page_route_slug', '{{%sw_page_route}}', 'slug', true);
		$this->createIndex('ix_sw_page_route_page_id', '{{%sw_page_route}}', 'page_id');

		$this->addForeignKey(
			'fk_sw_page_route_page_id',
			'{{%sw_page_route}}',
			'page_id',
			'{{%sw_page}}',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->createTable('{{%sw_page_translation}}', [
			'id' => $this->primaryKey(),
			'page_id' => $this->integer()->notNull(),
			'language_id' => $this->integer()->notNull(),
			'title' => $this->string(255)->notNull(),
			'subtitle' => $this->string(255)->null(),
			'meta_description' => $this->text()->null(),
			'meta_keywords' => $this->text()->null(),
			'origin_label' => $this->string(255)->null(),
			'origin_url' => $this->string(2048)->null(),
			'body_content' => $this->text()->null(),
			'status' => $this->string(16)->notNull()->defaultValue('published'),
			'created_at' => $this->integer()->null(),
			'updated_at' => $this->integer()->null(),
			'created_by' => $this->integer()->null(),
			'updated_by' => $this->integer()->null(),
		]);

		$this->createIndex(
			'ux_sw_page_translation_page_language',
			'{{%sw_page_translation}}',
			['page_id', 'language_id'],
			true
		);

		$this->createIndex('ix_sw_page_translation_language_id', '{{%sw_page_translation}}', 'language_id');

		$this->addForeignKey(
			'fk_sw_page_translation_page_id',
			'{{%sw_page_translation}}',
			'page_id',
			'{{%sw_page}}',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk_sw_page_translation_language_id',
			'{{%sw_page_translation}}',
			'language_id',
			'{{%sw_language}}',
			'id',
			'RESTRICT',
			'CASCADE'
		);
	}

	public function safeDown()
	{
		$this->dropForeignKey('fk_sw_page_translation_language_id', '{{%sw_page_translation}}');
		$this->dropForeignKey('fk_sw_page_translation_page_id', '{{%sw_page_translation}}');
		$this->dropForeignKey('fk_sw_page_route_page_id', '{{%sw_page_route}}');

		$this->dropTable('{{%sw_page_translation}}');
		$this->dropTable('{{%sw_page_route}}');
		$this->dropTable('{{%sw_page}}');
	}
}
