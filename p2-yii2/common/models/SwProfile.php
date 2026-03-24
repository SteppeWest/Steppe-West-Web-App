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
			'name'           => Yii::t('sw',          'Name'),
			'public_email'   => Yii::t('sw', 'Public Email'),
			'website'        => Yii::t('sw', 'Website'),
			'location'       => Yii::t('sw', 'Location'),
			'timezone'       => Yii::t('sw', 'Timezone'),
			'gravatar_email' => Yii::t('sw', 'Gravatar Email'),
			'bio'            => Yii::t('sw', 'Bio'),
		]);
	}

	public function attributeHints(): array
	{
		return array_merge(parent::attributeHints(), [
			'gravatar_email' => Yii::t('sw', 'Change your avatar at Gravatar.com'),
		]);
	}
}
