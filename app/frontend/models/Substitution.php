<?php
/**
 * Substitution.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%substitutions}}".
 *
 * @property int $pk PK
 * @property string $name Name
 * @property string $value Value
 * @property string|null $description Description
 */
class Substitution extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%substitutions}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name', 'value'], 'required'],
			[['value', 'description'], 'string'],
			[['name'], 'string', 'max' => 32],
			[['name'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'pk' => 'PK',
			'name' => 'Name',
			'value' => 'Value',
			'description' => 'Description',
		];
	}
}
