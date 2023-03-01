<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HorarioAgenda;

/**
 * HorarioAgendaSearch represents the model behind the search form of `app\models\HorarioAgenda`.
 */
class HorarioAgendaSearch extends HorarioAgenda
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'id_profissional', 'status'], 'integer'],
            [['dt_inicio', 'dt_termino', 'tp_agendamento', 'ds_agendamento', 'ds_cor', 'fl_efetuado', 'ds_descricao', 'ds_objetivo', 'nome', 'telefone','dt_modificacao', 'ds_usuario_modificacao'], 'safe'],
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
        $query = HorarioAgenda::find();

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
            'dt_inicio' => $this->dt_inicio,
            'dt_termino' => $this->dt_termino,
        ]);

        $query->andFilterWhere(['like', 'tp_agendamento', $this->tp_agendamento])
            ->andFilterWhere(['like', 'ds_agendamento', $this->ds_agendamento])
            ->andFilterWhere(['like', 'ds_cor', $this->ds_cor])
            ->andFilterWhere(['like', 'dt_modificacao', $this->dt_modificacao])
            ->andFilterWhere(['like', 'ds_usuario_modificacao', $this->ds_usuario_modificacao])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'fl_efetuado', $this->fl_efetuado]);

        return $dataProvider;
    }
    
    public function search2($params, $id)
    {
        $query = HorarioAgenda::find()->where(['id_profissional' => $id]);
        

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
            'dt_inicio' => $this->dt_inicio,
            'dt_termino' => $this->dt_termino,
        ]);

        $query->andFilterWhere(['like', 'tp_agendamento', $this->tp_agendamento])
            ->andFilterWhere(['like', 'ds_agendamento', $this->ds_agendamento])
            ->andFilterWhere(['like', 'ds_cor', $this->ds_cor])
            ->andFilterWhere(['like', 'dt_modificacao', $this->dt_modificacao])
            ->andFilterWhere(['like', 'ds_usuario_modificacao', $this->ds_usuario_modificacao])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'fl_efetuado', $this->fl_efetuado]);

        return $dataProvider;
    }
}
