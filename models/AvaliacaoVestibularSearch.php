<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvaliacaoVestibular;

/**
 * AvaliacaoVestibularSearch represents the model behind the search form of `app\models\AvaliacaoVestibular`.
 */
class AvaliacaoVestibularSearch extends AvaliacaoVestibular
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'id_profissional'], 'integer'],
            [['dt_avaliacao', 'ds_diagnostico', 'ds_medico_responsavel', 'ds_queixa_atual', 'ds_disfuncao_avds', 'ds_hma', 'fl_dor', 'ds_localizacao_dor', 'ds_frequencia_dor', 'ds_patologias_associadas', 'ds_medicamento_uso', 'ds_hp_hf_hs', 'ds_cirurgias', 'ds_unipodal_olhos_abertos', 'ds_unipodal_olhos_fechados', 'ds_apoio_mid', 'ds_apoio_mie', 'ds_index_nariz', 'ds_pammhg_deitado', 'ds_pammhg_sentado', 'ds_basiliar', 'ds_exames', 'ds_conduta'], 'safe'],
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
        $query = AvaliacaoVestibular::find();

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

        $query->andFilterWhere(['like', 'ds_diagnostico', $this->ds_diagnostico])
            ->andFilterWhere(['like', 'ds_medico_responsavel', $this->ds_medico_responsavel])
            ->andFilterWhere(['like', 'ds_queixa_atual', $this->ds_queixa_atual])
            ->andFilterWhere(['like', 'ds_disfuncao_avds', $this->ds_disfuncao_avds])
            ->andFilterWhere(['like', 'ds_hma', $this->ds_hma])
            ->andFilterWhere(['like', 'ds_dor', $this->ds_dor])
            ->andFilterWhere(['like', 'ds_localizacao_dor', $this->ds_localizacao_dor])
            ->andFilterWhere(['like', 'ds_frequencia_dor', $this->ds_frequencia_dor])
            ->andFilterWhere(['like', 'ds_patologias_associadas', $this->ds_patologias_associadas])
            ->andFilterWhere(['like', 'ds_medicamento_uso', $this->ds_medicamento_uso])
            ->andFilterWhere(['like', 'ds_hp_hf_hs', $this->ds_hp_hf_hs])
            ->andFilterWhere(['like', 'ds_cirurgias', $this->ds_cirurgias])
            ->andFilterWhere(['like', 'ds_unipodal_olhos_abertos', $this->ds_unipodal_olhos_abertos])
            ->andFilterWhere(['like', 'ds_unipodal_olhos_fechados', $this->ds_unipodal_olhos_fechados])
            ->andFilterWhere(['like', 'ds_apoio_mid', $this->ds_apoio_mid])
            ->andFilterWhere(['like', 'ds_apoio_mie', $this->ds_apoio_mie])
            ->andFilterWhere(['like', 'ds_index_nariz', $this->ds_index_nariz])
            ->andFilterWhere(['like', 'ds_pammhg_deitado', $this->ds_pammhg_deitado])
            ->andFilterWhere(['like', 'ds_pammhg_sentado', $this->ds_pammhg_sentado])
            ->andFilterWhere(['like', 'ds_basiliar', $this->ds_basiliar])
            ->andFilterWhere(['like', 'ds_exames', $this->ds_exames])
            ->andFilterWhere(['like', 'ds_conduta', $this->ds_conduta]);

        return $dataProvider;
    }
}
