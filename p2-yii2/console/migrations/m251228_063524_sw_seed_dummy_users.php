<?php

use yii\db\Migration;

class m251228_063524_sw_seed_dummy_users extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$time = time();

		// One password for all dummy users (easy for local testing).
		// Change as you like.
		$plainPassword = 'SteppeWest2025!';

		// 12 dummy users:
		// - 2 khan
		// - 3 bek
		// - 4 musafir
		// - 3 nomad
		$users = [
			// khan (2)
			['khan-1', 'khan1@steppewest.example', 'Khan One', 'khan'],
			['khan-2', 'khan2@steppewest.example', 'Khan Two', 'khan'],

			// bek (3)
			['bek-1', 'bek1@steppewest.example', 'Bek One', 'bek'],
			['bek-2', 'bek2@steppewest.example', 'Bek Two', 'bek'],
			['bek-3', 'bek3@steppewest.example', 'Bek Three', 'bek'],

			// musafir (4)
			['musafir-1', 'musafir1@steppewest.example', 'Musafir One', 'musafir'],
			['musafir-2', 'musafir2@steppewest.example', 'Musafir Two', 'musafir'],
			['musafir-3', 'musafir3@steppewest.example', 'Musafir Three', 'musafir'],
			['musafir-4', 'musafir4@steppewest.example', 'Musafir Four', 'musafir'],

			// nomad (3)
			['nomad-1', 'nomad1@steppewest.example', 'Nomad One', 'nomad'],
			['nomad-2', 'nomad2@steppewest.example', 'Nomad Two', 'nomad'],
			['nomad-3', 'nomad3@steppewest.example', 'Nomad Three', 'nomad'],
		];

		foreach ($users as [$username, $email, $name, $role])
		{
			$passwordHash = \Yii::$app->security->generatePasswordHash($plainPassword);
			$authKey = \Yii::$app->security->generateRandomString(32);

			// Insert into sw_user (only required columns + confirmed_at)
			$this->insert('sw_user', [
				'username' => $username,
				'email' => $email,
				'password_hash' => $passwordHash,
				'auth_key' => $authKey,
				'confirmed_at' => $time,
				'updated_at' => $time,
				'created_at' => $time,
				// optional niceties (safe defaults)
				'registration_ip' => '127.0.0.1',
				'last_login_ip' => '127.0.0.1',
			]);

			$userId = (int)$this->db->getLastInsertID();

			// Insert profile
			$this->insert('sw_profile', [
				'user_id' => $userId,
				'name' => $name,
				'public_email' => $email,
				'timezone' => 'Australia/Brisbane',
			]);

			// Assign RBAC role
			$this->insert('sw_auth_assignment', [
				'item_name' => $role,
				'user_id' => (string)$userId,
				'created_at' => $time,
			]);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		// Remove by username prefix so we don’t touch real accounts (including chinggis)
		$userIds = (new \yii\db\Query())
			->select('id')
			->from('sw_user')
			->where(['like', 'username', 'khan-%', false])
			->orWhere(['like', 'username', 'bek-%', false])
			->orWhere(['like', 'username', 'musafir-%', false])
			->orWhere(['like', 'username', 'nomad-%', false])
			->column($this->db);

		if (!$userIds)
		{
			return;
		}

		$this->delete('sw_auth_assignment', ['user_id' => array_map('strval', $userIds)]);
		$this->delete('sw_profile', ['user_id' => $userIds]);
		$this->delete('sw_user', ['id' => $userIds]);
	}
}
