<?php

use yii\db\Migration;
use yii\base\Exception;
use yii\rbac\Role;

class m251206_154711_steppewest_roles extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$auth = Yii::$app->authManager;

		if ($auth === null) {
			throw new Exception('authManager is not configured.');
		}

		// --- Base / default roles ---------------------------------------

		// konok = guest (not logged in)
		$konok = $auth->getRole('konok');
		if ($konok === null) {
			$konok = $auth->createRole('konok');
			$konok->description = 'Guest (konok - Kyrgyz for guest; not logged in)';
			$auth->add($konok);
		}

		// musafir = base authenticated user
		$musafir = $auth->getRole('musafir');
		if ($musafir === null) {
			$musafir = $auth->createRole('musafir');
			$musafir->description = 'Base Steppe West user (musafir - Turkic/Persian for traveller)';
			$auth->add($musafir);
		}


		// --- Steppe West hierarchy roles --------------------------------

		// nomad = member
		$nomad = $auth->getRole('nomad');
		if ($nomad === null) {
			$nomad = $auth->createRole('nomad');
			$nomad->description = 'Member (nomad – self-nominated higher level of musafir)';
			$auth->add($nomad);
		}

		// bek = staff
		$bek = $auth->getRole('bek');
		if ($bek === null) {
			$bek = $auth->createRole('bek');
			$bek->description = 'Staff (bek – lowest backend access; assigned by higher level; Kazakh for a minor khan)';
			$auth->add($bek);
		}

		// khan = admin
		$khan = $auth->getRole('khan');
		if ($khan === null) {
			$khan = $auth->createRole('khan');
			$khan->description = 'Admin (khan – backend admin, created/promoted by chinggis)';
			$auth->add($khan);
		}

		// chinggis = super admin
		$chinggis = $auth->getRole('chinggis');
		if ($chinggis === null) {
			$chinggis = $auth->createRole('chinggis');
			$chinggis->description = 'Super admin (chinggis – unique; username: chinggis; the greatest khan)';
			$auth->add($chinggis);
		}

		// --- Compatibility "admin" item for yii2-usuario ----------------

		$admin = $auth->getRole('admin');
		if ($admin === null) {
			$admin = $auth->createRole('admin');
			$admin->description = 'Internal admin role (for yii2-usuario compatibility)';
			$auth->add($admin);
		}

		// --- Hierarchy --------------------------------------------------
		//
		// konok (guest) – default role for ? user (handled via defaultRoles config)
		// musafir        – default role for @ user
		// musafir < nomad < bek < khan < chinggis
		//
		// khan & chinggis should satisfy checks for "admin".
		// admin itself should also imply bek (and everything below, via chain).

		$auth->addChild($nomad, $musafir);
		$auth->addChild($bek, $nomad);
		$auth->addChild($khan, $bek);
		$auth->addChild($chinggis, $khan);

		// Make khan and chinggis effectively "admin"
		$auth->addChild($khan, $admin);
		$auth->addChild($chinggis, $admin);

		// If admin is used directly, it should at least imply bek
		$auth->addChild($admin, $bek);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$auth = Yii::$app->authManager;

		if ($auth === null) {
			return false;
		}

		// Remove roles in reverse order of dependency
		$names = ['chinggis', 'khan', 'admin', 'bek', 'nomad', 'musafir', 'konok'];

		foreach ($names as $name) {
			$item = $auth->getRole($name);
			if ($item instanceof Role) {
				$auth->remove($item);
			}
		}

		return true;
	}
}
