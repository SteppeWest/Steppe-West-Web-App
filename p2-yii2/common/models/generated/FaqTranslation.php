<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "{{%faq_translation}}".
 *
 * @property int $id
 * @property int $faq_item_id
 * @property int $language_id
 * @property string $question
 * @property string $answer
 *
 * @property FaqItem $faqItem
 * @property Language $language
 */
class FaqTranslation extends \yii\db\ActiveRecord
{


	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%faq_translation}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['faq_item_id', 'language_id', 'question', 'answer'], 'required'],
			[['faq_item_id', 'language_id'], 'integer'],
			[['answer'], 'string'],
			[['question'], 'string', 'max' => 255],
			[['faq_item_id', 'language_id'], 'unique', 'targetAttribute' => ['faq_item_id', 'language_id']],
			[['faq_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaqItem::class, 'targetAttribute' => ['faq_item_id' => 'id']],
			[['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'faq_item_id' => 'Faq Item ID',
			'language_id' => 'Language ID',
			'question' => 'Question',
			'answer' => 'Answer',
		];
	}

	/**
	 * Gets query for [[FaqItem]].
	 *
	 * @return \yii\db\ActiveQuery|FaqItemQuery
	 */
	public function getFaqItem()
	{
		return $this->hasOne(FaqItem::class, ['id' => 'faq_item_id']);
	}

	/**
	 * Gets query for [[Language]].
	 *
	 * @return \yii\db\ActiveQuery|LanguageQuery
	 */
	public function getLanguage()
	{
		return $this->hasOne(Language::class, ['id' => 'language_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return FaqTranslationQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new FaqTranslationQuery(get_called_class());
	}

}
