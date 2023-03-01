<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestePilates;

/**
 * TestePilatesSearch represents the model behind the search form of `app\models\TestePilates`.
 */
class TestePilatesSearch extends TestePilates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno'], 'integer'],
            [['dt_teste', 'ds_observacao'], 'safe'],
            [['ds_001', 'ds_002', 'ds_003', 'ds_004', 'ds_005'], 'number'],
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
        $query = TestePilates::find();

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
            'dt_teste' => $this->dt_teste,
            'ds_001' => $this->ds_001,
            'ds_002' => $this->ds_002,
            'ds_003' => $this->ds_003,
            'ds_004' => $this->ds_004,
            'ds_005' => $this->ds_005,
        ]);

        $query->andFilterWhere(['like', 'ds_observacao', $this->ds_observacao]);

        return $dataProvider;
    }
}
