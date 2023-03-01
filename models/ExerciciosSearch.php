<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Exercicios;

/**
 * ExerciciosSearch represents the model behind the search form of `app\models\Exercicios`.
 */
class ExerciciosSearch extends Exercicios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_especialidade'], 'integer'],
            [['nm_exercicio', 'cd_tipo_exercicio', 'cd_subtipo_exercicio'], 'safe'],
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
        $query = Exercicios::find();

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
            'id_especialidade' => $this->id_especialidade,
        ]);

        $query->andFilterWhere(['like', 'nm_exercicio', $this->nm_exercicio])
            ->andFilterWhere(['like', 'cd_tipo_exercicio', $this->cd_tipo_exercicio])
            ->andFilterWhere(['like', 'cd_subtipo_exercicio', $this->cd_subtipo_exercicio]);

        return $dataProvider;
    }
}
