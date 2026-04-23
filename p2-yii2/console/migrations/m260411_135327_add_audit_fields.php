<?php

use yii\db\Migration;

class m260411_135327_add_audit_fields extends Migration
{
	public function safeUp()
	{
		$this->addColumn('{{%faq_item}}', 'created_by', $this->integer()->null()->after('updated_at'));
		$this->addColumn('{{%faq_item}}', 'updated_by', $this->integer()->null()->after('created_by'));

		$this->addColumn('{{%faq_translation}}', 'created_at', $this->integer()->null()->after('answer'));
		$this->addColumn('{{%faq_translation}}', 'updated_at', $this->integer()->null()->after('created_at'));
		$this->addColumn('{{%faq_translation}}', 'created_by', $this->integer()->null()->after('updated_at'));
		$this->addColumn('{{%faq_translation}}', 'updated_by', $this->integer()->null()->after('created_by'));

		$now = time();

		$this->update('{{%faq_translation}}', [
			'created_at' => $now,
			'updated_at' => $now,
		]);
	}

	public function safeDown()
	{
		$this->dropColumn('{{%faq_translation}}', 'updated_by');
		$this->dropColumn('{{%faq_translation}}', 'created_by');
		$this->dropColumn('{{%faq_translation}}', 'updated_at');
		$this->dropColumn('{{%faq_translation}}', 'created_at');

		$this->dropColumn('{{%faq_item}}', 'updated_by');
		$this->dropColumn('{{%faq_item}}', 'created_by');
	}
}
