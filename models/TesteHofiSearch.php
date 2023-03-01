<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TesteHofi;

/**
 * TesteHofiSearch represents the model behind the search form of `app\models\TesteHofi`.
 */
class TesteHofiSearch extends TesteHofi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'ds_observacao'], 'integer'],
            [['dt_teste', 'tp_nado'], 'safe'],
            [['ds_tempo'], 'number'],
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
        $query = TesteHofi::find();

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
            'dt_teste' => $this->dt_teste,
            'ds_tempo' => $this->ds_tempo,
            'id_aluno' => $this->id_aluno,
            'ds_observacao' => $this->ds_observacao,
        ]);

        $query->andFilterWhere(['like', 'tp_nado', $this->tp_nado]);

        return $dataProvider;
    }
}
