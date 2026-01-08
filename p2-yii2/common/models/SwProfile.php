<?php
/**
 * @common/models/SwProfile.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Da\User\Model\Profile as UsuarioProfile;
use Yii;

class SwProfile extends UsuarioProfile
{
	public function attributeLabels(): array
	{
		return array_merge(parent::attributeLabels(), [
			'name'           => Yii::t('admin',          'Name'),
			'public_email'   => Yii::t('admin.settings', 'Public Email'),
			'website'        => Yii::t('admin.settings', 'Website'),
			'location'       => Yii::t('admin.settings', 'Location'),
			'timezone'       => Yii::t('admin.settings', 'Timezone'),
			'gravatar_email' => Yii::t('admin.settings', 'Gravatar Email'),
			'bio'            => Yii::t('admin.settings', 'Bio'),
		]);
	}

	public function attributeHints(): array
	{
		return array_merge(parent::attributeHints(), [
			'gravatar_email' => Yii::t('admin.settings', 'Change your avatar at Gravatar.com'),
		]);
	}
}
