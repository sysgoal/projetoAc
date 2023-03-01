<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoSuperior;

/**
 * AvaliacaoSuperiorSearch represents the model behind the search form of `app\models\AvaliacaoSuperior`.
 */
class AvaliacaoSuperiorSearch extends AvaliacaoSuperior
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'cd_avaliacao', 'nr_tempo_servico', 'id_profissional'], 'integer'],
            [['dt_avaliacao',  'ds_atividade_laboral',  'ds_diagnostico_medico', 'ds_medico_responsavel', 'ds_queixa_atual', 'ds_disfuncao_avds', 'ds_hma', 'ds_dor', 'ds_localizacao', 'ds_frequencia_dor', 'ds_caracteristica_dor', 'ds_patologia_associada', 'ds_medicamento_uso', 'ds_hp_hf_hs', 'ds_cirurgia_internacao', 'ds_fisioterapia_quando', 'ds_locomocao', 'ds_avaliacao_postural', 'ds_reu', 'ds_movimentacao_ativa', 'ds_phalen', 'ds_observacao_phalen', 'ds_phalen_invertido', 'ds_obs_phalen_invertido', 'ds_de_quervain', 'ds_obs_de_quervain', 'ds_ultt', 'ds_observacao_ultt', 'ds_estresse_valgo', 'ds_obs_estresse_valgo', 'ds_estresse_varo', 'ds_obs_estresse_varo', 'ds_resistencia_flexao', 'ds_obs_resistencia_flexao', 'ds_resistencia_extensao', 'ds_obs_resistencia_extensao', 'ds_subescapular', 'ds_obs_subescapular', 'ds_supraespinhal', 'ds_obs_supraespinhal', 'ds_infraespinhal', 'ds_obs_infraespinhal', 'ds_redondo_menor', 'ds_obs_redondo_menor', 'ds_biceps', 'ds_obs_biceps', 'ds_end_feel', 'ds_obs_end_feel', 'ds_exames_complementares', 'ds_conduta'], 'safe'],
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
        $query = AvaliacaoSuperior::find();

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
          
            'dt_avaliacao' => $this->dt_avaliacao,
            'cd_avaliacao' => $this->cd_avaliacao,
            'nr_tempo_servico' => $this->nr_tempo_servico,
            'id_profissional' => $this->id_profissional,
        ]);

        $query->andFilterWhere(['like', 'ds_atividade_laboral', $this->ds_atividade_laboral])                      
            ->andFilterWhere(['like', 'ds_diagnostico_medico', $this->ds_diagnostico_medico])
            ->andFilterWhere(['like', 'ds_medico_responsavel', $this->ds_medico_responsavel])
            ->andFilterWhere(['like', 'ds_queixa_atual', $this->ds_queixa_atual])
            ->andFilterWhere(['like', 'ds_disfuncao_avds', $this->ds_disfuncao_avds])
            ->andFilterWhere(['like', 'ds_hma', $this->ds_hma])
            ->andFilterWhere(['like', 'ds_dor', $this->ds_dor])
            ->andFilterWhere(['like', 'ds_localizacao', $this->ds_localizacao])
            ->andFilterWhere(['like', 'ds_frequencia_dor', $this->ds_frequencia_dor])
            ->andFilterWhere(['like', 'ds_caracteristica_dor', $this->ds_caracteristica_dor])
            ->andFilterWhere(['like', 'ds_patologia_associada', $this->ds_patologia_associada])
            ->andFilterWhere(['like', 'ds_medicamento_uso', $this->ds_medicamento_uso])
            ->andFilterWhere(['like', 'ds_hp_hf_hs', $this->ds_hp_hf_hs])
            ->andFilterWhere(['like', 'ds_cirurgia_internacao', $this->ds_cirurgia_internacao])
            ->andFilterWhere(['like', 'ds_fisioterapia_quando', $this->ds_fisioterapia_quando])
            ->andFilterWhere(['like', 'ds_locomocao', $this->ds_locomocao])
            ->andFilterWhere(['like', 'ds_avaliacao_postural', $this->ds_avaliacao_postural])
            ->andFilterWhere(['like', 'ds_reu', $this->ds_reu])
            ->andFilterWhere(['like', 'ds_movimentacao_ativa', $this->ds_movimentacao_ativa])
            ->andFilterWhere(['like', 'ds_phalen', $this->ds_phalen])
            ->andFilterWhere(['like', 'ds_observacao_phalen', $this->ds_observacao_phalen])
            ->andFilterWhere(['like', 'ds_phalen_invertido', $this->ds_phalen_invertido])
            ->andFilterWhere(['like', 'ds_obs_phalen_invertido', $this->ds_obs_phalen_invertido])
            ->andFilterWhere(['like', 'ds_de_quervain', $this->ds_de_quervain])
            ->andFilterWhere(['like', 'ds_obs_de_quervain', $this->ds_obs_de_quervain])
            ->andFilterWhere(['like', 'ds_ultt', $this->ds_ultt])
            ->andFilterWhere(['like', 'ds_observacao_ultt', $this->ds_observacao_ultt])
            ->andFilterWhere(['like', 'ds_estresse_valgo', $this->ds_estresse_valgo])
            ->andFilterWhere(['like', 'ds_obs_estresse_valgo', $this->ds_obs_estresse_valgo])
            ->andFilterWhere(['like', 'ds_estresse_varo', $this->ds_estresse_varo])
            ->andFilterWhere(['like', 'ds_obs_estresse_varo', $this->ds_obs_estresse_varo])
            ->andFilterWhere(['like', 'ds_resistencia_flexao', $this->ds_resistencia_flexao])
            ->andFilterWhere(['like', 'ds_obs_resistencia_flexao', $this->ds_obs_resistencia_flexao])
            ->andFilterWhere(['like', 'ds_resistencia_extensao', $this->ds_resistencia_extensao])
            ->andFilterWhere(['like', 'ds_obs_resistencia_extensao', $this->ds_obs_resistencia_extensao])
            ->andFilterWhere(['like', 'ds_subescapular', $this->ds_subescapular])
            ->andFilterWhere(['like', 'ds_obs_subescapular', $this->ds_obs_subescapular])
            ->andFilterWhere(['like', 'ds_supraespinhal', $this->ds_supraespinhal])
            ->andFilterWhere(['like', 'ds_obs_supraespinhal', $this->ds_obs_supraespinhal])
            ->andFilterWhere(['like', 'ds_infraespinhal', $this->ds_infraespinhal])
            ->andFilterWhere(['like', 'ds_obs_infraespinhal', $this->ds_obs_infraespinhal])
            ->andFilterWhere(['like', 'ds_redondo_menor', $this->ds_redondo_menor])
            ->andFilterWhere(['like', 'ds_obs_redondo_menor', $this->ds_obs_redondo_menor])
            ->andFilterWhere(['like', 'ds_biceps', $this->ds_biceps])
            ->andFilterWhere(['like', 'ds_obs_biceps', $this->ds_obs_biceps])
            ->andFilterWhere(['like', 'ds_end_feel', $this->ds_end_feel])
            ->andFilterWhere(['like', 'ds_obs_end_feel', $this->ds_obs_end_feel])
            ->andFilterWhere(['like', 'ds_exames_complementares', $this->ds_exames_complementares])
            ->andFilterWhere(['like', 'ds_conduta', $this->ds_conduta]);

        return $dataProvider;
    }
}
