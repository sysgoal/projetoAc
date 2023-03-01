<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profissional;

/**
 * ProfissionalSearch represents the model behind the search form of `app\models\Profissional`.
 */
class ProfissionalSearch extends Profissional
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_profissional', 'nr_registro'], 'integer'],
            [['nm_profissional', 'tp_registro'], 'safe'],
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
        $query = Profissional::find();

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
            'id_profissional' => $this->id_profissional,
            'nr_registro' => $this->nr_registro,
        ]);

        $query->andFilterWhere(['like', 'nm_profissional', $this->nm_profissional])
            ->andFilterWhere(['like', 'tp_registro', $this->tp_registro]);

        return $dataProvider;
    }
}
