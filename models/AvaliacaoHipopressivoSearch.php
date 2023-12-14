<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoHipopressivo;

/**
 * AvaliacaoHipopressivoSearch represents the model behind the search form of `app\models\AvaliacaoHipopressivo`.
 */
class AvaliacaoHipopressivoSearch extends AvaliacaoHipopressivo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_avaliacao', 'id_aluno', 'nr_cigarro', 'nr_tempo_tabagismo', 'nr_tempo_ex_tabagismo', 
            'nr_refeicoes_dia', 'id_profissional', 'ds_idade_atual'], 'integer'],
            [['dt_avaliacao', 'ds_motivo', 'ds_medicamento', 'ds_patologia', 'ds_cirurgia', 
            'fl_tabagista', 'ds_comentario_tabagismo', 'ds_doenca_respiratoria', 
            'ds_comentario_doenca_respiratoria', 'nr_filhos', 'ds_ciclo_cesaria', 
            'nr_nocturia', 'fl_relacao_dor', 'fl_relacao_prazer', 'fl_incontinencia',
             'fl_endema', 'fl_dor_circulatorio', 'ds_comentario_circulatorio', 'fl_restricao',
              'ds_comentario_disgestivo', 'nr_litros_agua_dia', 'ds_flexibilidade', 'ds_orientacoes', 
              'ds_conduta', 'ds_foto1', 'ds_foto2', 'ds_foto3', 'ds_foto4', 'ds_foto5', 'ds_foto6', 
              'ds_foto7', 'ds_video', 'ds_medico_responsavel', 'ds_sono', 'ds_alergia', 'fl_dor',
               'ds_atividade_fisica', 'ds_ativo_sedentario', 'ds_dor', 'ds_endema', 'ds_incontinencia',
                'ds_intestino', 'ds_avaliacao_postural', 'ds_acool', 'ds_braco_relax_d', 'ds_pa', 'ds_cintura',
                 'ds_temperatura', 'ds_torax', 'ds_quadril', 'ds_coxa_med_d', 'ds_panturrilha_d',
                  'ds_sexo', 'ds_tonus', 'ds_abdomen', 'ds_altura', 'ds_peso', 'ds_massa_magra',
                   'ds_massa_gorda', 'ds_idade', 'ds_metabolismo', 'ds_imc', 'ds_gordura_visceral', 
                   'ds_10_acima', 'ds_5_acima', 'ds_5_abaixo', 'ds_10_abaixo', 'ds_umbigo', 'ds_observacao', 
                   'ds_competencia', 'ds_diastase', 'ds_anamnese_medico', 'ds_aparelho_circ'], 'safe'],
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
        $query = AvaliacaoHipopressivo::find();

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
            'dt_avaliacao' => $this->dt_avaliacao,
            'nr_cigarro' => $this->nr_cigarro,
            'nr_tempo_tabagismo' => $this->nr_tempo_tabagismo,
            'nr_tempo_ex_tabagismo' => $this->nr_tempo_ex_tabagismo,
            'nr_refeicoes_dia' => $this->nr_refeicoes_dia,
            'id_profissional' => $this->id_profissional,
            'ds_idade_atual' => $this->ds_idade_atual,
        ]);

        $query->andFilterWhere(['like', 'ds_motivo', $this->ds_motivo])
            ->andFilterWhere(['like', 'ds_medicamento', $this->ds_medicamento])
            ->andFilterWhere(['like', 'ds_patologia', $this->ds_patologia])
            ->andFilterWhere(['like', 'ds_cirurgia', $this->ds_cirurgia])
            ->andFilterWhere(['like', 'fl_tabagista', $this->fl_tabagista])
            ->andFilterWhere(['like', 'ds_comentario_tabagismo', $this->ds_comentario_tabagismo])
            ->andFilterWhere(['like', 'ds_doenca_respiratoria', $this->ds_doenca_respiratoria])
            ->andFilterWhere(['like', 'ds_comentario_doenca_respiratoria', $this->ds_comentario_doenca_respiratoria])
            ->andFilterWhere(['like', 'nr_filhos', $this->nr_filhos])
            ->andFilterWhere(['like', 'ds_ciclo_cesaria', $this->ds_ciclo_cesaria])
            ->andFilterWhere(['like', 'nr_nocturia', $this->nr_nocturia])
            ->andFilterWhere(['like', 'fl_relacao_dor', $this->fl_relacao_dor])
            ->andFilterWhere(['like', 'fl_relacao_prazer', $this->fl_relacao_prazer])
            ->andFilterWhere(['like', 'fl_incontinencia', $this->fl_incontinencia])
            ->andFilterWhere(['like', 'fl_endema', $this->fl_endema])
            ->andFilterWhere(['like', 'fl_dor_circulatorio', $this->fl_dor_circulatorio])
            ->andFilterWhere(['like', 'ds_comentario_circulatorio', $this->ds_comentario_circulatorio])
            ->andFilterWhere(['like', 'fl_restricao', $this->fl_restricao])
            ->andFilterWhere(['like', 'ds_comentario_disgestivo', $this->ds_comentario_disgestivo])
            ->andFilterWhere(['like', 'nr_litros_agua_dia', $this->nr_litros_agua_dia])
            ->andFilterWhere(['like', 'ds_flexibilidade', $this->ds_flexibilidade])
            ->andFilterWhere(['like', 'ds_orientacoes', $this->ds_orientacoes])
            ->andFilterWhere(['like', 'ds_conduta', $this->ds_conduta])
            ->andFilterWhere(['like', 'ds_foto1', $this->ds_foto1])
            ->andFilterWhere(['like', 'ds_foto2', $this->ds_foto2])
            ->andFilterWhere(['like', 'ds_foto3', $this->ds_foto3])
            ->andFilterWhere(['like', 'ds_foto4', $this->ds_foto4])
            ->andFilterWhere(['like', 'ds_foto5', $this->ds_foto5])
            ->andFilterWhere(['like', 'ds_foto6', $this->ds_foto6])
            ->andFilterWhere(['like', 'ds_foto7', $this->ds_foto7])
            ->andFilterWhere(['like', 'ds_video', $this->ds_video])
            ->andFilterWhere(['like', 'ds_medico_responsavel', $this->ds_medico_responsavel])
            ->andFilterWhere(['like', 'ds_sono', $this->ds_sono])
            ->andFilterWhere(['like', 'ds_alergia', $this->ds_alergia])
            ->andFilterWhere(['like', 'fl_dor', $this->fl_dor])
            ->andFilterWhere(['like', 'ds_atividade_fisica', $this->ds_atividade_fisica])
            ->andFilterWhere(['like', 'ds_ativo_sedentario', $this->ds_ativo_sedentario])
            ->andFilterWhere(['like', 'ds_dor', $this->ds_dor])
            ->andFilterWhere(['like', 'ds_endema', $this->ds_endema])
            ->andFilterWhere(['like', 'ds_incontinencia', $this->ds_incontinencia])
            ->andFilterWhere(['like', 'ds_intestino', $this->ds_intestino])
            ->andFilterWhere(['like', 'ds_avaliacao_postural', $this->ds_avaliacao_postural])
            ->andFilterWhere(['like', 'ds_acool', $this->ds_acool])
            ->andFilterWhere(['like', 'ds_braco_relax_d', $this->ds_braco_relax_d])
            ->andFilterWhere(['like', 'ds_pa', $this->ds_pa])
            ->andFilterWhere(['like', 'ds_cintura', $this->ds_cintura])
            ->andFilterWhere(['like', 'ds_temperatura', $this->ds_temperatura])
            ->andFilterWhere(['like', 'ds_torax', $this->ds_torax])
            ->andFilterWhere(['like', 'ds_quadril', $this->ds_quadril])
            ->andFilterWhere(['like', 'ds_coxa_med_d', $this->ds_coxa_med_d])
            ->andFilterWhere(['like', 'ds_coxa_med_e', $this->ds_coxa_med_e])
            ->andFilterWhere(['like', 'ds_panturrilha_d', $this->ds_panturrilha_d])
            ->andFilterWhere(['like', 'ds_panturrilha_e', $this->ds_panturrilha_e])
            ->andFilterWhere(['like', 'ds_sexo', $this->ds_sexo])
            ->andFilterWhere(['like', 'ds_tonus', $this->ds_tonus])
            ->andFilterWhere(['like', 'ds_abdomen', $this->ds_abdomen])
            ->andFilterWhere(['like', 'ds_altura', $this->ds_altura])
            ->andFilterWhere(['like', 'ds_peso', $this->ds_peso])
            ->andFilterWhere(['like', 'ds_massa_magra', $this->ds_massa_magra])
            ->andFilterWhere(['like', 'ds_massa_gorda', $this->ds_massa_gorda])
            ->andFilterWhere(['like', 'ds_idade', $this->ds_idade])
            ->andFilterWhere(['like', 'ds_metabolismo', $this->ds_metabolismo])
            ->andFilterWhere(['like', 'ds_imc', $this->ds_imc])
            ->andFilterWhere(['like', 'ds_gordura_visceral', $this->ds_gordura_visceral])
            ->andFilterWhere(['like', 'ds_10_acima', $this->ds_10_acima])
            ->andFilterWhere(['like', 'ds_5_acima', $this->ds_5_acima])
            ->andFilterWhere(['like', 'ds_5_abaixo', $this->ds_5_abaixo])
            ->andFilterWhere(['like', 'ds_10_abaixo', $this->ds_10_abaixo])
            ->andFilterWhere(['like', 'ds_umbigo', $this->ds_umbigo])
            ->andFilterWhere(['like', 'ds_observacao', $this->ds_observacao])
            ->andFilterWhere(['like', 'ds_competencia', $this->ds_competencia])
            ->andFilterWhere(['like', 'ds_diastase', $this->ds_diastase])
            ->andFilterWhere(['like', 'ds_anamnese_medico', $this->ds_anamnese_medico])
            ->andFilterWhere(['like', 'ds_aparelho_circ', $this->ds_aparelho_circ]);

        return $dataProvider;
    }
    
    public function search2($params)
    {
        
        $query = AvaliacaoHipopressivo::find()->groupBy('id_aluno')->orderBy('dt_avaliacao DESC');
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
            'dt_avaliacao' => $this->dt_avaliacao,
            'nr_cigarro' => $this->nr_cigarro,
            'nr_tempo_tabagismo' => $this->nr_tempo_tabagismo,
            'nr_tempo_ex_tabagismo' => $this->nr_tempo_ex_tabagismo,
            'nr_refeicoes_dia' => $this->nr_refeicoes_dia,
            'id_profissional' => $this->id_profissional,
            'ds_idade_atual' => $this->ds_idade_atual,
        ]);

        $query->andFilterWhere(['like', 'ds_motivo', $this->ds_motivo])
            ->andFilterWhere(['like', 'ds_medicamento', $this->ds_medicamento])
            ->andFilterWhere(['like', 'ds_patologia', $this->ds_patologia])
            ->andFilterWhere(['like', 'ds_cirurgia', $this->ds_cirurgia])
            ->andFilterWhere(['like', 'fl_tabagista', $this->fl_tabagista])
            ->andFilterWhere(['like', 'ds_comentario_tabagismo', $this->ds_comentario_tabagismo])
            ->andFilterWhere(['like', 'ds_doenca_respiratoria', $this->ds_doenca_respiratoria])
            ->andFilterWhere(['like', 'ds_comentario_doenca_respiratoria', $this->ds_comentario_doenca_respiratoria])
            ->andFilterWhere(['like', 'nr_filhos', $this->nr_filhos])
            ->andFilterWhere(['like', 'ds_ciclo_cesaria', $this->ds_ciclo_cesaria])
            ->andFilterWhere(['like', 'nr_nocturia', $this->nr_nocturia])
            ->andFilterWhere(['like', 'fl_relacao_dor', $this->fl_relacao_dor])
            ->andFilterWhere(['like', 'fl_relacao_prazer', $this->fl_relacao_prazer])
            ->andFilterWhere(['like', 'fl_incontinencia', $this->fl_incontinencia])
            ->andFilterWhere(['like', 'fl_endema', $this->fl_endema])
            ->andFilterWhere(['like', 'fl_dor_circulatorio', $this->fl_dor_circulatorio])
            ->andFilterWhere(['like', 'ds_comentario_circulatorio', $this->ds_comentario_circulatorio])
            ->andFilterWhere(['like', 'fl_restricao', $this->fl_restricao])
            ->andFilterWhere(['like', 'ds_comentario_disgestivo', $this->ds_comentario_disgestivo])
            ->andFilterWhere(['like', 'nr_litros_agua_dia', $this->nr_litros_agua_dia])
            ->andFilterWhere(['like', 'ds_flexibilidade', $this->ds_flexibilidade])
            ->andFilterWhere(['like', 'ds_orientacoes', $this->ds_orientacoes])
            ->andFilterWhere(['like', 'ds_conduta', $this->ds_conduta])
            ->andFilterWhere(['like', 'ds_foto1', $this->ds_foto1])
            ->andFilterWhere(['like', 'ds_foto2', $this->ds_foto2])
            ->andFilterWhere(['like', 'ds_foto3', $this->ds_foto3])
            ->andFilterWhere(['like', 'ds_foto4', $this->ds_foto4])
            ->andFilterWhere(['like', 'ds_foto5', $this->ds_foto5])
            ->andFilterWhere(['like', 'ds_foto6', $this->ds_foto6])
            ->andFilterWhere(['like', 'ds_foto7', $this->ds_foto7])
            ->andFilterWhere(['like', 'ds_video', $this->ds_video])
            ->andFilterWhere(['like', 'ds_medico_responsavel', $this->ds_medico_responsavel])
            ->andFilterWhere(['like', 'ds_sono', $this->ds_sono])
            ->andFilterWhere(['like', 'ds_alergia', $this->ds_alergia])
            ->andFilterWhere(['like', 'fl_dor', $this->fl_dor])
            ->andFilterWhere(['like', 'ds_atividade_fisica', $this->ds_atividade_fisica])
            ->andFilterWhere(['like', 'ds_ativo_sedentario', $this->ds_ativo_sedentario])
            ->andFilterWhere(['like', 'ds_dor', $this->ds_dor])
            ->andFilterWhere(['like', 'ds_endema', $this->ds_endema])
            ->andFilterWhere(['like', 'ds_incontinencia', $this->ds_incontinencia])
            ->andFilterWhere(['like', 'ds_intestino', $this->ds_intestino])
            ->andFilterWhere(['like', 'ds_avaliacao_postural', $this->ds_avaliacao_postural])
            ->andFilterWhere(['like', 'ds_acool', $this->ds_acool])
            ->andFilterWhere(['like', 'ds_braco_relax_d', $this->ds_braco_relax_d])
            ->andFilterWhere(['like', 'ds_pa', $this->ds_pa])
            ->andFilterWhere(['like', 'ds_cintura', $this->ds_cintura])
            ->andFilterWhere(['like', 'ds_temperatura', $this->ds_temperatura])
            ->andFilterWhere(['like', 'ds_torax', $this->ds_torax])
            ->andFilterWhere(['like', 'ds_quadril', $this->ds_quadril])
            ->andFilterWhere(['like', 'ds_coxa_med_d', $this->ds_coxa_med_d])
            ->andFilterWhere(['like', 'ds_panturrilha_d', $this->ds_panturrilha_d])
            ->andFilterWhere(['like', 'ds_sexo', $this->ds_sexo])
            ->andFilterWhere(['like', 'ds_tonus', $this->ds_tonus])
            ->andFilterWhere(['like', 'ds_abdomen', $this->ds_abdomen])
            ->andFilterWhere(['like', 'ds_altura', $this->ds_altura])
            ->andFilterWhere(['like', 'ds_peso', $this->ds_peso])
            ->andFilterWhere(['like', 'ds_massa_magra', $this->ds_massa_magra])
            ->andFilterWhere(['like', 'ds_massa_gorda', $this->ds_massa_gorda])
            ->andFilterWhere(['like', 'ds_idade', $this->ds_idade])
            ->andFilterWhere(['like', 'ds_metabolismo', $this->ds_metabolismo])
            ->andFilterWhere(['like', 'ds_imc', $this->ds_imc])
            ->andFilterWhere(['like', 'ds_gordura_visceral', $this->ds_gordura_visceral])
            ->andFilterWhere(['like', 'ds_10_acima', $this->ds_10_acima])
            ->andFilterWhere(['like', 'ds_5_acima', $this->ds_5_acima])
            ->andFilterWhere(['like', 'ds_5_abaixo', $this->ds_5_abaixo])
            ->andFilterWhere(['like', 'ds_10_abaixo', $this->ds_10_abaixo])
            ->andFilterWhere(['like', 'ds_umbigo', $this->ds_umbigo])
            ->andFilterWhere(['like', 'ds_observacao', $this->ds_observacao])
            ->andFilterWhere(['like', 'ds_competencia', $this->ds_competencia])
            ->andFilterWhere(['like', 'ds_diastase', $this->ds_diastase])
            ->andFilterWhere(['like', 'ds_anamnese_medico', $this->ds_anamnese_medico])
            ->andFilterWhere(['like', 'ds_aparelho_circ', $this->ds_aparelho_circ]);

        return $dataProvider;
    }
}
