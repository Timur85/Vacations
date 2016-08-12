<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $group_id
 * @property string $group_name
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name'], 'required'],
            [['group_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'ID',
            'group_name' => 'Группа',
        ];
    }

    public function getUser(){
        return $this->hasMany(User::className(), ['role' => 'group_id']);
    }
}
