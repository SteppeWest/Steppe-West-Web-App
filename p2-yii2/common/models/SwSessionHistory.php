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
			'user_id'    => Yii::t('admin.audit', 'User'),
			'session_id' => Yii::t('admin.audit', 'Session'),
			'user_agent' => Yii::t('admin.audit', 'User Agent'),
			'ip'         => Yii::t('admin.audit', 'IP Address'),
			'created_at' => Yii::t('admin.audit', 'Started'),
			'updated_at' => Yii::t('admin.audit', 'Last Activity'),
		]);
	}
}
