<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacation;

/**
 * VacationSearch represents the model behind the search form about `app\models\Vacation`.
 */
class VacationSearch extends Vacation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vacation_id'], 'integer'],
            [['date_start','status','end_date', 'acc_date_approval', 'm_date_approval', 'vacation_type', 'employee', 'accounter', 'manager'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vacation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vacation_id' => $this->vacation_id,
            'date_start' => $this->date_start,
            'end_date' => $this->end_date,
            //'employee' => $this->employee,
            //'accounter' => $this->accounter,
            'acc_date_approval' => $this->acc_date_approval,
            //'manager' => $this->manager,
            'm_date_approval' => $this->m_date_approval,
            /*'status' => $this->status,*/
            /*'vacation_type' => $this->vacation_type,*/
        ]);

        $query->joinWith('userUser');
        $query->andFilterWhere(['like','type', $this->employee]);

        $query->joinWith('userUser');
        $query->andFilterWhere(['like','type', $this->accounter]);

        $query->joinWith('userUser');
        $query->andFilterWhere(['like','type', $this->manager]);

        $query->joinWith('statusStatus');
        $query->andFilterWhere(['like','type', $this->status]);

        $query->joinWith('vacationType');
        $query->andFilterWhere(['like','type', $this->vacation_type]);

        return $dataProvider;
    }
}
