<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacation_type".
 *
 * @property integer $id
 * @property string $type
 * @property integer $days
 */
class VacationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacation_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'days'], 'required'],
            [['days'], 'integer'],
            [['type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип отпуска',
            'days' => 'Дни',
        ];
    }


    public function gettypedays()
    {
        return $this->type.'  [Дней доступно '.$this->days.']';
    }
}
