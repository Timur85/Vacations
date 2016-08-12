<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "vacation".
 *
 * @property integer $vacation_id
 * @property string $date_start
 * @property string $end_date
 * @property integer $employee
 * @property integer $accounter
 * @property string $acc_date_approval
 * @property integer $manager
 * @property string $m_date_approval
 * @property integer $status
 * @property integer $vacation_type
 */
class Vacation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'end_date', 'employee', 'accounter', 'acc_date_approval', 'manager', 'm_date_approval', 'status'], 'required'],
            [['date_start', 'end_date', 'acc_date_approval', 'm_date_approval'], 'safe'],
            [['employee', 'accounter', 'manager', 'status', 'vacation_type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vacation_id' => 'Vacation ID',
            'date_start' => 'Дата начало',
            'end_date' => 'Дата конец',
            /*'userFIO' => Yii::t('app', 'Сотрудник'),*/
            'employee' => 'Сотрудник',
            'accounter' => 'Бухгалтер',
            'acc_date_approval' => 'Acc Date Approval',
            'manager' => 'Руководитель',
            'm_date_approval' => 'M Date Approval',
            'status' => 'Статус',
            'vacation_type' => 'Тип отпуска',
        ];

    }

    /*For accouter*/
    public function getUserAccouter(){
        return $this->hasOne(User::className(), ['id' => 'accounter']);
    }

    /* Геттер для ФИО */
    public function getUserFIOAcc() {
        if($this->userAccouter <> null){
            return $this->userAccouter->first_name. ' '.$this->userAccouter->last_name.' '.$this->userAccouter->middle_name;
        }
        else{
            return '';
        }
    }

    public function findByYear($year) {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT v.vacation_id, CONCAT(u.first_name,' ',u.last_name) as full_name, v.date_start, v.end_date FROM
                vacation as v inner join user as u on v.employee = u.id
                where v.date_start between '".$year."-01-01' and '".$year."-12-31'
                or v.end_date between '".$year."-01-01' and '".$year."-12-31' and v.status=3
                order by u.id");
         return $customers = $model->queryAll();
    }

    /*For Employee*/
    public function getUserUser(){
        return $this->hasOne(User::className(), ['id' => 'employee']);
    }

    /* Геттер для ФИО */
    public function getUserFIO() {
        if($this->userUser <> NULL){
            return $this->userUser->first_name. ' '.$this->userUser->last_name.' '.$this->userUser->middle_name;
        }
        else{
            return '';
        }
    }

    public function getUserManager(){
        return $this->hasOne(User::className(), ['id' => 'manager']);
    }

    /* Геттер для ФИО */
    public function getUserFIOManage() {
        if($this->userManager <> NULL){
            return $this->userManager->first_name. ' '.$this->userManager->last_name.' '.$this->userManager->middle_name;
        }
        else{
            return '';
        }
    }

    public function getStatusStatus(){
        return $this->hasOne(VacationStatus::className(), ['status_id'=>'status']);
    }

    public function getVacationType(){
        return $this->hasOne(VacationType::className(), ['id'=>'vacation_type']);
    }

}
