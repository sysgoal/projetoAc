<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Turma;

/**
 * TurmaSearch represents the model behind the search form of `app\models\Turma`.
 */
class TurmaSearch extends Turma
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_turma', 'nr_vagas', 'id_profissional', 'id_profissional2', 'id_especialidade'], 'integer'],
            [['nm_turma', 'ds_turno', 'hr_inicio', 'hr_fim'], 'safe'],
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
        $query = Turma::find();

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
            'id_turma' => $this->id_turma,
            'nr_vagas' => $this->nr_vagas,
            'hr_inicio' => $this->hr_inicio,
            'hr_fim' => $this->hr_fim,           
            'id_profissional' => $this->id_profissional,
            'id_profissional2' => $this->id_profissional2,
            'id_especialidade' => $this->id_especialidade,
        ]);

        $query->andFilterWhere(['like', 'nm_turma', $this->nm_turma])
            ->andFilterWhere(['like', 'ds_turno', $this->ds_turno]);

        return $dataProvider;
    }
}
