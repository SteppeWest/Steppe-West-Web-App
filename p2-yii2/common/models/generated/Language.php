<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property int $id
 * @property string $code
 * @property string|null $legacy_code
 * @property int|null $menu_position
 * @property int $is_active
 * @property string $name_en
 * @property string $native_name
 * @property string|null $flag_icon
 * @property string $ui_label
 * @property string $locale
 * @property string $html_lang
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ContactTranslation[] $contactTranslations
 * @property Contact[] $contacts
 * @property FaqItem[] $faqItems
 * @property FaqTranslation[] $faqTranslations
 * @property PageTranslation[] $pageTranslations
 * @property Page[] $pages
 */
class Language extends \yii\db\ActiveRecord
{


	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%language}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['legacy_code', 'menu_position', 'flag_icon', 'created_at', 'updated_at'], 'default', 'value' => null],
			[['is_active'], 'default', 'value' => 1],
			[['code', 'name_en', 'native_name', 'ui_label', 'locale', 'html_lang'], 'required'],
			[['menu_position', 'is_active', 'created_at', 'updated_at'], 'integer'],
			[['code', 'legacy_code', 'flag_icon'], 'string', 'max' => 8],
			[['name_en', 'native_name'], 'string', 'max' => 64],
			[['ui_label', 'locale', 'html_lang'], 'string', 'max' => 16],
			[['code'], 'unique'],
			[['legacy_code'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'code' => 'Code',
			'legacy_code' => 'Legacy Code',
			'menu_position' => 'Menu Position',
			'is_active' => 'Is Active',
			'name_en' => 'Name En',
			'native_name' => 'Native Name',
			'flag_icon' => 'Flag Icon',
			'ui_label' => 'Ui Label',
			'locale' => 'Locale',
			'html_lang' => 'Html Lang',
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
		return $this->hasMany(ContactTranslation::class, ['language_id' => 'id']);
	}

	/**
	 * Gets query for [[Contacts]].
	 *
	 * @return \yii\db\ActiveQuery|ContactQuery
	 */
	public function getContacts()
	{
		return $this->hasMany(Contact::class, ['id' => 'contact_id'])->viaTable('{{%contact_translation}}', ['language_id' => 'id']);
	}

	/**
	 * Gets query for [[FaqItems]].
	 *
	 * @return \yii\db\ActiveQuery|FaqItemQuery
	 */
	public function getFaqItems()
	{
		return $this->hasMany(FaqItem::class, ['id' => 'faq_item_id'])->viaTable('{{%faq_translation}}', ['language_id' => 'id']);
	}

	/**
	 * Gets query for [[FaqTranslations]].
	 *
	 * @return \yii\db\ActiveQuery|FaqTranslationQuery
	 */
	public function getFaqTranslations()
	{
		return $this->hasMany(FaqTranslation::class, ['language_id' => 'id']);
	}

	/**
	 * Gets query for [[PageTranslations]].
	 *
	 * @return \yii\db\ActiveQuery|PageTranslationQuery
	 */
	public function getPageTranslations()
	{
		return $this->hasMany(PageTranslation::class, ['language_id' => 'id']);
	}

	/**
	 * Gets query for [[Pages]].
	 *
	 * @return \yii\db\ActiveQuery|PageQuery
	 */
	public function getPages()
	{
		return $this->hasMany(Page::class, ['id' => 'page_id'])->viaTable('{{%page_translation}}', ['language_id' => 'id']);
	}

	/**
	 * {@inheritdoc}
	 * @return LanguageQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new LanguageQuery(get_called_class());
	}

}
