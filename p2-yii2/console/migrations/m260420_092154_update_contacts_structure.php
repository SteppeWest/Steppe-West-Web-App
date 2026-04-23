<?php

use yii\db\Migration;

class m260420_092154_update_contacts_structure extends Migration
{
	public function safeUp()
	{
		$this->renameColumn('{{%contact}}', 'whatsapp_number', 'phone');

		$this->addColumn('{{%contact}}', 'telegram', $this->string(32)->null()->after('phone'));
		$this->addColumn('{{%contact}}', 'has_whatsapp', $this->boolean()->notNull()->defaultValue(false)->after('telegram'));
		$this->addColumn('{{%contact}}', 'has_signal', $this->boolean()->notNull()->defaultValue(false)->after('has_whatsapp'));
		$this->addColumn('{{%contact}}', 'has_viber', $this->boolean()->notNull()->defaultValue(false)->after('has_signal'));

		$this->update(
			'{{%contact}}',
			['has_whatsapp' => 1],
			['not', ['phone' => null]]
		);

		$this->update(
			'{{%contact}}',
			['has_whatsapp' => 0],
			['phone' => '']
		);
	}

	public function safeDown()
	{
		$this->dropColumn('{{%contact}}', 'has_viber');
		$this->dropColumn('{{%contact}}', 'has_signal');
		$this->dropColumn('{{%contact}}', 'has_whatsapp');
		$this->dropColumn('{{%contact}}', 'telegram');

		$this->renameColumn('{{%contact}}', 'phone', 'whatsapp_number');
	}
}
