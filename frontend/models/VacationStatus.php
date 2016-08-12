<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacation_status".
 *
 * @property integer $status_id
 * @property string $status_name
 */
class VacationStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacation_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'ID',
            'status_name' => 'Статус',
        ];
    }
}
