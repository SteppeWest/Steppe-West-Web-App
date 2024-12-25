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

/**
 * This is the model class for table "{{%substitutions}}".
 *
 * @property int $pk PK
 * @property string $name Name
 * @property string $title Title
 * @property string|null $url URL
 * @property string|null $class Class
 * @property string|null $icon Icon
 * @property int $external External
 * @property int $social Social Account
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
			[['name', 'title'], 'required'],
			[['external', 'social'], 'integer'],
			[['description'], 'string'],
			[['name', 'title'], 'string', 'max' => 32],
			[['url', 'class', 'icon'], 'string', 'max' => 128],
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
			'title' => 'Title',
			'url' => 'URL',
			'class' => 'Class',
			'icon' => 'Icon',
			'external' => 'External',
			'social' => 'Social Account',
			'description' => 'Description',
		];
	}
}
