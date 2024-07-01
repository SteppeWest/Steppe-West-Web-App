<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sw_language_codes".
 *
 * @property int $pk
 * @property string $code
 * @property int $active
 * @property int $position
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
        return 'sw_language_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'position', 'name', 'native', 'flag', 'label'], 'required'],
            [['code', 'name', 'native', 'flag', 'label'], 'string'],
            [['active', 'position'], 'integer'],
            [['position'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk' => Yii::t('app', 'Pk'),
            'code' => Yii::t('app', 'Code'),
            'active' => Yii::t('app', 'Active'),
            'position' => Yii::t('app', 'Position'),
            'name' => Yii::t('app', 'Name'),
            'native' => Yii::t('app', 'Native'),
            'flag' => Yii::t('app', 'Flag'),
            'label' => Yii::t('app', 'Label'),
        ];
    }
}
