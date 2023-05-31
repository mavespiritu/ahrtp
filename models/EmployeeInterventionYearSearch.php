<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmployeeInterventionYear;

/**
 * EmployeeInterventionYearSearch represents the model behind the search form of `app\models\EmployeeInterventionYear`.
 */
class EmployeeInterventionYearSearch extends EmployeeInterventionYear
{
    public $interventionName;
    public $employeeName;
    public $competencyName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intervention_id', 'year'], 'integer'],
            [['emp_id', 'interventionName', 'employeeName', 'competencyName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = EmployeeInterventionYear::find()
                ->joinWith('employee')
                ->joinWith('intervention')
                ->joinWith('intervention.competency')
                ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['year' => SORT_DESC]]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'year',
                'competencyName' => [
                    'asc' => ['tblcompetency.competency' => SORT_ASC],
                    'desc' => ['tblcompetency.competency' => SORT_DESC],
                ],
                'interventionName' => [
                    'asc' => ['tblintervention.intervention_title' => SORT_ASC],
                    'desc' => ['tblintervention.intervention_title' => SORT_DESC],
                ],
                'employeeName' => [
                    'asc' => ['concat(tblemployee.fname," ",tblemployee.lname)' => SORT_ASC],
                    'desc' => ['concat(tblemployee.fname," ",tblemployee.lname)' => SORT_DESC],
                ],
                'date_created',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'year' => $this->year,
        ]);

        $query->andFilterWhere(['like', 'tblintervention.intervention_title', $this->interventionName])
              ->andFilterWhere(['like', 'concat(tblemployee.fname," ",tblemployee.lname)', $this->employeeName])
              ->andFilterWhere(['like', 'tblcompetency.competency', $this->competencyName])
        ;

        return $dataProvider;
    }
}
