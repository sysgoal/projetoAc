<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aluno;

/**
 * AlunoSearch represents the model behind the search form of `app\models\Aluno`.
 */
class AlunoSearch extends Aluno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_convenio', 'id_profissional'], 'integer'],
            [['nm_aluno', 'ds_cpf', 'dt_nascimento', 'ds_sexo', 'ds_identidade', 'ds_responsaveis', 'ds_estado', 'ds_cidade', 'ds_endereco', 'ds_cep', 'ds_email', 'ds_profissao', 'ds_telefone1', 'ds_telefone2', 'ds_whatsapp', 'fl_paciente'], 'safe'],
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
        $query = Aluno::find();

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
            'dt_nascimento' => $this->dt_nascimento,
            'ds_telefone1' => $this->ds_telefone1,
            'ds_telefone2' => $this->ds_telefone2,
            'ds_whatsapp' => $this->ds_whatsapp,
            'id_convenio' => $this->id_convenio,
            'id_profissional' => $this->id_profissional,
        ]);

        $query->andFilterWhere(['like', 'nm_aluno', $this->nm_aluno])
            ->andFilterWhere(['like', 'ds_cpf', $this->ds_cpf])
            ->andFilterWhere(['like', 'ds_sexo', $this->ds_sexo])
            ->andFilterWhere(['like', 'ds_identidade', $this->ds_identidade])
            ->andFilterWhere(['like', 'ds_responsaveis', $this->ds_responsaveis])
            ->andFilterWhere(['like', 'ds_estado', $this->ds_estado])
            ->andFilterWhere(['like', 'ds_cidade', $this->ds_cidade])
            ->andFilterWhere(['like', 'ds_endereco', $this->ds_endereco])
            ->andFilterWhere(['like', 'ds_cep', $this->ds_cep])
            ->andFilterWhere(['like', 'ds_email', $this->ds_email])
            ->andFilterWhere(['like', 'ds_profissao', $this->ds_profissao]);
        $query->orderBy('nm_aluno');

        return $dataProvider;
    }
}
