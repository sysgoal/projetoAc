<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoFacial;

/**
 * AvaliacaoFacialSearch represents the model behind the search form of `app\models\AvaliacaoFacial`.
 */
class AvaliacaoFacialSearch extends AvaliacaoFacial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'id_profissional'], 'integer'],
            [['ds_medico_responsavel', 'ds_diagnostico', 'ds_queixa', 'ds_objetivo', 'ds_hma', 'ds_hp', 'ds_medicacao_uso', 'ds_face_comprometida', 'ds_mimicas_faciais', 'ds_observacao_mimicas', 'dt_avaliacao', 'ds_disfuncoes'], 'safe'],
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
        $query = AvaliacaoFacial::find();

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
            'dt_avaliacao' => $this->dt_avaliacao,
        ]);

        $query->andFilterWhere(['like', 'ds_medico_responsavel', $this->ds_medico_responsavel])
            ->andFilterWhere(['like', 'ds_diagnostico', $this->ds_diagnostico])
            ->andFilterWhere(['like', 'ds_queixa', $this->ds_queixa])
            ->andFilterWhere(['like', 'ds_objetivo', $this->ds_objetivo])
            ->andFilterWhere(['like', 'ds_hma', $this->ds_hma])
            ->andFilterWhere(['like', 'ds_hp', $this->ds_hp])
            ->andFilterWhere(['like', 'ds_medicacao_uso', $this->ds_medicacao_uso])
            ->andFilterWhere(['like', 'ds_face_comprometida', $this->ds_face_comprometida])
            ->andFilterWhere(['like', 'ds_mimicas_faciais', $this->ds_mimicas_faciais])
            ->andFilterWhere(['like', 'ds_observacao_mimicas', $this->ds_observacao_mimicas])
            ->andFilterWhere(['like', 'ds_disfuncoes', $this->ds_disfuncoes]);

        return $dataProvider;
    }
}
