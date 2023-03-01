<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Avaliacao;

/**
 * AvaliacaoSearch represents the model behind the search form of `app\models\Avaliacao`.
 */
class AvaliacaoSearch extends Avaliacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_avaliacao', 'id_aluno', 'nr_cigarro', 'nr_tempo_tabagismo', 'nr_tempo_ex_tabagismo', 'nr_filhos', 'nr_nocturia', 'nr_refeicoes_dia', 'nr_litros_agua_dia'], 'integer'],
            [['ds_motivo', 'ds_medicamento', 'ds_patologia', 'ds_cirurgia', 'fl_tabagista', 'ds_comentario_tabagismo', 'ds_doenca_respiratoria', 'ds_comentario_doenca_respiratoria', 'ds_ciclo_cesaria', 'fl_relacao_dor', 'fl_relacao_prazer', 'fl_incontinencia', 'fl_endema', 'fl_dor_circulatorio', 'ds_comentario_circulatorio', 'fl_restricao', 'ds_comentario_disgestivo', 'ds_flexibilidade', 'ds_orientacoes'], 'safe'],
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
        $query = Avaliacao::find();

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
            'id_avaliacao' => $this->id_avaliacao,
            'id_aluno' => $this->id_aluno,
            'nr_cigarro' => $this->nr_cigarro,
            'nr_tempo_tabagismo' => $this->nr_tempo_tabagismo,
            'nr_tempo_ex_tabagismo' => $this->nr_tempo_ex_tabagismo,
            'nr_filhos' => $this->nr_filhos,
            'nr_nocturia' => $this->nr_nocturia,
            'nr_refeicoes_dia' => $this->nr_refeicoes_dia,
            'nr_litros_agua_dia' => $this->nr_litros_agua_dia,
        ]);

        $query->andFilterWhere(['like', 'ds_motivo', $this->ds_motivo])
            ->andFilterWhere(['like', 'ds_medicamento', $this->ds_medicamento])
            ->andFilterWhere(['like', 'ds_patologia', $this->ds_patologia])
            ->andFilterWhere(['like', 'ds_cirurgia', $this->ds_cirurgia])
            ->andFilterWhere(['like', 'fl_tabagista', $this->fl_tabagista])
            ->andFilterWhere(['like', 'ds_comentario_tabagismo', $this->ds_comentario_tabagismo])
            ->andFilterWhere(['like', 'ds_doenca_respiratoria', $this->ds_doenca_respiratoria])
            ->andFilterWhere(['like', 'ds_comentario_doenca_respiratoria', $this->ds_comentario_doenca_respiratoria])
            ->andFilterWhere(['like', 'ds_ciclo_cesaria', $this->ds_ciclo_cesaria])
            ->andFilterWhere(['like', 'fl_relacao_dor', $this->fl_relacao_dor])
            ->andFilterWhere(['like', 'fl_relacao_prazer', $this->fl_relacao_prazer])
            ->andFilterWhere(['like', 'fl_incontinencia', $this->fl_incontinencia])
            ->andFilterWhere(['like', 'fl_endema', $this->fl_endema])
            ->andFilterWhere(['like', 'fl_dor_circulatorio', $this->fl_dor_circulatorio])
            ->andFilterWhere(['like', 'ds_comentario_circulatorio', $this->ds_comentario_circulatorio])
            ->andFilterWhere(['like', 'fl_restricao', $this->fl_restricao])
            ->andFilterWhere(['like', 'ds_comentario_disgestivo', $this->ds_comentario_disgestivo])
            ->andFilterWhere(['like', 'ds_flexibilidade', $this->ds_flexibilidade])
            ->andFilterWhere(['like', 'ds_orientacoes', $this->ds_orientacoes]);

        return $dataProvider;
    }
    
    
     public function search2($params)
    {
        $query = Avaliacao::find()->groupBy('id_aluno')->orderBy('dt_avaliacao DESC');

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
            'id_avaliacao' => $this->id_avaliacao,
            'id_aluno' => $this->id_aluno,
            'nr_cigarro' => $this->nr_cigarro,
            'nr_tempo_tabagismo' => $this->nr_tempo_tabagismo,
            'nr_tempo_ex_tabagismo' => $this->nr_tempo_ex_tabagismo,
            'nr_filhos' => $this->nr_filhos,
            'nr_nocturia' => $this->nr_nocturia,
            'nr_refeicoes_dia' => $this->nr_refeicoes_dia,
            'nr_litros_agua_dia' => $this->nr_litros_agua_dia,
        ]);

        $query->andFilterWhere(['like', 'ds_motivo', $this->ds_motivo])
            ->andFilterWhere(['like', 'ds_medicamento', $this->ds_medicamento])
            ->andFilterWhere(['like', 'ds_patologia', $this->ds_patologia])
            ->andFilterWhere(['like', 'ds_cirurgia', $this->ds_cirurgia])
            ->andFilterWhere(['like', 'fl_tabagista', $this->fl_tabagista])
            ->andFilterWhere(['like', 'ds_comentario_tabagismo', $this->ds_comentario_tabagismo])
            ->andFilterWhere(['like', 'ds_doenca_respiratoria', $this->ds_doenca_respiratoria])
            ->andFilterWhere(['like', 'ds_comentario_doenca_respiratoria', $this->ds_comentario_doenca_respiratoria])
            ->andFilterWhere(['like', 'ds_ciclo_cesaria', $this->ds_ciclo_cesaria])
            ->andFilterWhere(['like', 'fl_relacao_dor', $this->fl_relacao_dor])
            ->andFilterWhere(['like', 'fl_relacao_prazer', $this->fl_relacao_prazer])
            ->andFilterWhere(['like', 'fl_incontinencia', $this->fl_incontinencia])
            ->andFilterWhere(['like', 'fl_endema', $this->fl_endema])
            ->andFilterWhere(['like', 'fl_dor_circulatorio', $this->fl_dor_circulatorio])
            ->andFilterWhere(['like', 'ds_comentario_circulatorio', $this->ds_comentario_circulatorio])
            ->andFilterWhere(['like', 'fl_restricao', $this->fl_restricao])
            ->andFilterWhere(['like', 'ds_comentario_disgestivo', $this->ds_comentario_disgestivo])
            ->andFilterWhere(['like', 'ds_flexibilidade', $this->ds_flexibilidade])
            ->andFilterWhere(['like', 'ds_orientacoes', $this->ds_orientacoes]);

        return $dataProvider;
    }
    
    
}
