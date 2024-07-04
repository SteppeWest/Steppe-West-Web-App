<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%language_codes}}".
 *
 * @property int $pk
 * @property string $code
 * @property int|null $position
 * @property string $name
 * @property string $native
 * @property string $flag
 * @property string $label
 */
class SWLanguageCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language_codes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'native', 'flag', 'label'], 'required'],
            [['code', 'name', 'native', 'flag', 'label'], 'string'],
            [['position'], 'integer'],
            [['position'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'code' => 'Code',
            'position' => 'Position',
            'name' => 'Name',
            'native' => 'Native',
            'flag' => 'Flag',
            'label' => 'Label',
        ];
    }
}
