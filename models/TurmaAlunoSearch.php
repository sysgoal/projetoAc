<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TurmaAluno;

/**
 * TurmaAlunoSearch represents the model behind the search form of `app\models\TurmaAluno`.
 */
class TurmaAlunoSearch extends TurmaAluno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'id_turma'], 'integer'],
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
    
    /* public function search($params)
    {
        $query = TurmaAluno::find()->groupBy('id_turma');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->sort->attributes['vendor_name'] = [
            'asc' => ['vendor.name' => SORT_ASC],
            'desc' => ['vendor.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'vendor.name', $this->vendor_name]);

        return $dataProvider;
    }
    */
    public function search($params)
    {
        $query = TurmaAluno::find();

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
            'id_aluno' => $this->id_aluno,
            'id_turma' => $this->id_turma,
        ]);

        return $dataProvider;
    }
    public function search2($params)
    {
        $query = TurmaAluno::find()->groupBy('id_turma');

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
            'id_aluno' => $this->id_aluno,
            'id_turma' => $this->id_turma,
        ]);

        return $dataProvider;
    }
    
}
