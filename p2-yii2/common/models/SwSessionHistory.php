<?php
/**
 * @common/models/SwSessionHistory.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Da\User\Model\SessionHistory as UsuarioSessionHistory;
use Yii;

class SwSessionHistory extends UsuarioSessionHistory
{
	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'user_id'    => Yii::t('sw', 'User'),
			'session_id' => Yii::t('sw', 'Session'),
			'user_agent' => Yii::t('sw', 'User Agent'),
			'ip'         => Yii::t('sw', 'IP Address'),
			'created_at' => Yii::t('sw', 'Started'),
			'updated_at' => Yii::t('sw', 'Last Activity'),
		]);
	}
}
