<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%contact_translation}}".
 *
 * @property int $id
 * @property int $contact_id
 * @property int $language_id
 * @property string $first_name
 * @property string|null $family_name
 * @property string|null $display_name
 * @property string|null $role_title
 * @property string|null $country_label
 * @property string|null $bio_short
 *
 * @property Contact $contact
 * @property Language $language
 */
class ContactTranslation extends \common\models\ContactTranslation
{
	/**
	 * {@inheritdoc}
	 */
	/**
	public static function tableName()
	{
		return '{{%contact_translation}}';
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	/**
	public function rules()
	{
		return [
			[['family_name', 'display_name', 'role_title', 'country_label', 'bio_short'], 'default', 'value' => null],
			[['contact_id', 'language_id', 'first_name'], 'required'],
			[['contact_id', 'language_id'], 'integer'],
			[['bio_short'], 'string'],
			[['first_name', 'family_name', 'country_label'], 'string', 'max' => 128],
			[['display_name', 'role_title'], 'string', 'max' => 255],
			[['contact_id', 'language_id'], 'unique', 'targetAttribute' => ['contact_id', 'language_id']],
			[['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::class, 'targetAttribute' => ['contact_id' => 'id']],
			[['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language_id' => 'id']],
		];
	}
	 */

	/**
	 * {@inheritdoc}
	 */
	/**
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'contact_id' => 'Contact ID',
			'language_id' => 'Language ID',
			'first_name' => 'First Name',
			'family_name' => 'Family Name',
			'display_name' => 'Display Name',
			'role_title' => 'Role Title',
			'country_label' => 'Country Label',
			'bio_short' => 'Bio Short',
		];
	}
	 */

	/**
	 * Gets query for [[Contact]].
	 *
	 * @return \yii\db\ActiveQuery|ContactQuery
	 */
	/**
	public function getContact()
	{
		return $this->hasOne(Contact::class, ['id' => 'contact_id']);
	}
	 */

	/**
	 * Gets query for [[Language]].
	 *
	 * @return \yii\db\ActiveQuery|LanguageQuery
	 */
	/**
	public function getLanguage()
	{
		return $this->hasOne(Language::class, ['id' => 'language_id']);
	}
	 */

	/**
	 * {@inheritdoc}
	 * @return ContactTranslationQuery the active query used by this AR class.
	 */
	/**
	public static function find()
	{
		return new ContactTranslationQuery(get_called_class());
	}
	 */
}
