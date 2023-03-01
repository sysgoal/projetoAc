<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FichaAluno;

/**
 * FichaAlunoSearch represents the model behind the search form of `app\models\FichaAluno`.
 */
class FichaAlunoSearch extends FichaAluno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'id_profissional', 'id_exercicio_1', 'id_exercicio_2', 'id_exercicio_3', 'id_exercicio_4', 'id_exercicio_5', 'id_exercicio_6', 'id_exercicio_7', 'id_exercicio_8', 'id_exercicio_9', 'id_exercicio_10', 'id_exercicio_11', 'id_exercicio_12', 'id_exercicio_13', 'id_exercicio_14', 'id_exercicio_15', 'id_exercicio_16', 'id_exercicio_17', 'id_exercicio_18'], 'integer'],
            [['dt_ficha', 'nr_repeticao1', 'nr_repeticao2', 'nr_repeticao3', 'nr_repeticao4', 'nr_repeticao5', 'nr_repeticao6', 'nr_repeticao7', 'nr_repeticao8', 'nr_repeticao9', 'nr_repeticao10', 'nr_repeticao11', 'nr_repeticao12', 'nr_repeticao13', 'nr_repeticao14', 'nr_repeticao15', 'nr_repeticao16', 'nr_repeticao17', 'nr_repeticao18'], 'safe'],
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
        $query = FichaAluno::find();

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
            'id_profissional' => $this->id_profissional,
            'dt_ficha' => $this->dt_ficha,
            'id_exercicio_1' => $this->id_exercicio_1,
            'id_exercicio_2' => $this->id_exercicio_2,
            'id_exercicio_3' => $this->id_exercicio_3,
            'id_exercicio_4' => $this->id_exercicio_4,
            'id_exercicio_5' => $this->id_exercicio_5,
            'id_exercicio_6' => $this->id_exercicio_6,
            'id_exercicio_7' => $this->id_exercicio_7,
            'id_exercicio_8' => $this->id_exercicio_8,
            'id_exercicio_9' => $this->id_exercicio_9,
            'id_exercicio_10' => $this->id_exercicio_10,
            'id_exercicio_11' => $this->id_exercicio_11,
            'id_exercicio_12' => $this->id_exercicio_12,
            'id_exercicio_13' => $this->id_exercicio_13,
            'id_exercicio_14' => $this->id_exercicio_14,
            'id_exercicio_15' => $this->id_exercicio_15,
            'id_exercicio_16' => $this->id_exercicio_16,
            'id_exercicio_17' => $this->id_exercicio_17,
            'id_exercicio_18' => $this->id_exercicio_18,
        ]);

        $query->andFilterWhere(['like', 'nr_repeticao1', $this->nr_repeticao1])
            ->andFilterWhere(['like', 'nr_repeticao2', $this->nr_repeticao2])
            ->andFilterWhere(['like', 'nr_repeticao3', $this->nr_repeticao3])
            ->andFilterWhere(['like', 'nr_repeticao4', $this->nr_repeticao4])
            ->andFilterWhere(['like', 'nr_repeticao5', $this->nr_repeticao5])
            ->andFilterWhere(['like', 'nr_repeticao6', $this->nr_repeticao6])
            ->andFilterWhere(['like', 'nr_repeticao7', $this->nr_repeticao7])
            ->andFilterWhere(['like', 'nr_repeticao8', $this->nr_repeticao8])
            ->andFilterWhere(['like', 'nr_repeticao9', $this->nr_repeticao9])
            ->andFilterWhere(['like', 'nr_repeticao10', $this->nr_repeticao10])
            ->andFilterWhere(['like', 'nr_repeticao11', $this->nr_repeticao11])
            ->andFilterWhere(['like', 'nr_repeticao12', $this->nr_repeticao12])
            ->andFilterWhere(['like', 'nr_repeticao13', $this->nr_repeticao13])
            ->andFilterWhere(['like', 'nr_repeticao14', $this->nr_repeticao14])
            ->andFilterWhere(['like', 'nr_repeticao15', $this->nr_repeticao15])
            ->andFilterWhere(['like', 'nr_repeticao16', $this->nr_repeticao16])
            ->andFilterWhere(['like', 'nr_repeticao17', $this->nr_repeticao17])
            ->andFilterWhere(['like', 'nr_repeticao18', $this->nr_repeticao18]);

        return $dataProvider;
    }
}
