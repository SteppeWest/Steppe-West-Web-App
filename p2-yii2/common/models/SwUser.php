<?php
/**
 * @common/models/SwUser.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use Da\User\Model\User as UsuarioUser;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class SwUser extends UsuarioUser
{
	const STATUS_DELETED = 0;
	const STATUS_INACTIVE = 9;
	const STATUS_ACTIVE = 10;

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			TimestampBehavior::class,
		];
	}

	/**
	public function behaviors()
	{
		$behaviors = [
			TimestampBehavior::class,
		];

		if ($this->module->enableGdprCompliance) {
			$behaviors['GDPR'] = [
				'class' => TimestampBehavior::class,
				'createdAtAttribute' => 'gdpr_consent_date',
				'updatedAtAttribute' => false
			];
		}

		return $behaviors;
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['status', 'default', 'value' => self::STATUS_INACTIVE],
			['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'username'            => Yii::t('admin', 'Username'),
			'email'               => Yii::t('admin', 'Email'),

			// Account / security related
			'password'            => Yii::t('admin.settings', 'Password'),
			'unconfirmed_email'   => Yii::t('admin.settings', 'New Email'),

			// Audit / system fields (admin-wide)
			'registration_ip'     => Yii::t('admin', 'Registration IP'),
			'created_at'          => Yii::t('admin', 'Created'),
			'confirmed_at'        => Yii::t('admin.rbac', 'Confirmed'),
			'last_login_at'       => Yii::t('admin', 'Last Login'),
			'last_login_ip'       => Yii::t('admin', 'Last Login IP'),

			// Optional / advanced (can be hidden in UI)
			'password_changed_at' => Yii::t('admin.settings', 'Password Changed'),
			'password_age'        => Yii::t('admin.settings', 'Password Age'),
		]);
	}

	/**
	public function rules()
	{
		return [
			// username rules
			'usernameRequired' => ['username', 'required', 'on' => ['register', 'create', 'connect', 'update']],
			'usernameMatch' => ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@\+]+$/'],
			'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 255],
			'usernameTrim' => ['username', 'trim'],
			'usernameUnique' => [
				'username',
				'unique',
				'message' => Yii::t('usuario', 'This username has already been taken'),
			],

			// email rules
			'emailRequired' => ['email', 'required', 'on' => ['register', 'connect', 'create', 'update']],
			'emailPattern' => ['email', 'email'],
			'emailLength' => ['email', 'string', 'max' => 255],
			'emailUnique' => [
				'email',
				'unique',
				'message' => Yii::t('usuario', 'This email address has already been taken'),
			],
			'emailTrim' => ['email', 'trim', 'skipOnEmpty' => true],

			// password rules
			'passwordTrim' => ['password', 'trim'],
			'passwordRequired' => ['password', 'required', 'on' => ['register']],
			'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72, 'on' => ['register', 'create']],

			// two factor auth rules
			'twoFactorSecretTrim' => ['auth_tf_key', 'trim'],
			'twoFactorSecretLength' => ['auth_tf_key', 'string', 'max' => 16],
			'twoFactorEnabledNumber' => ['auth_tf_enabled', 'boolean'],
			'twoFactorTypeLength' => ['auth_tf_type', 'string', 'max' => 20],
			'twoFactorMobilePhoneLength' => ['auth_tf_mobile_phone', 'string', 'max' => 20],
		];
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	 */

	/**
	 * {@inheritdoc}
	 *
	 * @throws NotSupportedException
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('Method "' . __CLASS__ . '::' . __METHOD__ . '" is not implemented.');
	}
	 */

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		if (!static::isPasswordResetTokenValid($token)) {
			return null;
		}

		return static::findOne([
			'password_reset_token' => $token,
			'status' => self::STATUS_ACTIVE,
		]);
	}

	/**
	 * Finds user by verification email token
	 *
	 * @param string $token verify email token
	 * @return static|null
	 */
	public static function findByVerificationToken($token) {
		return static::findOne([
			'verification_token' => $token,
			'status' => self::STATUS_INACTIVE
		]);
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 * @return bool
	 */
	public static function isPasswordResetTokenValid($token)
	{
		if (empty($token)) {
			return false;
		}

		$timestamp = (int) substr($token, strrpos($token, '_') + 1);
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		return $timestamp + $expire >= time();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	public function getId()
	{
		return $this->getAttribute('id');
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	public function getAuthKey()
	{
		return $this->getAttribute('auth_key');
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	public function validateAuthKey($authKey)
	{
		return $this->getAttribute('auth_key') === $authKey;
	}
	 */

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Generates new token for email verification
	 */
	public function generateEmailVerificationToken()
	{
		$this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}
}
