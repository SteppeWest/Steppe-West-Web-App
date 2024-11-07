<?php
/**
 * SwSubstitution.php
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
 * This is the model class for table "sw_substitutions".
 *
 * @property int $pk PK
 * @property string $name Name
 * @property string $value Value
 * @property string|null $description Description
 */
class SwSubstitution extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'sw_substitutions';
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
