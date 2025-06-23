<?php
/**
 * LanguageFaq.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%language_faq}}".
 *
 * @property int $pk PK
 * @property int $page_pk Page PK
 * @property int $active Active
 * @property int $position Position
 * @property string $question Question
 * @property string $answer Answer
 */
class LanguageFaq extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%language_faq}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['page_pk', 'position', 'question', 'answer'], 'required'],
			[['page_pk', 'active', 'position'], 'integer'],
			[['answer'], 'string'],
			[['question'], 'string', 'max' => 128],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => 'PK',
			'page_pk' => 'Page PK',
			'active' => 'Active',
			'position' => 'Position',
			'question' => 'Question',
			'answer' => 'Answer',
		];
	}
}
