<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoInfantil;

/**
 * AvaliacaoInfantilSearch represents the model behind the search form of `app\models\AvaliacaoInfantil`.
 */
class AvaliacaoInfantilSearch extends AvaliacaoInfantil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'data'], 'integer'],
            [['peso', 'altura', 'abdomem','idade', 'flexao', 'postura', 'observacao'], 'safe'],
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
        $query = AvaliacaoInfantil::find();

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
            'data' => $this->data,
            'idade' => $this->idade,
        ]);

        $query->andFilterWhere(['like', 'peso', $this->peso])
            ->andFilterWhere(['like', 'altura', $this->altura])
            ->andFilterWhere(['like', 'abdomem', $this->abdomem])
            ->andFilterWhere(['like', 'flexao', $this->flexao])
            ->andFilterWhere(['like', 'postura', $this->postura])
            ->andFilterWhere(['like', 'observacao', $this->observacao]);

        return $dataProvider;
    }
}
