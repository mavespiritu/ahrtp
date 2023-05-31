<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Intervention;

/**
 * InterventionSearch represents the model behind the search form of `app\models\Intervention`.
 */
class InterventionSearch extends Intervention
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intervention_id', 'intervention_title', 'comp_id'], 'safe'],
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
        $query = Intervention::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'intervention_id', $this->intervention_id])
            ->andFilterWhere(['like', 'intervention_title', $this->intervention_title])
            ->andFilterWhere(['like', 'comp_id', $this->comp_id]);

        return $dataProvider;
    }
}
