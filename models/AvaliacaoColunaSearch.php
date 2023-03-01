<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoColuna;

/**
 * AvaliacaoColunaSearch represents the model behind the search form of `app\models\AvaliacaoColuna`.
 */
class AvaliacaoColunaSearch extends AvaliacaoColuna
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'cd_avaliacao', 'nr_tempo_servico', 'id_profissional'], 'integer'],
            [['dt_avaliacao', 'ds_diagnostico_medico', 'ds_medico_responsavel', 'ds_queixa_atual', 'ds_disfuncao_avds', 'ds_hma', 'ds_dor', 'ds_localizacao', 'ds_frequencia_dor', 'ds_caracteristica_dor', 'ds_patologia_associada', 'ds_medicamento_uso', 'ds_hp_hf_hs', 'ds_cirurgia_internacao', 'ds_fisioterapia_quando', 'ds_locomocao', 'ds_avaliacao_postural', 'ds_movimentacao_ativa', 'ds_compressao', 'ds_observacao_compressao', 'ds_distracao', 'ds_observacao_distracao', 'ds_slump', 'ds_observacao_slump', 'ds_esfigmomanometro', 'ds_obs_esfigmomanometro', 'ds_gillet', 'ds_observacao_gillet', 'ds_mackenzie', 'ds_obs_mackenzie', 'ds_william', 'ds_obs_william', 'ds_subirdescer', 'ds_obs_subirdescer', 'ds_piriforme', 'ds_obs_piriforme', 'ds_exames_complementares', 'ds_conduta'], 'string'],
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
        $query = AvaliacaoColuna::find();

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
            ->andFilterWhere(['like', 'ds_compressao', $this->ds_compressao])
            ->andFilterWhere(['like', 'ds_observacao_compressao', $this->ds_observacao_compressao])
            ->andFilterWhere(['like', 'ds_distracao', $this->ds_distracao])
            ->andFilterWhere(['like', 'ds_observacao_distracao', $this->ds_observacao_distracao])
            ->andFilterWhere(['like', 'ds_slump', $this->ds_slump])
            ->andFilterWhere(['like', 'ds_observacao_slump', $this->ds_observacao_slump])
            ->andFilterWhere(['like', 'ds_esfigmomanometro', $this->ds_esfigmomanometro])
            ->andFilterWhere(['like', 'ds_obs_esfigmomanometro', $this->ds_obs_esfigmomanometro])
            ->andFilterWhere(['like', 'ds_gillet', $this->ds_gillet])
            ->andFilterWhere(['like', 'ds_observacao_gillet', $this->ds_observacao_gillet])
            ->andFilterWhere(['like', 'ds_mackenzie', $this->ds_mackenzie])
            ->andFilterWhere(['like', 'ds_obs_mackenzie', $this->ds_obs_mackenzie])
            ->andFilterWhere(['like', 'ds_william', $this->ds_william])
            ->andFilterWhere(['like', 'ds_obs_william', $this->ds_obs_william])
            ->andFilterWhere(['like', 'ds_subirdescer', $this->ds_subirdescer])
            ->andFilterWhere(['like', 'ds_obs_subirdescer', $this->ds_obs_subirdescer])
            ->andFilterWhere(['like', 'ds_piriforme', $this->ds_piriforme])
            ->andFilterWhere(['like', 'ds_obs_piriforme', $this->ds_obs_piriforme])
            ->andFilterWhere(['like', 'ds_exames_complementares', $this->ds_exames_complementares])
            ->andFilterWhere(['like', 'ds_conduta', $this->ds_conduta]);

        return $dataProvider;
    }
}
