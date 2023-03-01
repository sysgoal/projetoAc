<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BoletimInfantil;

/**
 * BoletimInfantilSearch represents the model behind the search form of `app\models\BoletimInfantil`.
 */
class BoletimInfantilSearch extends BoletimInfantil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'id_profissional'], 'integer'],
            [['ds_cor_touca', 'ds_atv1', 'ds_atv2', 'ds_atv3', 'ds_atv4', 'ds_atv5', 'data'], 'safe'],
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
        $query = BoletimInfantil::find()->orderBy('data DESC');

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
        $query->andFilterWhere([
            'id' => $this->id,
            'data' => $this->data,
            'id_aluno' => $this->id_aluno,
            'id_profissional' => $this->id_profissional,
        ]);

        $query->andFilterWhere(['like', 'ds_cor_touca', $this->ds_cor_touca])
            ->andFilterWhere(['like', 'ds_atv1', $this->ds_atv1])
            ->andFilterWhere(['like', 'ds_atv2', $this->ds_atv2])
            ->andFilterWhere(['like', 'ds_atv3', $this->ds_atv3])
            ->andFilterWhere(['like', 'ds_atv4', $this->ds_atv4])
            ->andFilterWhere(['like', 'ds_atv5', $this->ds_atv5]);

        return $dataProvider;
    }
    
     public function searchBoletim($params)
    {
        $query = BoletimInfantil::find()->groupBy('id_aluno');

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
        $query->andFilterWhere([
            'id' => $this->id,
            'data' => $this->data,
            'id_aluno' => $this->id_aluno,
            'id_profissional' => $this->id_profissional,
        ]);

        $query->andFilterWhere(['like', 'ds_cor_touca', $this->ds_cor_touca])
            ->andFilterWhere(['like', 'ds_atv1', $this->ds_atv1])
            ->andFilterWhere(['like', 'ds_atv2', $this->ds_atv2])
            ->andFilterWhere(['like', 'ds_atv3', $this->ds_atv3])
            ->andFilterWhere(['like', 'ds_atv4', $this->ds_atv4])
            ->andFilterWhere(['like', 'ds_atv5', $this->ds_atv5]);

        return $dataProvider;
    }
}
