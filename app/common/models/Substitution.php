<?php
/**
 * Substitution.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%substitutions}}".
 *
 * @property int $pk PK
 * @property string $name Name
 * @property string $value Value
 * @property string|null $description Description
 */
class Substitution extends ActiveRecord
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
			[['name', 'value', 'description'], 'string'],
			[['name'], 'max' => 32],
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
