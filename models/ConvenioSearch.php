<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Convenio;

/**
 * ConvenioSearch represents the model behind the search form of `app\models\Convenio`.
 */
class ConvenioSearch extends Convenio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nr_registro_ans', 'cd_operadora'], 'integer'],
            [['vs_tiss', 'ds_nome'], 'safe'],
            [['tb_preco'], 'number'],
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
        $query = Convenio::find();

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
            'nr_registro_ans' => $this->nr_registro_ans,
            'cd_operadora' => $this->cd_operadora,
            'tb_preco' => $this->tb_preco,
        ]);

        $query->andFilterWhere(['like', 'vs_tiss', $this->vs_tiss])
            ->andFilterWhere(['like', 'ds_nome', $this->ds_nome]);

        return $dataProvider;
    }
}
