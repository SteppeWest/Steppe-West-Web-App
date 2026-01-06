<?php

use yii\db\Migration;

class m260105_104527_sw_expand_dummy_users_for_pagination extends Migration
{
	public function safeUp()
	{
		$time          = time();
		$plainPassword = 'SteppeWest2025!';

		$newUsers = [];

		// musafir: add musafir-11 … musafir-50 (40 users)
		for ($i = 11; $i <= 50; $i++) {
			$newUsers[] = [
				"musafir-$i",
				"bandidoofoz+musafir-$i@gmail.com",
				"Musafir $i",
				'musafir',
			];
		}

		// nomad: add nomad-7 … nomad-20 (14 users)
		for ($i = 7; $i <= 20; $i++) {
			$newUsers[] = [
				"nomad-$i",
				"bandidoofoz+nomad-$i@gmail.com",
				"Nomad $i",
				'nomad',
			];
		}

		foreach ($newUsers as [$username, $email, $name, $role])
		{
			$passwordHash = Yii::$app->security->generatePasswordHash($plainPassword);
			$authKey      = Yii::$app->security->generateRandomString(32);

			$this->insert('sw_user', [
				'username'        => $username,
				'email'           => $email,
				'password_hash'   => $passwordHash,
				'auth_key'        => $authKey,
				'confirmed_at'    => $time,
				'created_at'      => $time,
				'updated_at'      => $time,
				'registration_ip' => '127.0.0.1',
				'last_login_ip'   => '127.0.0.1',
			]);

			$userId = (int)$this->db->getLastInsertID();

			$this->insert('sw_profile', [
				'user_id'      => $userId,
				'name'         => $name,
				'public_email' => $email,
				'timezone'     => 'Australia/Brisbane',
			]);

			$this->insert('sw_auth_assignment', [
				'item_name'  => $role,
				'user_id'    => (string)$userId,
				'created_at' => $time,
			]);
		}
	}

	public function safeDown()
	{
		$this->delete('sw_auth_assignment', [
			'or',
			['and', ['like', 'user_id', '%'], ['item_name' => 'musafir']],
			['and', ['like', 'user_id', '%'], ['item_name' => 'nomad']],
		]);

		$this->delete('sw_profile', [
			'or',
			['like', 'name', 'Musafir %', false],
			['like', 'name', 'Nomad %', false],
		]);

		$this->delete('sw_user', [
			'or',
			['like', 'username', 'musafir-%', false],
			['like', 'username', 'nomad-%', false],
		]);
	}
}
