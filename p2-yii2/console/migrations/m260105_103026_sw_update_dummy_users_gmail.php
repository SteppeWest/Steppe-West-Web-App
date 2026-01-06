<?php

use yii\db\Migration;

class m260105_103026_sw_update_dummy_users_gmail extends Migration
{
	public function safeUp()
	{
		$time = time();
		$plainPassword = 'SteppeWest2025!';

		// 1) Update existing dummy users to Gmail plus-addressing
		$users = (new \yii\db\Query())
			->select(['id', 'username'])
			->from('sw_user')
			->where(['or',
				['like', 'username', 'khan-%', false],
				['like', 'username', 'bek-%', false],
				['like', 'username', 'musafir-%', false],
				['like', 'username', 'nomad-%', false],
			])
			->all($this->db);

		foreach ($users as $user)
		{
			$email = 'bandidoofoz+' . $user['username'] . '@gmail.com';

			$this->update(
				'sw_user',
				['email' => $email],
				['id' => $user['id']]
			);

			$this->update(
				'sw_profile',
				['public_email' => $email],
				['user_id' => $user['id']]
			);
		}

		// 2) Add extra dummy users
		$newUsers = [];

		// musafir: add 6 (musafir-5 … musafir-10)
		for ($i = 5; $i <= 10; $i++) {
			$newUsers[] = [
				"musafir-$i",
				"bandidoofoz+musafir-$i@gmail.com",
				"Musafir $i",
				'musafir',
			];
		}

		// nomad: add 3 (nomad-4 … nomad-6)
		for ($i = 4; $i <= 6; $i++) {
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
			$authKey = Yii::$app->security->generateRandomString(32);

			$this->insert('sw_user', [
				'username' => $username,
				'email' => $email,
				'password_hash' => $passwordHash,
				'auth_key' => $authKey,
				'confirmed_at' => $time,
				'created_at' => $time,
				'updated_at' => $time,
				'registration_ip' => '127.0.0.1',
				'last_login_ip' => '127.0.0.1',
			]);

			$userId = (int)$this->db->getLastInsertID();

			$this->insert('sw_profile', [
				'user_id' => $userId,
				'name' => $name,
				'public_email' => $email,
				'timezone' => 'Australia/Brisbane',
			]);

			$this->insert('sw_auth_assignment', [
				'item_name' => $role,
				'user_id' => (string)$userId,
				'created_at' => $time,
			]);
		}
	}

	public function safeDown()
	{
		$userIds = (new \yii\db\Query())
			->select('id')
			->from('sw_user')
			->where(['like', 'email', 'bandidoofoz+%', false])
			->column($this->db);

		if (!$userIds) {
			return;
		}

		$this->delete('sw_auth_assignment', ['user_id' => array_map('strval', $userIds)]);
		$this->delete('sw_profile', ['user_id' => $userIds]);
		$this->delete('sw_user', ['id' => $userIds]);
	}
}
