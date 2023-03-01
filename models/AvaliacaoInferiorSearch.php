<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoInferior;

/**
 * AvaliacaoInferiorSearch represents the model behind the search form of `app\models\AvaliacaoInferior`.
 */
class AvaliacaoInferiorSearch extends AvaliacaoInferior
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno',  'id_profissional'], 'integer'],
            [['dt_avaliacao','cd_avaliacao', 'nr_tempo_servico', 'ds_diagnostico_medico', 'ds_medico_responsavel', 'ds_queixa_atual', 'ds_disfuncao_avds', 'ds_hma', 'ds_dor', 'ds_localizacao', 'ds_frequencia_dor', 'ds_caracteristica_dor', 'ds_patologia_associada', 'ds_medicamento_uso', 'ds_hp_hf_hs', 'ds_cirurgia_internacao', 'ds_fisioterapia_quando', 'ds_locomocao', 'ds_avaliacao_postural', 'ds_movimentacao_ativa', 'ds_trendelenburg', 'ds_obs_trendelenburg', 'ds_patrick', 'ds_obs_patrick', 'ds_gillet', 'ds_obs_gillet', 'ds_ober', 'ds_obs_ober', 'ds_teste_rigidez_quadril', 'ds_obs_teste_rigidez_quadril', 'ds_teste_apley', 'ds_obs_teste_apley', 'ds_gaveta_anterior', 'ds_obs_gaveta_anterior', 'ds_gaveta_posterior', 'ds_obs_gaveta_posterior', 'ds_teste_clarke', 'ds_obs_teste_clarke', 'ds_estresse_valgo', 'ds_obs_estresse_valgo', 'ds_estresse_varo', 'ds_obs_estresse_varo', 'ds_teste_thompson', 'ds_obs_teste_thompson', 'ds_adm_dorsiflexao', 'ds_obs_adm_dorsiflexao', 'ds_exames_complementares', 'ds_conduta'], 'safe'],
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
        $query = AvaliacaoInferior::find();

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

        $query->andFilterWhere(['like', 'ds_diagnostico_medico', $this->ds_diagnostico_medico])
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
            ->andFilterWhere(['like', 'ds_movimentacao_ativa', $this->ds_movimentacao_ativa])
            ->andFilterWhere(['like', 'ds_trendelenburg', $this->ds_trendelenburg])
            ->andFilterWhere(['like', 'ds_obs_trendelenburg', $this->ds_obs_trendelenburg])
            ->andFilterWhere(['like', 'ds_patrick', $this->ds_patrick])
            ->andFilterWhere(['like', 'ds_obs_patrick', $this->ds_obs_patrick])
            ->andFilterWhere(['like', 'ds_gillet', $this->ds_gillet])
            ->andFilterWhere(['like', 'ds_obs_gillet', $this->ds_obs_gillet])
            ->andFilterWhere(['like', 'ds_ober', $this->ds_ober])
            ->andFilterWhere(['like', 'ds_obs_ober', $this->ds_obs_ober])
            ->andFilterWhere(['like', 'ds_teste_rigidez_quadril', $this->ds_teste_rigidez_quadril])
            ->andFilterWhere(['like', 'ds_obs_teste_rigidez_quadril', $this->ds_obs_teste_rigidez_quadril])
            ->andFilterWhere(['like', 'ds_teste_apley', $this->ds_teste_apley])
            ->andFilterWhere(['like', 'ds_obs_teste_apley', $this->ds_obs_teste_apley])
            ->andFilterWhere(['like', 'ds_gaveta_anterior', $this->ds_gaveta_anterior])
            ->andFilterWhere(['like', 'ds_obs_gaveta_anterior', $this->ds_obs_gaveta_anterior])
            ->andFilterWhere(['like', 'ds_gaveta_posterior', $this->ds_gaveta_posterior])
            ->andFilterWhere(['like', 'ds_obs_gaveta_posterior', $this->ds_obs_gaveta_posterior])
            ->andFilterWhere(['like', 'ds_teste_clarke', $this->ds_teste_clarke])
            ->andFilterWhere(['like', 'ds_obs_teste_clarke', $this->ds_obs_teste_clarke])
            ->andFilterWhere(['like', 'ds_estresse_valgo', $this->ds_estresse_valgo])
            ->andFilterWhere(['like', 'ds_obs_estresse_valgo', $this->ds_obs_estresse_valgo])
            ->andFilterWhere(['like', 'ds_estresse_varo', $this->ds_estresse_varo])
            ->andFilterWhere(['like', 'ds_obs_estresse_varo', $this->ds_obs_estresse_varo])
            ->andFilterWhere(['like', 'ds_teste_thompson', $this->ds_teste_thompson])
            ->andFilterWhere(['like', 'ds_obs_teste_thompson', $this->ds_obs_teste_thompson])
            ->andFilterWhere(['like', 'ds_adm_dorsiflexao', $this->ds_adm_dorsiflexao])
            ->andFilterWhere(['like', 'ds_obs_adm_dorsiflexao', $this->ds_obs_adm_dorsiflexao])
            ->andFilterWhere(['like', 'ds_exames_complementares', $this->ds_exames_complementares])
            ->andFilterWhere(['like', 'ds_conduta', $this->ds_conduta]);

        return $dataProvider;
    }
}
