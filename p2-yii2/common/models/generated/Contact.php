<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $id
 * @property int|null $profile_user_id
 * @property string|null $country_code
 * @property string|null $email
 * @property string|null $whatsapp_number
 * @property int $is_staff
 * @property int $is_public
 * @property int $is_active
 * @property int $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ContactTranslation[] $contactTranslations
 * @property Language[] $languages
 */
class Contact extends \yii\db\ActiveRecord
{


	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%contact}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['profile_user_id', 'country_code', 'email', 'whatsapp_number', 'created_at', 'updated_at'], 'default', 'value' => null],
			[['is_active'], 'default', 'value' => 1],
			[['sort_order'], 'default', 'value' => 0],
			[['profile_user_id', 'is_staff', 'is_public', 'is_active', 'sort_order', 'created_at', 'updated_at'], 'integer'],
			[['country_code'], 'string', 'max' => 8],
			[['email'], 'string', 'max' => 255],
			[['whatsapp_number'], 'string', 'max' => 32],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'profile_user_id' => 'Profile User ID',
			'country_code' => 'Country Code',
			'email' => 'Email',
			'whatsapp_number' => 'Whatsapp Number',
			'is_staff' => 'Is Staff',
			'is_public' => 'Is Public',
			'is_active' => 'Is Active',
			'sort_order' => 'Sort Order',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	/**
	 * Gets query for [[ContactTranslations]].
	 *
	 * @return \yii\db\ActiveQuery|ContactTranslationQuery
	 */
	public function getContactTranslations()
	{
		return $this->hasMany(ContactTranslation::class, ['contact_id' => 'id']);
	}

	/**
	 * Gets query for [[Languages]].
	 *
	 * @return \yii\db\ActiveQuery|LanguageQuery
	 */
	public function getLanguages()
	{
		return $this->hasMany(Language::class, ['id' => 'language_id'])->viaTable('{{%contact_translation}}', ['contact_id' => 'id']);
	}

	/**
	 * {@inheritdoc}
	 * @return ContactQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new ContactQuery(get_called_class());
	}

}
